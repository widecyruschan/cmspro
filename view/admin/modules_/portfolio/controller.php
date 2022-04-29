<?php
  /**
   * Portfolio
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
	  
  Bootstrap::Autoloader(array(AMODPATH . 'portfolio/'));

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
          if ($res = Db::run()->delete(Portfolio::mTable, array("id" => Filter::$id))):
			  File::deleteRecrusive(FMODPATH . Portfolio::PORTDATA . Filter::$id, true);
			  Db::run()->delete(Content::cfdTable, array("portfolio_id" => Filter::$id));
          endif;
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_PF_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
      /* == Delete deleteCategory == */
      case "deleteCategory":
          $res = Db::run()->delete(Portfolio::cTable, array("id" => Filter::$id));

          $message = str_replace("[NAME]", $title, Lang::$word->_MOD_PF_CAT_DEL_OK);
		  Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
      /* == Delete Image == */
      case "deleteImage":
          if ($row = Db::run()->first(Portfolio::gTable, null, array("id" => Filter::$id))):
			  File::deleteFile(FMODPATH . Portfolio::PORTDATA . $row->parent_id . '/' . $row->name);
			  File::deleteFile(FMODPATH . Portfolio::PORTDATA . $row->parent_id . '/thumbs/' . $row->name);
			  Db::run()->delete(Portfolio::gTable, array("id" => Filter::$id));
			  $json['type'] = "success";
          else:
			  $json['type'] = "error";
          endif;
			  print json_encode($json);
          break;
  endswitch;

  /* == Get Actions == */
  switch ($gAction):
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Item == */
      case "processItem":
          App::Portfolio()->processItem();
      break;
      /* == Process Category == */
      case "processCategory":
          App::Portfolio()->processCategory();
      break;
      /* == Process Configuration == */
      case "processConfig":
          App::Portfolio()->processConfig();
      break;

      /* == Process Images == */
      case "processImages":
		  $num_files = count($_FILES['images']['tmp_name']);
		  $filedir = FMODPATH . Portfolio::PORTDATA . Filter::$id;
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
				  $img->bestFit(App::Portfolio()->thumb_w, App::Portfolio()->thumb_h)->save($filedir . '/thumbs/' . $name);
			  } catch(Exception $e) {
				  echo 'Error: ' . $e->getMessage();
			  }
			  
			  $last_id = Db::run()->insert(Portfolio::gTable, array("parent_id" => Filter::$id, "name" => $name))->getLastInsertId();
			  print '
                <div class="columns" id="item_' . $last_id . '" data-id="' . $last_id . '">
                  <div class="wojo attached fitted segment center aligned"><img src="' . Portfolio::hasThumb($name, Filter::$id) . '" alt="" class="wojo normal center image">
                    <a data-set=\'{"option":[{"delete": "deleteImage","id":' . $last_id . '}], "url":"/modules_/portfolio/controller.php","action":"delete", "parent":"#item_' . $last_id . '"}\' class="wojo small icon white middle attached button data">
                    <i class="icon trash"></i></a>
                  </div>
                </div>';
		  endfor;
      break;
  endswitch;
  
  /* == Instant Actions == */
  switch ($iAction):
      /* == Sort Images == */
      case "sortImages":
		  $i = 0;
		  $query = "UPDATE `" . Portfolio::gTable . "` SET `sorting` = CASE ";
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
	  
      /* == Sort Categories == */
      case "sortCategories":
		  $jsonstring = $_POST['sortlist'];
		  $jsonDecoded = json_decode($jsonstring, true, 12);
		  $result = Utility::parseJsonArray($jsonDecoded);
		  $i = 0;
		  $query = "UPDATE `" . Portfolio::cTable . "` SET `sorting` = CASE ";
		  $idlist = '';
		  foreach ($result as $item):
			  $i++;
			  $query .= " WHEN id = " . $item['id'] . " THEN " . $i . " ";
			  $idlist .= $item['id'] . ',';
		  endforeach;
		  $idlist = substr($idlist, 0, -1);
		  $query .= "
				  END
				  WHERE id IN (" . $idlist . ")";
		  Db::run()->pdoQuery($query);
      break;
  endswitch;