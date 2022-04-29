<?php
  /**
   * Ideal Form
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: form.tpl.php, v3.00 2019-06-20 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  include(BASEPATH . "gateways/ideal/initialize.php");
  $mollie = new Mollie_API_Client;
  $mollie->setApiKey($this->gateway->extra);
  
  $order_id = "SSH_" . md5(time());
  $payment = $mollie->payments->create(array(
      "amount" => Utility::numberParse(($this->shipping->total) + $this->tax * $this->cart->grand + $this->cart->grand),
      "method" => Mollie_API_Object_Method::IDEAL,
      "description" => $this->core->company . ' - ' . Lang::$word->CHECKOUT,
      "redirectUrl" => Url::url('/' . $this->core->system_slugs->account[0]->{'slug' . Lang::$lang} . '/validate', "?ideal=1&order_id=" . $order_id),
      "metadata" => array("order_id" => $order_id, "user_id" => App::Auth()->sesid),
	  ));
	  
  Db::run()->update(Shop::qTable, array("cart_id" => $payment->id, "order_id" => $order_id), array("user_id" => App::Auth()->sesid));
?>
<a class="wojo basic primary button" href="<?php echo $payment->getPaymentUrl();?>" title="Pay With Mollie"><img src="<?php echo SITEURL;?>/gateways/ideal/logo_large.png" style="width:200px"></a>
<?php /*?>
<form method="post" action="<?php echo $payment->getPaymentUrl();?>" id="id_form" name="id_form" class="content-center">
<input type="image" src="<?php echo SITEURL;?>/gateways/ideal/logo_large.png" style="width:200px" name="submit" class="wojo basic primary button" title="Pay With Mollie" alt="" onclick="document.id_form.submit();">
</form><?php */?>