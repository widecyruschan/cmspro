<?php
  /**
   * PayFast Form
   *
   * @package Membership Manager Pro
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: form.tpl.php, v1.00 2016-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if(!$this->row->recurring):?>
<?php $url = ($this->gateway->live) ? 'www.payfast.co.za' : 'sandbox.payfast.co.za';?>
  <form action="https://<?php echo $url;?>/eng/process" class="center aligned" method="post" id="pf_form" name="pf_form">
    <input type="image" src="<?php echo SITEURL.'/gateways/payfast/logo_large.png';?>" style="width:150px" class="wojo basic primary button" name="submit" title="Pay With PayFast" alt="" onclick="document.pf_form.submit();"/>
	<?php
      $html = '';
      $string = '';
      
      $array = array(
          'merchant_id' => $this->gateway->extra,
          'merchant_key' => $this->gateway->extra2,
          'return_url' => Url::url('/' . App::Core()->system_slugs->account[0]->{'slug' . Lang::$lang}, "history"),
          'cancel_url' => Url::url('/' . App::Core()->system_slugs->account[0]->{'slug' . Lang::$lang}, "history"),
          'notify_url' => SITEURL . '/gateways/' . $this->gateway->dir . '/ipn.php',
		  'name_first' => Auth::$userdata->fname,
		  'name_last' => Auth::$userdata->lname,
          'email_address' => Auth::$userdata->email,
          'm_payment_id' => $this->row->id,
          'amount' => $this->cart->totalprice,
          'item_name' => $this->row->{'title' . Lang::$lang},
          //'item_description' => $this->row->{'description' . Lang::$lang},
          'custom_int1' => App::Auth()->uid,
          );
    
      foreach ($array as $k => $v) {
          $html .= '<input type="hidden" name="' . $k . '" value="' . $v . '" />';
          $string .= $k . '=' . urlencode($v) . '&';
      }
      $string = substr($string, 0, -1);
	  if($this->gateway->extra3){
		  $string .= '&passphrase='. urlencode(trim($this->gateway->extra3));
	  }
      $sig = md5($string);
      $html .= '<input type="hidden" name="signature" value="' . $sig . '" />';
    
      print $html;
    ?>
  </form>
<?php endif;?>