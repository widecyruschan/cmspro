<?php
  /**
   * Controller
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../../init.php");

  Bootstrap::Autoloader(array(AMODPATH . 'digishop/'));

  $action = Validator::request('action');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Actions == */
  switch ($action):
      /* == Add to cart == */
      case "add":
          if (Filter::$id and $row = Db::run()->first(Digishop::mTable, array(
              "id",
              "title" . Lang::$lang . " AS title",
              "slug" . Lang::$lang . " AS slug",
              "price",
              "thumb",
              "membership_id",
              "price"), array(
              "id" => Filter::$id,
              "membership_id" => 0,
              "active" => 1))):
			  $tax = Membership::calculateTax();
              $data = array(
                  'uid' => App::Auth()->sesid,
                  'pid' => $row->id,
                  'originalprice' => Validator::sanitize($row->price, "float"),
                  'total' => Validator::sanitize($row->price, "float"),
                  'totalprice' => Validator::sanitize($row->price, "float"),
                  );
              Db::run()->insert(Digishop::qTable, $data);
			  
			  $tpl = App::View(File::isThemeDir(FMODPATH . 'digishop/themes/' . App::Core()->theme . '/snippets/', FMODPATH . 'digishop/snippets/'));
			  $tpl->template = '_cart.tpl.php';
			  $tpl->data = Digishop::getCartContent();
			  
			  $json['html'] = $tpl->render();
              $json['status'] = 'success';
          else:
              $json['status'] = 'error';
          endif;
          print json_encode($json);
      break;
	  
      /* == Remove from cart == */
      case "remove":
          if (Filter::$id) :
		      Db::run()->delete(Digishop::qTable, array("pid" => Filter::$id, "uid" => App::Auth()->sesid));
			  $tpl = App::View(File::isThemeDir(FMODPATH . 'digishop/themes/' . App::Core()->theme . '/snippets/', FMODPATH . 'digishop/snippets/'));
			  $tpl->template = '_cart.tpl.php';
			  $tpl->data = Digishop::getCartContent();

			  $json['html'] = $tpl->render();
              $json['status'] = 'success';
          else:
              $json['status'] = 'error';
          endif;
          print json_encode($json);
      break;
	  
      /* == Like Item == */
      case "like":
          if(Filter::$id) :
			  Db::run()->pdoQuery("
				  UPDATE `" . Digishop::mTable . "` 
				  SET likes = likes + 1
				  WHERE id = '" . Filter::$id . "'
			  ");
		  endif;
      break;
	
      /* == Search == */
      case "search":
          if(Validator::get('string')) :
		      $string = Validator::sanitize($_GET['string'], "db");
              if (strlen($string) > 3) :
                  $sql = "
					SELECT 
					  id,
					  thumb,
					  title" . Lang::$lang . " as title,
					  slug" . Lang::$lang . " as slug
					FROM
					  `" . Digishop::mTable . "`
					WHERE MATCH (title" . Lang::$lang . ") AGAINST ('" . $string . "*' IN BOOLEAN MODE)
					ORDER BY title" . Lang::$lang . " 
					LIMIT 10 ";

                  $html = '';
                  if ($result = Db::run()->pdoQuery($sql)->results()):
                      $html .= '<div class="wojo ajax search full padding">';
					  $html .= '<div class="wojo divided selection fluid list">';
                      foreach ($result as $row):
                          $link = Url::url('/' . App::Core()->modname['digishop'], $row->slug);
                          $html .= '<div class="item align middle">';
                          $html .= '<div class="content auto">';
                          $html .= '<img class="wojo small rounded image" src="' . Digishop::hasThumb($row->thumb, $row->id) . '">';
                          $html .= '</div>';
                          $html .= '<div class="content left padding">';
                          $html .= '<a href="' . $link . '">' . $row->title . '</a>';
                          $html .= '</div>';
                          $html .= '</div>';
                      endforeach;
                      $html .= '</div>';
					  $html .= '</div>';
					  $json['html'] = $html;
					  $json['status'] = 'success';
                  else:
					  $json['status'] = 'error';
                  endif;
				  print json_encode($json);
              endif;
		  endif;
      break;
	  
      /* == Load Gateway == */
      case "gateway":
          if(Filter::$id) :
		      if($gateway = Db::run()->first(Core::gTable, null, array("id" => Filter::$id, "active" => 1))):
				  $tpl = App::View(BASEPATH . 'gateways/' . $gateway->dir . '/digishop/');
				  $tpl->gateway = $gateway;
				  $tpl->core = App::Core();
				  $tpl->cart = Digishop::getCartTotal();
				  $tpl->tax = Membership::calculateTax();
				  $tpl->template = 'form.tpl.php';
				  $json['message'] = $tpl->render();
		      else:
				  $json['message'] = Message::msgSingleError(Lang::$word->SYSERROR, false);
		      endif;
		  else:
			  $json['message'] = Message::msgSingleError(Lang::$word->SYSERROR, false);
		  endif;
		  print json_encode($json);
      break;
	  
      /* == Invoice == */
      case "invoice":
		  if(!App::Auth()->is_User())
			  exit;
			  if(isset($_GET['tid'])) :
				  if($data = App::Digishop()->Invoice($_GET['tid'])):
					  $tpl = App::View(FMODPATH . '/digishop/snippets/'); 
					  $tpl->data = $data;
					  $tpl->totals = App::Digishop()->invoiceTotal($_GET['tid']);
					  $tpl->user = Auth::$userdata;
					  $tpl->core = App::Core();
					  $tpl->template = '_invoice.tpl.php'; 
					  
					  $title = Lang::$word->M_INVOICE;
					  
					  require_once (BASEPATH . 'lib/mPdf/vendor/autoload.php');
					  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
					  $mpdf->SetTitle(Lang::$word->M_INVOICE);
					  $mpdf->WriteHTML($tpl->render());
					  $mpdf->Output($title . ".pdf", "D");
					  exit;
				  else:
					  exit;
				  endif;
			  endif;
      break;
  endswitch;