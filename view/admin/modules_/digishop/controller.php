<?php
  /**
   * Digishop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(AMODPATH . 'digishop/'));

  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Delete == */
  switch ($delete):
      /* == Delete Item == */
      case "deleteItem":
          if ($res = Db::run()->delete(Digishop::mTable, array("id" => Filter::$id))):
		      Db::run()->delete(Modules::mcTable, array("parent_id" => Filter::$id, "section" => "digishop"));
			  Db::run()->delete(Content::cfdTable, array("digishop_id" => Filter::$id));
			  File::deleteRecrusive(FMODPATH . Digishop::DIGIDATA . Filter::$id, true);
          endif;
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_DS_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
		  
      /* == Delete deleteCategory == */
      case "deleteCategory":
          if ($res = Db::run()->delete(Digishop::cTable, array("id" => Filter::$id))):
		      Db::run()->delete(Digishop::cTable, array("parent_id" => Filter::$id));
          endif;
		  $json['menu'] = Digishop::getCategoryDropList(App::Digishop()->categoryTree(), 0, 0, "&#166;&nbsp;&nbsp;&nbsp;&nbsp;");

          $json['type'] = "success";
          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->_MOD_DS_CATDEL_OK);
		  print json_encode($json);
		  Logger::writeLog($json['message']);
          break;
		  
      /* == Delete Transaction == */
      case "deletePayment":
          $res = Db::run()->delete(Digishop::xTable, array("id" => Filter::$id));
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_DS_PAYDEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
		  
      /* == Delete Image == */
      case "deleteImage":
          if ($row = Db::run()->first(Digishop::gTable, null, array("id" => Filter::$id))):
			  File::deleteFile(FMODPATH . Digishop::DIGIDATA . $row->parent_id . '/' . $row->name);
			  File::deleteFile(FMODPATH . Digishop::DIGIDATA . $row->parent_id . '/thumbs/' . $row->name);
			  Db::run()->delete(Digishop::gTable, array("id" => Filter::$id));
			  $json['type'] = "success";
          else:
			  $json['type'] = "error";
          endif;
			  print json_encode($json);
          break;
  endswitch;

  /* == Get Actions == */
  switch ($gAction):
      /* == Item Chart == */
      case "itemChart":
		  $data = Digishop::itemChart(Filter::$id);
		  print json_encode($data);
      break;
	  
      /* == Item Payments == */
      case "itemPayments":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=ItemPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'User', 'Amount', 'TAX/VAT', 'Coupon', 'Total Amount', 'Currency', 'Processor', 'Created'));
		  
		  $result = Digishop::itemPayments(Filter::$id);
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
			  fclose($data);
		  endif;
      break;
	  
      /* == Sales Chart == */
      case "salesChart":
		  $data = Digishop::salesChart();
		  print json_encode($data);
      break;
	  
      /* == All Payments == */
      case "transactions":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=Payments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'User', 'Item', 'Coupon', 'TAX/VAT', 'Amount', 'Processor', 'Currency', 'IP', 'Status', 'Created'));
		  
		  $result = Digishop::allPayments();
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
			  fclose($data);
		  endif;
      break;
	  
      /* == Payment Info == */
      case "viewInfo":
		  $tpl = App::View(AMODPATH . 'digishop/snippets/'); 
		  $tpl->template = 'viewInfo.tpl.php'; 
		  $tpl->data = Db::run()->first(Digishop::xTable, null, array("id" => Filter::$id));
          print $tpl->render();
      break;
	  
	  /* == Resend Notification == */
	  case "resendNotification":
		  $tpl = App::View(AMODPATH . 'digishop/snippets/'); 
		  $tpl->data = Db::run()->first(Digishop::xTable, array("id"), array("id" => Filter::$id));
		  $tpl->template = 'resendNotification.tpl.php'; 
		  print $tpl->render();
	  break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Item == */
      case "processItem":
          App::Digishop()->processItem();
      break;
      /* == Process Category == */
      case "processCategory":
          App::Digishop()->processCategory();
      break;
      /* == Process Configuration == */
      case "processConfig":
          App::Digishop()->processConfig();
      break;

      /* == Process Images == */
      case "processImages":
		  $num_files = count($_FILES['images']['tmp_name']);
		  $filedir = FMODPATH . Digishop::DIGIDATA . Filter::$id;
		  File::makeDirectory($filedir . '/thumbs');
		  
		  for ($x = 0; $x < $num_files; $x++):
			  $image = $_FILES['images']['name'][$x];
			  $newName = "IMG_" . Utility::randomString(12);
			  $ext = substr($image, strrpos($image, '.') + 1);
			  $name = $newName . "." . strtolower($ext);
			  $fullname = $filedir . '/' . $name;
			  
			  if (!move_uploaded_file($_FILES['images']['tmp_name'][$x], $fullname)) {
				  die(Message::msgSingleError(Lang::$word->FU_ERROR13, false));
			  }

			  try {
				  $img = new Image($filedir . '/' . $name);
				  $img->bestFit(App::Digishop()->thumb_w, App::Digishop()->thumb_h)->save($filedir . '/thumbs/' . $name);
			  } catch(Exception $e) {
				  echo 'Error: ' . $e->getMessage();
			  }
			  
			  $last_id = Db::run()->insert(Digishop::gTable, array("parent_id" => Filter::$id, "name" => $name))->getLastInsertId();
			  print '
                <div class="columns" id="item_' . $last_id . '" data-id="' . $last_id . '">
                  <div class="wojo attached fitted segment center aligned"><img src="' . Digishop::hasThumb($name, Filter::$id) . '" alt="" class="wojo rounded center image">
                    <a data-set=\'{"option":[{"delete": "deleteImage","id":' . $last_id . '}], "url":"/modules_/blog/controller.php","action":"delete", "parent":"#item_' . $last_id . '"}\' class="wojo small icon white middle attached button data">
                    <i class="icon trash"></i></a>
                  </div>
                </div>';
		  endfor;
      break;
	  
	  /* == Process Notification == */
	  case "resendNotification":
		  App::Digishop()->resendNotification();
	  break;
  endswitch;
  
  /* == Instant Actions == */
  switch ($iAction):
      /* == Sort Categories == */
      case "sortCategories":
		  $jsonstring = $_POST['sortlist'];
		  $jsonDecoded = json_decode($jsonstring, true, 12);
		  $result = Utility::parseJsonArray($jsonDecoded);
		  $i = 0;
		  foreach ($result as $value):
			  if (is_array($value)):
				  $i++;
				  $data = array('sorting' => $i, 'parent_id' => $value['parent_id']);
				  Db::run()->update(Digishop::cTable, $data, array('id' => $value['id']));
			  endif;
		  endforeach; 
      break;

      /* == Sort Images == */
      case "sortImages":
		  $i = 0;
		  $query = "UPDATE `" . Digishop::gTable . "` SET `sorting` = CASE ";
		  $idlist = '';
		  foreach ($_POST['sorting'] as $item):
			  $i++;
			  $query .= " WHEN id = " . $item . " THEN " . $i . " ";
			  $idlist .= $item . ',';
		  endforeach;
		  $idlist = substr($idlist, 0, -1);
		  $query .= "
				  END
				  WHERE id IN (" . $idlist . ")";
		  Db::run()->pdoQuery($query);
      break;
  endswitch;