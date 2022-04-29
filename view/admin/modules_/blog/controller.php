<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(AMODPATH . 'blog/'));

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
          if ($res = Db::run()->delete(Blog::mTable, array("id" => Filter::$id))):
		      Db::run()->delete(Modules::mcTable, array("parent_id" => Filter::$id, "section" => "blog"));
			  File::deleteRecrusive(FMODPATH . Blog::BLOGDATA . Filter::$id, true);
          endif;

          $json['type'] = "success";
          $json['title'] = Lang::$word->SUCCESS;
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_AM_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
		  
      /* == Delete deleteCategory == */
      case "deleteCategory":
          if ($res = Db::run()->delete(Blog::cTable, array("id" => Filter::$id))):
		      Db::run()->delete(Blog::cTable, array("parent_id" => Filter::$id));
          endif;
		  $json['menu'] = Blog::getCategoryDropList(App::Blog()->categoryTree(), 0, 0, "&#166;&nbsp;&nbsp;&nbsp;&nbsp;");

          $json['type'] = "success";
          $json['title'] = Lang::$word->SUCCESS;
          $json['message'] = str_replace("[NAME]", $title, Lang::$word->_MOD_AM_CATDEL_OK);
		  print json_encode($json);
		  Logger::writeLog($json['message']);
          break;
		  
      /* == Delete Image == */
      case "deleteImage":
          if ($row = Db::run()->first(Blog::gTable, null, array("id" => Filter::$id))):
			  File::deleteFile(FMODPATH . Blog::BLOGDATA . $row->parent_id . '/' . $row->name);
			  File::deleteFile(FMODPATH . Blog::BLOGDATA . $row->parent_id . '/thumbs/' . $row->name);
			  Db::run()->delete(Blog::gTable, array("id" => Filter::$id));
			  $json['type'] = "success";
          else:
			  $json['type'] = "error";
          endif;
			  print json_encode($json);
          break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Item == */
      case "processItem":
          App::Blog()->processItem();
      break;
      /* == Process Category == */
      case "processCategory":
          App::Blog()->processCategory();
      break;
      /* == Process Configuration == */
      case "processConfig":
          App::Blog()->processConfig();
      break;
	  
      /* == Process Images == */
      case "processImages":
		  $num_files = count($_FILES['images']['tmp_name']);
		  $filedir = FMODPATH . Blog::BLOGDATA . Filter::$id;
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
				  $img->thumbnail(App::Blog()->thumb_w, App::Blog()->thumb_h)->save($filedir . '/thumbs/' . $name);
			  } catch(Exception $e) {
				  echo 'Error: ' . $e->getMessage();
			  }
			  
			  $last_id = Db::run()->insert(Blog::gTable, array("parent_id" => Filter::$id, "name" => $name))->getLastInsertId();
			  print '
                <div class="columns" id="item_' . $last_id . '" data-id="' . $last_id . '">
                  <div class="wojo attached fitted segment center aligned"><img src="' . Blog::hasThumb($name, Filter::$id) . '" alt="" class="wojo normal center image">
                    <a data-set=\'{"option":[{"delete": "deleteImage","id":' . $last_id . '}], "url":"/modules_/blog/controller.php","action":"delete", "parent":"#item_' . $last_id . '"}\' class="wojo small icon white middle attached button data">
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
				  Db::run()->update(Blog::cTable, $data, array('id' => $value['id']));
			  endif;
		  endforeach; 
      break;
	  
      /* == Sort Images == */
      case "sortImages":
		  $i = 0;
		  $query = "UPDATE `" . Blog::gTable . "` SET `sorting` = CASE ";
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