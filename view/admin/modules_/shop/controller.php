<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-06-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(AMODPATH . 'shop/'));

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
          if ($res = Db::run()->delete(Shop::mTable, array("id" => Filter::$id))):
		      Db::run()->delete(Modules::mcTable, array("parent_id" => Filter::$id, "section" => "shop"));
			  Db::run()->delete(Content::cfdTable, array("shop_id" => Filter::$id));
			  File::deleteRecrusive(FMODPATH . Shop::SHOPDATA . Filter::$id, true);
          endif;
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_SP_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
		  
      /* == Delete deleteCategory == */
      case "deleteCategory":
          if ($res = Db::run()->delete(Shop::cTable, array("id" => Filter::$id))):
		      Db::run()->delete(Shop::cTable, array("parent_id" => Filter::$id));
          endif;
		  $json['menu'] = Shop::getCategoryDropList(App::Shop()->categoryTree(), 0, 0, "&#166;&nbsp;&nbsp;&nbsp;&nbsp;");

          $json['type'] = "success";
          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->_MOD_SP_CATDEL_OK);
		  print json_encode($json);
		  Logger::writeLog($json['message']);
          break;
		  
      /* == Delete Transaction == */
      case "deletePayment":
          $res = Db::run()->delete(Shop::xTable, array("id" => Filter::$id));
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_SP_PAYDEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
		  
      /* == Delete Image == */
      case "deleteImage":
          if ($row = Db::run()->first(Shop::gTable, null, array("id" => Filter::$id))):
			  File::deleteFile(FMODPATH . Shop::SHOPDATA . $row->parent_id . '/' . $row->name);
			  File::deleteFile(FMODPATH . Shop::SHOPDATA . $row->parent_id . '/thumbs/' . $row->name);
			  Db::run()->delete(Shop::gTable, array("id" => Filter::$id));
			  $json['type'] = "success";
          else:
			  $json['type'] = "error";
          endif;
			  print json_encode($json);
          break;
		  
      /* == Delete deleteFilter == */
      case "deleteVariant":
          if ($res = Db::run()->delete(Shop::vTable, array("id" => Filter::$id))):
		      Db::run()->delete(Shop::vTable, array("parent_id" => Filter::$id));
          endif;
          $json['type'] = "success";
          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->_MOD_SP_FTDEL_OK);
		  print json_encode($json);
		  Logger::writeLog($json['message']);
          break;
  endswitch;

  /* == Get Actions == */
  switch ($gAction):
      /* == Get Variants == */
      case "getVariants":
		  $tpl = App::View(AMODPATH . 'shop/snippets/'); 
		  $tpl->template = 'viewVariants.tpl.php'; 
		  
		  if(isset($_GET['names'])) :
			  $tpl->data = App::Shop()->getFreeVariations(Utility::implodeFields($_GET['names'], ',', true));
		  else :
			  $tpl->data = Db::run()->select(Shop::vTable, null, array("parent_id" => 0))->results();
		  endif;
          print $tpl->render();
      break;
	  
      /* == Get Free Variants == */
      case "getFreeVariants":
		  $tpl = App::View(AMODPATH . 'shop/snippets/'); 
		  $tpl->template = 'getFreeVariants.tpl.php'; 
		  
		  $tpl->row = Db::run()->first(Shop::vTable, null, array("id" => Filter::$id));
		  $tpl->data = Db::run()->select(Shop::vTable, null, array("parent_id" => Filter::$id))->results();
		  
          print $tpl->render();
      break;
	  
      /* == Sales Chart == */
      case "salesChart":
		  $data = Shop::salesChart();
		  print json_encode($data);
      break;
	  
      /* == All Payments == */
      case "transactions":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=Payments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'User', 'Item', 'Variant', 'Coupon', 'TAX/VAT', 'Amount', 'Processor', 'Currency', 'IP', 'Status', 'Created'));

		  $from = isset($_GET['fromdate_submit']) ? Validator::sanitize($_GET['fromdate_submit'], "string", 10) : null;
		  $end = isset($_GET['enddate_submit']) ? Validator::sanitize($_GET['enddate_submit'], "string", 10) : null;
		  
		  $result = Shop::allPayments($from, $end);
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
			  fclose($data);
		  endif;
      break;

      /* == Item Chart == */
      case "itemChart":
		  $data = Shop::itemChart(Filter::$id);
		  print json_encode($data);
      break;

      /* == Item Payments == */
      case "itemPayments":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=ItemPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'User', 'Variant', 'Amount', 'TAX/VAT', 'Coupon', 'Total Amount', 'Currency', 'Processor', 'Created'));
		  
		  $result = Shop::itemPayments(Filter::$id);
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
			  fclose($data);
		  endif;
      break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Item == */
      case "processItem":
          App::Shop()->processItem();
      break;
      /* == Process Variation == */
      case "processVariation":
          App::Shop()->processVariation();
      break;
      /* == Process Category == */
      case "processCategory":
          App::Shop()->processCategory();
      break;
      /* == Process Shipping == */
      case "processShipping":
          App::Shop()->processShipping();
      break;
      /* == Process Configuration == */
      case "processConfig":
          App::Shop()->processConfig();
      break;

      /* == Process Images == */
      case "processImages":
		  $num_files = count($_FILES['images']['tmp_name']);
		  $filedir = FMODPATH . Shop::SHOPDATA . Filter::$id;
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
				  $img->bestFit(App::Shop()->thumb_w, App::Shop()->thumb_h)->save($filedir . '/thumbs/' . $name);
			  } catch(Exception $e) {
				  echo 'Error: ' . $e->getMessage();
			  }
			  
			  $last_id = Db::run()->insert(Shop::gTable, array("parent_id" => Filter::$id, "name" => $name))->getLastInsertId();
			  print '
                <div class="columns" id="item_' . $last_id . '" data-id="' . $last_id . '">
                  <div class="wojo attached card center aligned"><img src="' . Shop::hasThumb($name, Filter::$id) . '" alt="" class="wojo normal rounded center image">
                    <a data-set=\'{"option":[{"delete": "deleteImage","id":' . $last_id . '}], "url":"modules_/shop","action":"delete", "parent":"#item_' . $last_id . '"}\' class="wojo small icon white middle attached button data">
                    <i class="icon trash"></i></a>
                  </div>
                </div>';
		  endfor;
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
				  Db::run()->update(Shop::cTable, $data, array('id' => $value['id']));
			  endif;
		  endforeach; 
      break;
	  
      /* == Sort Images == */
      case "sortImages":
		  $i = 0;
		  $query = "UPDATE `" . Shop::gTable . "` SET `sorting` = CASE ";
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
	  
      /* == Sort Filters == */
      case "sortFilters":
		  $i = 0;
		  $query = "UPDATE `" . Shop::vTable . "` SET `sorting` = CASE ";
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