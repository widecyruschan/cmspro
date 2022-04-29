<?php
  /**
   * Controller
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../../init.php");

  Bootstrap::Autoloader(array(AMODPATH . 'shop/'));

  $action = Validator::request('action');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Actions == */
  switch ($action):
      /* == Add to cart == */
      case "add":
		  if (Filter::$id and $row = Db::run()->first(Shop::mTable, array(
			  "id",
			  "title" . Lang::$lang . " AS title",
			  "slug" . Lang::$lang . " AS slug",
			  "price",
			  "thumb",
			  "quantity",
			  "subtract",
			  "price_sale"), array(
			  "id" => Filter::$id,
			  "active" => 1))
			  ):
			  
			  if($row->subtract and $row->quantity < 1):
				  $json['message'] = Lang::$word->_MOD_SP_VARERR4;
				  $json['title'] = Lang::$word->ERROR;
				  $json['status'] = 'error';
			  else:
				  $tax = Membership::calculateTax();
				  $price = ($row->price_sale > 0 and $row->price_sale < $row->price) ? $row->price_sale : $row->price;
	
				  $data = array(
					  'user_id' => App::Auth()->sesid,
					  'product_id' => $row->id,
					  'originalprice' => Validator::sanitize($row->price, "float"),
					  'tax' => Validator::sanitize($tax, "float"),
					  'totaltax' => Validator::sanitize($price * $tax, "float"),
					  'total' => Validator::sanitize($price, "float"),
					  'totalprice' => Validator::sanitize($tax * $price + $price, "float"),
					  );
						  
				  Db::run()->insert(Shop::qTable, $data);
				  if ($_POST['type'] == "simple"):
					  $total = Shop::getCartSimpleTotal();
					  $json['html'] = $total->items;
				  else:
					  $tpl = App::View(File::isThemeDir(FMODPATH . 'shop/themes/' . App::Core()->theme . '/snippets/', FMODPATH . 'shop/snippets/'));
					  $tpl->template = '_cart.tpl.php';
					  $tpl->data = Shop::getCartContent();
					  $json['html'] = $tpl->render();
				  endif;
	
				  $json['status'] = 'success';
			  endif;
			  
          else:
              $json['status'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = "Ooops, there was an error selecting this item.";
          endif;
          print json_encode($json);
      break;
	  
      /* == Get Variants == */
      case "getVariants":
		  if (Filter::$id and $row = Db::run()->first(Shop::mTable, array(
			  "id",
			  "title" . Lang::$lang . " AS title",
			  "slug" . Lang::$lang . " AS slug",
			  "price",
			  "thumb",
			  "variation_data",
			  "price_sale"), array(
			  "id" => Filter::$id,
			  "active" => 1))
			  ):
			  $tpl = App::View(File::isThemeDir(FMODPATH . 'shop/themes/' . App::Core()->theme . '/snippets/', FMODPATH . 'shop/snippets/'));
			  
			  if(isset($_GET['variant']) and $_GET['variant'] == true) :
				  $tpl->template = '_variant.tpl.php';
				  $tpl->data = json_decode($row->variation_data);
				  $json['status'] = 'success';
				  $json['sections'] = count(get_object_vars($tpl->data));
				  $json['html'] = $tpl->render();
			  else :
				  $json['status'] = 'error';
				  $json['message'] = Lang::$word->_MOD_SP_VARERR1;
			  endif;
		  endif;
          print json_encode($json);
      break;
	  
      /* == Add to cart == */
      case "addVariants":
		  if (Filter::$id and $row = Db::run()->first(Shop::mTable, array(
			  "id",
			  "title" . Lang::$lang . " AS title",
			  "slug" . Lang::$lang . " AS slug",
			  "price",
			  "thumb",
			  "quantity",
			  "subtract",
			  "variation_data",
			  "price_sale",
			  "price"), array(
			  "id" => Filter::$id,
			  "active" => 1))
			  ):
			  
			  if(isset($_POST['ids']) and count($_POST['ids']) > 0) :
			      $vars = json_decode($row->variation_data, true);
				  $total = count($vars);
				  if($total == intval($_POST['active'])):
				      $variants = Shop::getVariantFromJson($vars, $_POST['ids']);
					  
					  $tax = Membership::calculateTax();
					  $tprice = ($row->price_sale > 0 and $row->price_sale < $row->price) ? $row->price_sale : $row->price;
					  $sum = array_sum(array_column($variants, 'price'));
					  $price = ($tprice + $sum);

					  $data = array(
						  'user_id' => App::Auth()->sesid,
						  'product_id' => $row->id,
						  'originalprice' => Validator::sanitize($tprice, "float"),
						  'tax' => Validator::sanitize($tax, "float"),
						  'totaltax' => Validator::sanitize($price * $tax, "float"),
						  'total' => Validator::sanitize($price, "float"),
						  'variants' => json_encode($variants),
						  'totalprice' => Validator::sanitize($tax * $price + $price, "float"),
						  );
						  
					  Db::run()->insert(Shop::qTable, $data);

					  if ($_POST['type'] == "simple"):
						  $total = Shop::getCartSimpleTotal();
						  $json['html'] = $total->items;
					  else:
						  $tpl = App::View(File::isThemeDir(FMODPATH . 'shop/themes/' . App::Core()->theme . '/snippets/', FMODPATH . 'shop/snippets/'));
						  $tpl->template = '_cart.tpl.php';
						  $tpl->data = Shop::getCartContent();
						  $json['html'] = $tpl->render();
					  endif;
					  
					  $json['title'] = Lang::$word->SUCCESS;
					  $json['status'] = 'success'; 
					  $json['message'] = Lang::$word->_MOD_SP_VAROK1;
				  else:
					  $json['status'] = 'error'; 
					  $json['message'] = Lang::$word->_MOD_SP_VARERR1;
				  endif;
			  else :
			      $json['message'] = Lang::$word->_MOD_SP_VARERR1;
				  $json['status'] = 'error';
			  endif;
		  endif;
          print json_encode($json);
      break;
			
      /* == Change Quantity == */
      case "qty":
		  if (Filter::$id and $row = Db::run()->first(Shop::qTable, null, array("id" => Filter::$id))):
		      $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . Shop::qTable . "` WHERE product_id = '" . $row->product_id . "' AND user_id = '" . App::Auth()->sesid . "' LIMIT 1");
		      $product = Db::run()->first(Shop::mTable, array("quantity", "subtract"), array("id" => $row->product_id));
			  
			  if($product->subtract and $product->quantity <= $counter) :
			      $json['status'] = 'error'; 
				  $json['title'] = Lang::$word->ERROR;
			      $json['message'] = str_replace("[QTY]", $product->quantity, Lang::$word->_MOD_SP_VARERR3);
			  else :
			      App::Session()->remove("shop_" . App::Auth()->sesid);
				  App::Session()->set("shop_" . App::Auth()->sesid, $row);
				  $temp = App::Session()->get("shop_" . App::Auth()->sesid);
				  
			      Db::run()->delete(Shop::qTable, array('product_id' => $temp->product_id, 'totalprice' => $temp->totalprice, 'user_id' => App::Auth()->sesid));
				  
				  for ($i = 1; $i <= intval($_POST['value']); $i++) :
					  $dataArray[] = array(
						  'user_id' => $temp->user_id,
						  'product_id' => $temp->product_id,
						  'originalprice' => $temp->originalprice,
						  'tax' => $temp->tax,
						  'totaltax' => $temp->totaltax,
						  'total' => $temp->total,
						  'variants' => $temp->variants,
						  'totalprice' => $temp->totalprice,
						  );
					  endfor;
				  Db::run()->insertBatch(Shop::qTable, $dataArray);

				  $json['title'] = Lang::$word->SUCCESS;
				  $json['status'] = 'success'; 
				  $json['redirect'] = Url::url('/' . App::Core()->modname['shop'], App::Core()->modname['shop-cart']);
			  endif;
		  endif;
          print json_encode($json);
      break;

      /* == Do shipping == */
      case "shipping":
          if (Filter::$id and !empty($_POST['value'])) :
              $row = App::Shop()->shippingOptions();
			  $name = $row->{'shipping_opt_' . Filter::$id}->name;
			  $value = Validator::sanitize($_POST['value'], "float");
			  $totals = Shop::getCartTotal();
			  
			  if(App::Shop()->allow_free_shipping_over > 0 and $totals->grand > App::Shop()->allow_free_shipping_over):
				  $data = array(
					  'user_id' => App::Auth()->sesid,
					  'shipping_id' => 0,
					  'total' => 0,
					  'name' => Lang::$word->_MOD_SP_FREE_SHIPPING,
					  );
			  else:
				  $data = array(
					  'user_id' => App::Auth()->sesid,
					  'shipping_id' => Filter::$id,
					  'total' => $value,
					  'name' => $name,
					  );
			  endif;
			  
			  if($s = Db::run()->first(Shop::qxTable, null, array("user_id" => App::Auth()->sesid))) :
				  Db::run()->update(Shop::qxTable, $data, array("id" => $s->id));
			  else:
				  Db::run()->insert(Shop::qxTable, $data);
			  endif;
			  
			  $json['shipping'] = Utility::formatMoney($value);
			  $json['grand'] = Utility::formatMoney($totals->grand + $value);
              $json['status'] = 'success';
          else:
              $json['status'] = 'error';
          endif;
          print json_encode($json);
      break;
	  
      /* == Remove from cart == */
      case "remove":
          if (Filter::$id) :
		      $row = Db::run()->first(Shop::qTable, null, array("id" => Filter::$id));
              Db::run()->delete(Shop::qTable, array("product_id" => $row->product_id, "user_id" => App::Auth()->sesid, "totalprice" => $row->totalprice));
			  Db::run()->delete(Shop::qxTable, array("user_id" => App::Auth()->sesid));
			  $tpl = App::View(File::isThemeDir(FMODPATH . 'shop/themes/' . App::Core()->theme . '/snippets/', FMODPATH . 'shop/snippets/'));
			  $tpl->template = '_cart.tpl.php';
			  $tpl->data = Shop::getCartContent();

			  $json['html'] = $tpl->render();
              $json['status'] = 'success';
          else:
              $json['status'] = 'error';
          endif;
          print json_encode($json);
      break;

      /* == Remove from big cart == */
      case "removeBig":
          if (Filter::$id) :
		      $row = Db::run()->first(Shop::qTable, null, array("id" => Filter::$id));
              Db::run()->delete(Shop::qTable, array("product_id" => $row->product_id, "user_id" => App::Auth()->sesid, "totalprice" => $row->totalprice));
			  Db::run()->delete(Shop::qxTable, array("user_id" => App::Auth()->sesid));
              $json['status'] = 'success';
			  $json['redirect'] = Url::url('/' . App::Core()->modname['shop'], App::Core()->modname['shop-cart']);
          else:
              $json['status'] = 'error';
          endif;
          print json_encode($json);
      break;
	  
      /* == Like Item == */
      case "like":
          if(Filter::$id) :
			  Db::run()->pdoQuery("
				  UPDATE `" . Shop::mTable . "` 
				  SET likes = likes + 1
				  WHERE id = '" . Filter::$id . "'
			  ");
		  endif;
      break;

      /* == Wishlist == */
      case "wishlist":
          if (Filter::$id):
			   if (App::Auth()->is_User()) :
				   Db::run()->insert(Shop::wTable, array("product_id" => Filter::$id, "user_id" => App::Auth()->uid));
			   else:
				   App::Session()->setKey("shop_wishlist", Filter::$id, Filter::$id);
			   endif;
              $json['type'] = 'success';
          else:
              $json['type'] = 'error';
          endif;
          print json_encode($json);
      break;

      /* == Remove Wishlist == */
      case "removeWish":
          if (Filter::$id):
              Db::run()->delete(Shop::wTable, array("id" => Filter::$id, "user_id" => App::Auth()->uid));
              $json['status'] = 'success';
          else:
              $json['status'] = 'error';
          endif;
          print json_encode($json);
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
					  `" . Shop::mTable . "`
					WHERE MATCH (title" . Lang::$lang . ") AGAINST ('" . $string . "*' IN BOOLEAN MODE)
					ORDER BY title" . Lang::$lang . " 
					LIMIT 10 ";

                  $html = '';
                  if ($result = Db::run()->pdoQuery($sql)->results()):
                      $html .= '<div class="wojo ajax search full padding">';
					  $html .= '<div class="wojo divided selection fluid list">';
                      foreach ($result as $row):
                          $link = Url::url('/' . App::Core()->modname['shop'], $row->slug);
                          $html .= '<div class="item align middle">';
                          $html .= '<div class="content auto">';
                          $html .= '<img class="wojo small image" src="' . Shop::hasThumb($row->thumb, $row->id) . '">';
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
			      parse_str($_GET['address'], $address);
				  $addr = 
				  $address['fname'] . ' ' . $address['lname'] . PHP_EOL . 
				  $address['address'] . ', ' . $address['city'] . PHP_EOL . 
				  $address['zip'] . ', ' . $address['state'] . PHP_EOL . 
				  $address['country'] . PHP_EOL . 
				  $address['phone'] . PHP_EOL;
				  Db::run()->update(Shop::qxTable, array('address' => $addr), array("user_id" => App::Auth()->sesid));

				  $tpl = App::View(BASEPATH . 'gateways/' . $gateway->dir . '/shop/');
				  $tpl->gateway = $gateway;
				  $tpl->core = App::Core();
				  $tpl->cart = Shop::getCartTotal();
				  $tpl->shipping = Db::run()->first(Shop::qxTable, null, array("user_id" => App::Auth()->sesid));
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
			  if(isset($_GET['tid']) and !empty($_GET['tid'])) :
				  if($data = App::Shop()->Invoice($_GET['tid'])):
					  $tpl = App::View(FMODPATH . '/shop/snippets/'); 
					  $tpl->data = $data;
					  $tpl->totals = App::Shop()->invoiceTotal($_GET['tid']);
					  $tpl->shipping = App::Shop()->shippingTotal($_GET['tid']);
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