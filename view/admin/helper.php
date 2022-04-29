<?php
  /**
   * Helper
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: helper.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../init.php");
	  
  if (!App::Auth()->is_Admin())
      exit;

  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

    /* == GET Actions == */
  switch ($gAction) :
	   /* == Index Payments Chart == */
	  case "getIndexStats":
		  $data = Stats::indexSalesStats();
		  print json_encode($data);
	  break;
	
	  /* == Main Stats == */
	  case "getMainStats":
		  $data = Stats::getMainStats();
		  print json_encode($data);
	  break;
	  
	   /* == User Payments Chart == */
	  case "getUserPaymentsChart":
		  $data = Stats::getUserPaymentsChart(Filter::$id);
		  print json_encode($data);
	  break;

	   /* == Export User Payments == */
	  case "exportUserPayments":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=UserPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'Name', 'Amount', 'TAX/VAT', 'Coupon', 'Total Amount', 'Currency', 'Processor', 'Created'));
		  
		  $result = Stats::exportUserPayments(Filter::$id);
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
			  fclose($data);
		  endif;
	  break;
  
	   /* == Export Users == */
	  case "exportUsers":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=UserList.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('Name', 'Membership', 'Expire', 'Email', 'Newsletter', 'Created'));
		  
		  $result = Stats::exportUsers();
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
			  fclose($data);
		  endif;
	  break;

	  /* == Get Internal Links == */
	  case "getlinks":
		  $list = array();
		  $core = App::Core();
		  $data = Db::run()->select(Content::pTable, array("id", "title" . Lang::$lang, "slug" . Lang::$lang), array("active" => 1), "ORDER BY title" . Lang::$lang . " ASC")->results();
		  if ($data):
			  foreach ($data as $row):
				  if(Validator::get('is_builder')) :
					  $item = array(
						  'name' => $row->{'title' . Lang::$lang}, 
						  'href' => Url::url("/" . $core->pageslug, $row->{'slug' . Lang::$lang}), 
						  'id' => $row->id
					  );
				  else:
					  $item = array(
						  'name' => $row->{'title' . Lang::$lang}, 
						  'url' => Url::url("/" . $core->pageslug, $row->{'slug' . Lang::$lang}), 
						  'id' => $row->id
					  );
				  endif;
				 $list[] = $item;
			  endforeach;
		  endif;
		  if(Validator::get('is_builder')) :
			  $json['message'] = $list;
			  print json_encode($json);
		  else:
			  print json_encode($list);
		  endif;
	  break;

      /* == Remote Images == */
      case "getImages":
          $result = File::scanDirectory(UPLOADS . '/images', array("include" => array("jpg","jpeg","bmp","png","svg")), "name");
		  $list = array();
		  foreach($result['files'] as $row) :
		      $clean = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row['name']);
			  $item = array(
				  'url' => UPLOADURL . '/' . $row['url'], 
				  'thumb' => UPLOADURL . '/thumbs/' . $row['name'], 
				  'id' => strtolower($clean),
				  'name' => $clean,
			  );
			  $list[] = $item;
		  endforeach;
		  print json_encode($list);
          break;
		  
	  /* == Get Unused Plugins == */
	  case "getFreePlugins":
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/');
		  $tpl->template = 'getFreePlugins.tpl.php';
		  $tpl->section = Validator::sanitize($_GET['section']);
		  $tpl->data = App::Plugins()->getFreePugins(Utility::implodeFields(Validator::get('ids')));
		  $json['html'] = $tpl->render();
		  print json_encode($json);
	  break;
	  
	  /* == Get Content Type == */
	  case "contenttype":
		  $type = Validator::sanitize($_GET['type'], "alpha");
		  $html = '';
		  switch ($type):
			  case "page":
				  $data = Db::run()->select(Content::pTable, array("id", "title" . Lang::$lang), array("active" => 1), "ORDER BY title" . Lang::$lang . " ASC")->results();
				  if ($data):
					  foreach ($data as $row):
						  $html .= "<option value=\"" . $row->id . "\">" . $row->{'title' . Lang::$lang} . "</option>\n";
					  endforeach;
					  $json['type'] = 'page';
				  endif;
				  break;
	
			  case "module":
				  $data = Db::run()->select(Modules::mTable, array("id", "title" . Lang::$lang), array("active" => 1, "is_menu" => 1), "ORDER BY title" . Lang::$lang . " ASC")->results();
				  if ($data):
					  foreach ($data as $row):
						  $html .= "<option value=\"" . $row->id . "\">" . $row->{'title' . Lang::$lang}  . "</option>\n";
					  endforeach;
					  $json['type'] = 'module';
				  endif;
				  break;
				  
			  default:
				  $json['type'] = 'web';
				  
		  endswitch;
		  $json['message'] = $html;
		  print json_encode($json);
	  break;
	  
	  /* == Get membership List == */
	  case "membershiplist":
		  if ($_GET['type'] == "Membership"):
			  $json['status'] = 'success';
			  $json['html'] = Utility::loopOptionsMultiple(App::Membership()->getMembershipList(), "id", "title" . Lang::$lang, false, "membership_id");
		  else:
			  $json['status'] = 'none';
		  endif;
			  print json_encode($json);
	  break;
	  
	  /* == Get Language Section == */
	  case "languageSection":
		  if(File::exists(BASEPATH . Lang::langdir . "/" . $_GET['abbr'] . "/lang.xml")):
			  $xmlel = simplexml_load_file(BASEPATH . Lang::langdir . "/" . $_GET['abbr'] . "/lang.xml");
			  $section = $xmlel->xpath('/language/phrase[@section="' . Validator::sanitize($_GET['section']) . '"]');
			  $tpl = App::View(BASEPATH . 'view/admin/snippets/'); 
			  $tpl->xmlel = $xmlel;
			  $tpl->section = $section;
			  $tpl->type = $_GET['type'];
			  $tpl->abbr = $_GET['abbr'];
			  $tpl->template = 'loadLanguageSection.tpl.php'; 
			  $json['html'] = $tpl->render(); 
		  else:
			  $json['type'] = "error";
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = Lang::$word->FU_ERROR15;
		  endif;
		  print json_encode($json);
	  break;

	  /* == Get Language File == */
	  case "languagefile":
		  if (File::exists(BASEPATH . Lang::langdir . $_GET['abbr'] . "/" . $_GET['section'])):
			  $xmlel = simplexml_load_file(BASEPATH . Lang::langdir . $_GET['abbr'] . "/" . $_GET['section']);
			  $tpl = App::View(BASEPATH . 'view/admin/snippets/');
			  $tpl->xmlel = $xmlel;
			  $tpl->section = null;
			  $tpl->fpath = $_GET['section'];
			  $tpl->type = $_GET['type'];
			  $tpl->abbr = $_GET['abbr'];
			  $tpl->template = 'loadLanguageSection.tpl.php';
			  $json['html'] = $tpl->render();
			  $json['type'] = "success";
		  else:
			  $json['type'] = "error";
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = Lang::$word->FU_ERROR15;
		  endif;
		  print json_encode($json);
	  break;
		  
	  /* == Edit Role == */
	  case "editRole":
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/'); 
		  $tpl->data = Db::run()->first(Users::rTable, null, array('id' => Filter::$id));
		  $tpl->template = 'editRole.tpl.php'; 
		  echo $tpl->render(); 
	  break;

	  /* == Copy Page == */
	  case "copyPage":
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/'); 
		  $tpl->core = App::Core();
		  $tpl->data = Db::run()->first(Content::pTable, null, array('id' => Filter::$id));
		  $tpl->template = 'copyPage.tpl.php'; 
		  echo $tpl->render(); 
	  break;
	  
	   /* == Site Sales Chart == */
	  case "getSalesChart":
		  $data = Stats::getAllSalesStats();
		  print json_encode($data);
	  break;
	
	   /* == Export All Payments == */
	  case "exportAllTransactions":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=AllPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'Item', 'User', 'Amount', 'TAX/VAT', 'Coupon', 'Total Amount', 'Currency', 'Processor', 'Created'));
		  
		  $from = isset($_GET['fromdate_submit']) ? Validator::sanitize($_GET['fromdate_submit'], "string", 10) : null;
		  $end = isset($_GET['enddate_submit']) ? Validator::sanitize($_GET['enddate_submit'], "string", 10) : null;
		  
		  $result = Stats::exportAllTransactions($from, $end);
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
		  endif;
	  break;

	  /* == Resend Notification == */
	  case "resendNotification":
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/'); 
		  $tpl->template = 'resendNotification.tpl.php'; 
		  $tpl->data = Db::run()->first(Users::mTable, array("id", "email", "CONCAT(fname,' ',lname) as name"), array('id' => Filter::$id));
		  echo $tpl->render(); 
	  break;
		  
      /* == Get Files == */
      case "getFiles":
          $include = null;
          if ($type = Validator::notEmptyGet('exts')):
              switch ($type) {
                  case "doc":
                      $include = array("include" => array(
                              "txt",
                              "doc",
                              "docx",
                              "pdf",
                              "xls",
                              "xlsx",
                              "css",
                              "nfo"));
                      break;

                  case "pic":
                      $include = array("include" => array(
                              "jpg",
                              "jpeg",
							  "svg",
                              "bmp",
                              "png"));
                      break;

                  case "vid":
                      $include = array("include" => array(
                              "mp4",
                              "avi",
                              "sfw",
                              "webm",
                              "ogv",
                              "mov"));
                      break;

                  case "aud":
                      $include = array("include" => array("mp3", "wav"));
                      break;

                  default:
                      $include = null;
                      break;
              }

          endif;

          $result = File::scanDirectory(File::validateDirectory(UPLOADS, Validator::get('dir')), $include, Validator::get('sorting'));
          print json_encode($result);
      break;
	  
	   /* == Export Membership Payments == */
	  case "exportMembershipPayments":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=MembershipPayments.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('TXN ID', 'User', 'Amount', 'TAX/VAT', 'Coupon', 'Total Amount', 'Currency', 'Processor', 'Created'));
		  
		  $result = Stats::exportMembershipPayments(Filter::$id);
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
			  fclose($data);
		  endif;
	  break;

	  /* == Get Plugin Layout == */
	  case "getPluginLayout":
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/');
		  $tpl->template = 'getPluginLayout.tpl.php';
		  $tpl->section = Validator::sanitize($_GET['section']);
		  $tpl->data = App::Plugins()->getPluginSpaces(Utility::implodeFields($_GET['ids']));
		  $json['html'] = $tpl->render();
		  print json_encode($json);
	  break;
		  
	   /* == Membership Payments Chart == */
	  case "getMembershipPaymentsChart":
		  $data = Stats::getMembershipPaymentsChart(Filter::$id);
		  print json_encode($data);
	  break;

	  /* == Load Editors Page == */
	  case "loadPage":
		  $lang = Validator::sanitize($_GET['lang'], "string", 2);
		  if($row = Db::run()->first(Content::pTable, array("body_" . $lang), array("id" => Filter::$id))):
			 print Content::parseContentData($row->{'body_' . $lang}, true);
		  endif; 
	  break;
	  
	  /* == Get Builder Section == */
	  case "bsection":
		  if (File::getFile(BUILDERBASE . '/themes/' . $_GET['file'] . '.tpl.php')):
			  $file = File::loadFile(BUILDERBASE . '/themes/' . $_GET['file'] . '.tpl.php');
			  $file = str_replace("[SITEURL]", SITEURL, $file);
			  $json['html'] = $file;
			  $json['status'] = 'success';
		  else:
			  $json['status'] = 'error';
		  endif;
			  print json_encode($json);
	  break;
		  
	  /* == Load Builder Modules == */
	  case "loadBuilderModules":
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/');
		  $tpl->template = 'loadBuilderModules.tpl.php';
		  if(isset($_GET['modalias'])) {
			  $tpl->data = App::Modules()->getAvailModules(Utility::implodeFields($_GET['modalias'], ',', true));
		  } else {
			  $tpl->data = App::Modules()->getAllAvailModules();
		  }

		  if($tpl->data):
			 $json['html'] = $tpl->render();
			 $json['status'] = 'success';
		  else:
			 $json['status'] = 'error';
		  endif;
		  print json_encode($json);
	  break;
	  
	  /* == Get Builder Modules == */
	  case "builderModule":
		  if($row = Db::run()->first(Modules::mTable, array("id as module_id", "title" . Lang::$lang . " as title", "modalias", "parent_id as id"), array("id" => Filter::$id))):
			  if(File::is_File(FMODPATH . $row->modalias . "/themes/" . App::Core()->theme . "/index.tpl.php")) :
				 $content = Utility::getSnippets(FMODPATH . $row->modalias . "/themes/" . App::Core()->theme . "/index.tpl.php", $data = (array)$row);
			  else:
				 $content = Utility::getSnippets(FMODPATH . $row->modalias . "/index.tpl.php", $data = (array)$row);
			  endif;
			  
			  $assets = Modules::parseModuleAssets('%%' . $row->modalias . '|module|0|0"%%');
			  
			  $json['status'] = "success";
			  $json['html'] = $content;
			  $json['assets'] = $assets;
			  $json['assets_id'] = $row->modalias;
		  else:
			  $json['status'] = "error";
			  $json['html'] = '';  
		  endif;
		  print json_encode($json);
	  break;
	  
	  /* == Get Builder Plugin == */
	  case "builderPlugin":
		  if($row = Db::run()->first(Plugins::mTable, array("id", "title" . Lang::$lang . " as title", "body" . Lang::$lang . " as body",  "plugalias", "groups", "alt_class", "plugin_id", "show_title"), array("id" => Filter::$id))):
			  $data = ["plugin_id" => $row->plugin_id, "id" => $row->id, "all" => array($row)];
			  if(File::is_File(FPLUGPATH . $row->plugalias . "/themes/" . App::Core()->theme . "/index.tpl.php")) :
				 $content = Utility::getSnippets(FPLUGPATH . $row->plugalias . "/themes/" . App::Core()->theme . "/index.tpl.php", $data);
			  else:
				 $content = Utility::getSnippets(FPLUGPATH . $row->plugalias . "/index.tpl.php", $data);
			  endif;
			  
			  $json['status'] = "success";
			  $json['html'] = $content;
		  else:
			  $json['status'] = "error";
			  $json['html'] = '';  
		  endif;
		  print json_encode($json);
	  break;
	  /* == Load Builder Plugin == */
	  case "loadBuilderPlugins":
		  $tpl = App::View(BASEPATH . 'view/admin/snippets/');
		  $tpl->template = 'loadBuilderPlugins.tpl.php';
		  $tpl->data = App::Plugins()->getAvailPugins(Utility::implodeFields($_GET['ids']));
		  $json['html'] = $tpl->render();
		  print json_encode($json);
	  break;
	  
	  /* == Get Builder User Plugin == */
	  case "builderUserPlugin":
		  if($row = Db::run()->first(Plugins::mTable, array("id", "title" . Lang::$lang . " as title", "body" . Lang::$lang . " as body", "show_title", "alt_class"), array("id" => Filter::$id))):
			  $json['status'] = "success";
			  $json['html'] = Url::out_url($row->body);
		  else:
			  $json['status'] = "error";
			  $json['html'] = '';  
		  endif;
		  print json_encode($json);
	  break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction) :
	  /* == Process Notification == */
	  case "resendNotification":
		  App::Users()->resendNotification();
	  break;
	  
	  /* == Chnage Coupon Status == */
	  case "couponStatus":
		  Db::run()->update(Content::dcTable, array("active" => intval($_POST['active'])), array("id" => Filter::$id));
	  break;
	  
	  /* == Update Language Phrase == */
	  case "editPhrase":
		  if (file_exists(BASEPATH . Lang::langdir . "/" . $_POST['path'])):
			  $xmlel = simplexml_load_file(BASEPATH . Lang::langdir . "/" . $_POST['path']);
			  $node = $xmlel->xpath("/language/phrase[@data = '" . $_POST['key'] . "']");
			  $node[0][0] = $title;
			  $xmlel->asXML(BASEPATH . Lang::langdir . "/" . $_POST['path']);
			  
			  $json['title'] = $title;
			  print json_encode($json);
		  endif;
	  break;  

	  /* == Copy Page == */
	  case "copyPage":
		  App::Content()->copyPage();
	  break; 
	  
	  /* == Update Role Description == */
	  case "editRole":
		  App::Users()->updateRoleDescription();
	  break;  
	  
	  /* == Chnage Role == */
	  case "changeRole":
		  if(Auth::checkAcl("owner")):
			  Db::run()->update(Users::rpTable, array("active" => intval($_POST['active'])), array("id" => Filter::$id));
		  endif;
	  break;
	  
	  /* == Chnage Gateway Status == */
	  case "gatewayStatus":
		  if(Auth::checkAcl("owner")):
			  Db::run()->update(Core::gTable, array("active" => intval($_POST['active'])), array("id" => Filter::$id));
		  endif;
	  break;
	  
	  /* == Update Country Tax == */
	  case "editTax":
		  if (empty($_POST['title'])):
			  print '0.000';
			  exit;
		  endif;
			  $data['vat'] = Validator::sanitize($_POST['title'], "float");
			  Db::run()->update(Content::cTable, $data, array('id' => Filter::$id));
		  
		  $json['title'] = $title;
		  print json_encode($json);			  
	  break;
	  
      /* == New Folder == */
      case "newFolder":
          if (isset($_POST['name'])):
              if(File::makeDirectory(UPLOADS . '/' . Validator::sanitize($_POST['dir'] . '/' . $_POST['name'], "file"))) :
			     $json['type'] = "success";
				 else:
				 $json['error'] = "error";
			  endif;
			  print json_encode($json);
          endif;
          break;
		  
      /* == Delete Files Folders == */
      case "deleteFiles":
          if (isset($_POST['items'])):
              foreach ($_POST['items'] as $item):
                  File::deleteMulti(UPLOADS . '/' . $item);
                  File::deleteMulti(UPLOADS . '/thumbs/' . $item);
              endforeach;
			  $json['type'] = "success";
			  print json_encode($json);
          endif;
          break;
		  
      /* == Unzip File == */
      case "unzipFile":
          if (isset($_POST['item'])):
		      $dir = pathinfo(UPLOADS . '/' . $_POST['item']);
              if(File::unzip(UPLOADS . '/' . $_POST['item'], $dir['dirname'])) :
			     $json['type'] = "success";
				 else:
				 $json['error'] = "error";
			  endif;
			  print json_encode($json);
          endif;
          break;

      /* == File Upload == */
      case "uploadFile":
          if (!empty($_FILES['file']['name'])):
		      $dir = File::validateDirectory(UPLOADS, Validator::post('dir')) . '/';
		      $upl = Upload::instance(App::Core()->file_size, App::Core()->file_ext);
			  $upl->process("file", $dir, false, $_FILES['file']['name'], false);
			  if (empty(Message::$msgs)):
				  $img = new Image($dir . $upl->fileInfo['fname']);
				  if ($img->originalInfo['width']):
					  try {
						  $img = new Image($dir. $upl->fileInfo['fname']);
						  $img->fitToWidth(App::Core()->img_w)->save($dir . $upl->fileInfo['fname']);
						  $img->fitToWidth(App::Core()->thumb_w)->save(UPLOADS . '/thumbs/' . $upl->fileInfo['fname']);
						  
						  rename($dir . $upl->fileInfo['fname'], $dir . str_replace(" ", "", $upl->fileInfo['fname']));
						  rename(UPLOADS . '/thumbs/' .  $upl->fileInfo['fname'], UPLOADS . '/thumbs/' . str_replace(" ", "", $upl->fileInfo['fname']));
						  
					  }
					  catch (exception $e) {
						  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
					  }
					  $json['filename'] = UPLOADURL . '/' . Validator::post('dir') . '/' . str_replace(" ", "", $upl->fileInfo['fname']);
				  else:
					  $json['filename'] = ADMINVIEW . "/images/mime/" . $upl->fileInfo['ext'] . ".png";
				  endif;
			  $json['type'] = "success";
			  else:
				  $json['type'] = "error";
				  $json['filename'] = '';
				  $json['message'] = Message::$msgs['name'];
			  endif;
			  print json_encode($json);
          endif;
          break;
		  
	      // Search Pages
          case "searchPage":
		      $string = Validator::sanitize($_POST['value'], 'string', 15);
              if (strlen($string) > 3):
                  $sql = "
					SELECT 
					  id,
					  title" . Lang::$lang . "
					FROM
					  `" . Content::pTable . "`
					WHERE MATCH (title" . Lang::$lang . ") AGAINST ('" . $string . "*' IN BOOLEAN MODE)
					ORDER BY title" . Lang::$lang . " 
					LIMIT 10 ";

                  $html = '';
                  if ($result = Db::run()->pdoQuery($sql)->results()):
                      $html .= '<table class="wojo basic dashed table">';
                      foreach ($result as $row):
                          $link = Url::url("/admin/pages/edit", $row->id);
                          $html .= '<tr>';
                          $html .= '<td>';
                          $html .= '<span class="wojo simple label">' . $row->id . '</span>';
                          $html .= '</td>';
                          $html .= '<td class="wojo medium text">';
                          $html .= '<a href="' . $link . '">' . $row->{'title' . Lang::$lang} . '</a>';
                          $html .= '</td>';
                          $html .= '</tr>';
                      endforeach;
                      $html .= '</table>';
					  $json['html'] = $html;
					  $json['status'] = 'success';
                  else:
					  $json['status'] = 'error';
                  endif;
				  print json_encode($json);
              endif;
          break;
		  
	      // Search Plugins
          case "searchPlugin":
		      $string = Validator::sanitize($_POST['value'], 'string', 15);
              if (strlen($string) > 3):
                  $sql = "
					SELECT 
					  id,
					  hasconfig,
					  plugalias,
					  title" . Lang::$lang . "
					FROM
					  `" . Plugins::mTable . "`
					WHERE MATCH (title" . Lang::$lang . ") AGAINST ('" . $string . "*' IN BOOLEAN MODE)
					ORDER BY title" . Lang::$lang . " 
					LIMIT 10 ";

                  $html = '';
                  if ($result = Db::run()->pdoQuery($sql)->results()):
                      $html .= '<table class="wojo basic dashed table">';
                      foreach ($result as $row):
						  $link = Url::url("/admin/plugins/edit", $row->id);
                          $html .= '<tr>';
                          $html .= '<td>';
                          $html .= '<span class="wojo simple label">' . $row->id . '</span>';
                          $html .= '</td>';
                          $html .= '<td class="wojo large text">';
                          $html .= '<a href="' . $link . '">' . $row->{'title' . Lang::$lang} . '</a>';
                          $html .= '</td>';
						  if($row->hasconfig):
							  $html .= '<td class="auto">';
							  $html .= '<a href="' . Url::url("/admin/plugins", $row->plugalias) . '" class="wojo icon basic circular small button"><i class="icon cogs"></i></a>';
							  $html .= '</td>';
						  endif;
                          $html .= '</tr>';
                      endforeach;
                      $html .= '</table>';
					  $json['html'] = $html;
					  $json['status'] = 'success';
                  else:
					  $json['status'] = 'error';
                  endif;
				  print json_encode($json);
              endif;
          break;
		  
      /* == Editor Upload == */
      case "eupload":
		  if (!empty($_FILES['file']['name'])):
			  $dir = UPLOADS . '/images/';
			  $num_files = count($_FILES['file']['tmp_name']);
			  $jsons = [];
			  $exts = ['image/png', 'image/jpg', 'image/gif', 'image/jpeg', 'image/pjpeg'];
		
			  foreach ($_FILES['file']['name'] as $x => $name):
				  $ext = substr(strrchr($_FILES['file']["name"][$x], '.'), 1);
				  $image = $_FILES['file']["name"][$x];
				  if ($_FILES["file"]["tmp_name"][$x] > App::Core()->file_size):
					  $json['error'] = true;
					  $json['type'] = "error";
					  $json['title'] = Lang::$word->ERROR;
					  $json['message'] = Message::$msgs['name'] = Lang::$word->FU_ERROR10 . ' ' . File::getSize($maxSize);
					  print json_encode($json);
					  exit;
				  endif;
		
				  $ext = strtolower($_FILES['file']['type'][$x]);
				  if (!in_array($ext, $exts)):
					  $json['error'] = true;
					  $json['type'] = "error";
					  $json['title'] = Lang::$word->ERROR;
					  $json['message'] = Message::$msgs['name'] = Lang::$word->FU_ERROR8 . "jpg, png, jpeg"; //invalid extension
					  print json_encode($json);
					  exit;;
				  endif;

				  if (file_exists($dir . $image)):
					  $json['error'] = true;
					  $json['type'] = "error";
					  $json['title'] = Lang::$word->ERROR;
					  $json['message'] = Message::$msgs['name'] = Lang::$word->FU_ERROR6; //file exists
					  print json_encode($json);
					  exit;;
				  endif;
				  
				  if (getimagesize($_FILES['file']["tmp_name"][$x]) == false):
					  $json['error'] = true;
					  $json['type'] = "error";
					  $json['title'] = Lang::$word->ERROR;
					  $json['message'] = Message::$msgs['name'] = Lang::$word->FU_ERROR7; //invalid image
					  print json_encode($json);
					  exit;;
				  endif;
		
				  if (!move_uploaded_file($_FILES['file']['tmp_name'][$x], $dir . $image)):
					  $json['error'] = true;
					  $json['type'] = "error";
					  $json['title'] = Lang::$word->ERROR;
					  $json['message'] = Message::$msgs['name'] = Lang::$word->FU_ERROR13; //cant move  image
					  print json_encode($json);
					  exit;;
				  endif;
		
				  if (empty(Message::$msgs)):
					  try {
						  $img = new Image($dir . $image);
						  $img->fitToWidth(App::Core()->img_w)->save($dir . $image);
						  $img->fitToWidth(App::Core()->thumb_w)->save(UPLOADS . '/thumbs/' . $image);
						  
						  $jsons['file-'.$x] = array(
						      'url' => UPLOADURL . '/images/' . $image, 'id' => $x
						  );
					  }
					  catch (exception $e) {
						  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
					  }
				  endif;
			  endforeach;
			  print json_encode($jsons);
		  endif;
          break;
  endswitch;
		  	  
  /* == Instant Actions == */
  switch ($iAction) :
	  /* == Sort Menus == */
	  case "sortMenus":
		  $jsonstring = $_POST['sortlist'];
		  $jsonDecoded = json_decode($jsonstring, true, 12);
		  $result = Utility::parseJsonArray($jsonDecoded);
		  $i = 0;
		  foreach ($result as $value):
			  if (is_array($value)):
				  $i++;
				  $data = array('position' => $i, 'parent_id' => $value['parent_id']);
				  Db::run()->update(Content::mTable, $data, array('id' => $value['id']));
			  endif;
		  endforeach; 
          break;
          
		  /* == Language Color == */
          case "langColor":
              $color = Validator::sanitize($_POST['color'], "string", 7);
              if (Db::run()->update(Lang::lTable, array('color' => $color), array("id" => Filter::$id))):
                  $data = Lang::getLanguages();
                  Db::run()->update(Core::sTable, array('lang_list' => json_encode($data)), array("id" => 1));
              endif;
          break;
	  break;
		  
	   /* == Sort Custom Fields == */
	  case "sortFields":
		  $i = 0;
		  $query = "UPDATE `" . Content::cfTable . "` SET `sorting` = CASE ";
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
	  
	  /* == Database Backup == */
	  case "databaseBackup":
		  dbTools::doBackup();
	  break;

	  /* == Sort Layout == */
	  case "sortLayout":
		  $type = Validator::sanitize($_POST['type']);
		  $place = Validator::sanitize($_POST['position']);
		  $is_page = null;
		  if ($type == "page_id"):
			  $and = " AND page_id = " . intval($_POST['page']);
			  $is_page = "`type` = 'page',";
		  else:
			  $and = " AND mod_id = " . intval($_POST['mod'][0]['id']);
		  endif;

		  $i = 0;
		  $query = "UPDATE `" . Plugins::lTable . "` SET `place` = '" . $place . "', $is_page `sorting` = CASE ";
		  $idlist = '';
		  foreach ($_POST['items'] as $item):
			  $i++;
			  $query .= " WHEN plug_id = " . $item . " THEN " . $i . " ";
			  $idlist .= $item . ',';
		  endforeach;
		  $idlist = substr($idlist, 0, -1);
		  $query .= "
			  END
			  WHERE plug_id IN (" . $idlist . ")";
		  $query .= $and;
		  Db::run()->pdoQuery($query);
	  break;

	  /* == Delete LayoutPlugin == */
	  case "deleteLayout":
		  $type = Validator::sanitize($_POST['type']);
		  if ($type == "page_id"):
			  $array = array("plug_id" => Filter::$id, "page_id" => intval($_POST['page']));
		  else:
			  $array = array("plug_id" => Filter::$id, "mod_id" => intval($_POST['mod'][0]['id']));
		  endif;

		  if (Db::run()->delete(Plugins::lTable, $array)):
			  $json['type'] = "success";
		  else:
			  $json['type'] = "error";
		  endif;
		  $json['title'] = Lang::$word->SUCCESS;
		  print json_encode($json);
	  break;

	  /* == Update Layout == */
	  case "updateLayout":
		  $type = Validator::sanitize($_POST['type']);
		  $is_page = null;
		  if ($type == "page_id"):
			  $and = " AND page_id = " . intval($_POST['page']);
			  $is_page = "`type` = 'page',";
		  else:
			  $and = " AND mod_id = " . intval($_POST['mod'][0]['id']);
		  endif;

		  $query = "UPDATE `" . Plugins::lTable . "` SET $is_page `space` = CASE ";
		  $idlist = '';
		  foreach ($_POST['items'] as $item):
			  $id = Validator::sanitize($item['name'], "int");
			  $space = Validator::sanitize($item['value'], "int");
			  $query .= " WHEN id = " . $id . " THEN " . $space . " ";
			  $idlist .= $id . ',';
		  endforeach;
		  $idlist = substr($idlist, 0, -1);
		  $query .= "
				  END
				  WHERE id IN (" . $idlist . ")";
		  $query .= $and;
		  Db::run()->pdoQuery($query);
	  break;

	  /* == Insert Layout == */
	  case "insertLayout":
		  $type = Validator::sanitize($_POST['type']);
		  $place = Validator::sanitize($_POST['position']);

		  if ($type == "page_id"):
			  foreach ($_POST['items'] as $item):
				  $dataArray[] = array(
					  'plug_id' => $item,
					  'place' => $place,
					  'page_id' => intval($_POST['page']),
					  'type' => "page_id");
			  endforeach;
		  else:
			  foreach ($_POST['items'] as $item):
				  $dataArray[] = array(
					  'plug_id' => $item,
					  'place' => $place,
					  'mod_id' => intval($_POST['mod'][0]['id']),
					  'modalias' => Validator::sanitize($_POST['mod'][0]['modalias']),
					  'type' => "mod_id");
			  endforeach;
		  endif;
		  Db::run()->insertBatch(Plugins::lTable, $dataArray);
	  break;
		  
  endswitch;

		  
  /* == Clear Session Temp Queries == */
  if (isset($_GET['ClearSessionQueries'])):
      App::Session()->remove('debug-queries');
	  App::Session()->remove('debug-warnings');
	  App::Session()->remove('debug-errors');
	  print 1;
  endif;