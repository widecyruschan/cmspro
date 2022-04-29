<?php
  /**
   * Login Page
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: login.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  if (is_dir("../../setup"))
      : die("<div style='text-align:center'>" 
		  . "<span style='padding: 5px; border: 1px solid #999; background-color:#EFEFEF;" 
		  . "font-family: Verdana; font-size: 11px; margin-left:auto; margin-right:auto'>" 
		  . "<b>Warning:</b> Please delete setup directory!</span></div>");
  endif;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="<?php echo ADMINVIEW;?>/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADMINVIEW;?>/css/transition.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADMINVIEW;?>/css/progress.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADMINVIEW;?>/css/icon.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADMINVIEW;?>/css/message.css" rel="stylesheet" type="text/css">
<link href="<?php echo ADMINVIEW;?>/css/login.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/global.js"></script>
</head>
<body>
<div class="wrap">
  <div id="formContent">
  <h2><?php echo Utility::sayHello();?></h2>
    <div class="avatar">
      <img src="<?php echo UPLOADURL;?>/avatars/default.svg" id="icon" alt="User Icon">
    </div>
    <div id="loginform">
      <form id="admin_form" name="admin_form" method="post">
        <input type="text" name="username" placeholder="<?php echo Lang::$word->USERNAME;?>">
        <input type="password" name="password" placeholder="<?php echo Lang::$word->M_PASSWORD;?>">
        <button id="doSubmit" type="button" name="submit"><?php echo Lang::$word->LOGIN;?></button>
      </form>
      <div class="formFooter">
        <a id="passreset" class="underlineHover"><?php echo Lang::$word->M_PASSWORD_RES;?>?</a>
      </div>
    </div>
    <div id="passform" class="hide-all">
      <input type="text" name="pEmail" id="pEmail" class="input-container" placeholder="<?php echo Lang::$word->M_EMAIL1;?>">
      <button id="dopass" type="button" name="doopass"><?php echo Lang::$word->SUBMIT;?></button>
      <div class="formFooter">
        <a id="backto" class="underlineHover"><?php echo Lang::$word->M_SUB14;?></a>
      </div>
    </div>
  </div>
  <footer> Copyright &copy;<?php echo date('Y') . ' '. App::Core()->company;?> </footer>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#backto").on('click', function() {
        $("#loginform").slideDown();
        $("#passform").slideUp();
    });
    $("#passreset").on('click', function() {
        $("#loginform").slideUp();
        $("#passform").slideDown();
    });

    $("#doSubmit").on('click', function() {
        var $btn = $(this);
        $btn.addClass('loading');
        var username = $("input[name=username]").val();
        var password = $("input[name=password]").val();
        $.ajax({
            type: 'post',
            url: "<?php echo FRONTVIEW;?>/controller.php",
            data: {
                'action': 'adminLogin',
                'username': username,
                'password': password
            },
            dataType: "json",
            success: function(json) {
				if(json.type === "error") {
					$.wNotice(decodeURIComponent(json.message), {
						autoclose: 6000,
						type: json.type,
						title: json.title
					});
				} else {
					window.location.href = "<?php echo SITEURL . '/admin/';?>";
				}
                $btn.removeClass('loading');
            }
        });
    });
	
    $("#dopass").on('click', function() {
        var $btn = $(this);
        $btn.addClass('loading');
        var email = $("input[name=pEmail]").val();
        var fname = $("input[name=fname]").val();
        $.ajax({
            type: 'post',
            url: "<?php echo FRONTVIEW;?>/controller.php",
            data: {
                'action': 'aResetPass',
                'email': email,
                'fname': fname
            },
            dataType: "json",
            success: function(json) {
				$.wNotice(decodeURIComponent(json.message), {
					autoclose: 6000,
					type: json.type,
					title: json.title
				});
                if (json.type === "success") {
					$btn.prop("disabled", true);
				}
                $btn.removeClass('loading');
            }
        });
    });
});
</script>
</body>
</html>