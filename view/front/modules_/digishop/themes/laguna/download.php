<?php
  /**
   * Download
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: download.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../../init.php");

  Bootstrap::Autoloader(array(AMODPATH . 'digishop/'));

  define('BASE_DIR', App::Digishop()->filedir);

  $allowed_ext = array(
      'zip' => 'application/zip',
      'rar' => 'application/x-rar-compressed',
      'pdf' => 'application/pdf',
      'doc' => 'application/msword',
      'xls' => 'application/vnd.ms-excel',
      'ppt' => 'application/vnd.ms-powerpoint',
      'exe' => 'application/octet-stream',
      'gif' => 'image/gif',
      'png' => 'image/png',
      'jpg' => 'image/jpeg',
      'jpeg' => 'image/jpeg',
      'mp3' => 'audio/mpeg',
      'wav' => 'audio/x-wav',
      'mpeg' => 'video/mpeg',
      'mpg' => 'video/mpeg',
      'mpe' => 'video/mpeg',
      'mov' => 'video/quicktime',
      'avi' => 'video/x-msvideo');

  set_time_limit(0);

  if (ini_get('zlib.output_compression')) {
      ini_set('zlib.output_compression', 'Off');
  }

  // Free Downloads
  if (isset($_GET['free'])) {
      $token = Validator::sanitize($_GET['free'], "alphanumeric", 30);
      $row = Db::run()->first(Digishop::mTable, array("file"), array("token" => $token, "active" => 1, "price" => 0));

      if ($row) {
          $fext = File::getExtension($row->file);

          if (!file_exists(BASE_DIR . $row->file) || !is_file(BASE_DIR . $row->file)) {
              Debug::addMessage('errors', "file error", "File does not exist. Make sure you specified correct file name.", 'session');
              Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=1"));
              exit;
          }

          if (!array_key_exists($fext, $allowed_ext)) {
              Debug::addMessage('errors', "file error", "This file type it's not allowed.", 'session');
              Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=2"));
              exit;
          }

          if (App::Digishop()->allow_free == "no" and !App::Auth()->logged_in) {
              Debug::addMessage('errors', "file error", "You must be registered and logged in, to download free file.", 'session');
              Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=3"));
              exit;
          }

          File::download(BASE_DIR . $row->file, $row->file);
      } else {
          Url::redirect(Url::url('/' . App::Core()->modname['digishop']));
      }

  // Membership Downloads
  } elseif (isset($_GET['member']) && App::Auth()->logged_in) {
      $token = Validator::sanitize($_GET['member'], "alphanumeric", 30);
      $row = Db::run()->first(Digishop::mTable, array("file", "membership_id"), array("token =" => $token, "and active =" => 1, "and membership_id <>" => 0));

      if ($row) {
          $fext = File::getExtension($row->file);

          if (!file_exists(BASE_DIR . $row->file) || !is_file(BASE_DIR . $row->file)) {
              Debug::addMessage('errors', "file error", "File does not exist. Make sure you specified correct file name.", 'session');
              Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=1"));
              exit;
          }

          if (!array_key_exists($fext, $allowed_ext)) {
              Debug::addMessage('errors', "file error", "This file type it's not allowed.", 'session');
              Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=2"));
              exit;
          }

          if (Membership::is_valid(explode(',', $row->membership_id))) {
              File::download(BASE_DIR . $row->file, $row->file);
          } else {
              Debug::addMessage('errors', "file error", "Your membership has expired.", 'session');
              Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=1"));
              exit;
          }

      } else {
          Url::redirect(Url::url('/' . App::Core()->modname['digishop']));
      }

  // Paid Downloads
  } elseif (isset($_GET['fileid'])) {
      $token = Validator::sanitize($_GET['fileid'], "alphanumeric", 30);

      $sql = "
	  SELECT 
		p.file,
		t.downloads,
		t.id
	  FROM
		`" . Digishop::xTable . "` AS t 
		LEFT JOIN `" . Digishop::mTable . "` AS p 
		  ON t.item_id = p.id 
	  WHERE t.token = ? 
		AND t.user_id = ? 
		AND t.status = ? 
		AND p.active = ?;";

      $row = Db::run()->pdoQuery($sql, array($token, App::Auth()->uid, 1, 1))->result();

      if ($row) {
          $fext = File::getExtension($row->file);

          if (!file_exists(BASE_DIR . $row->file) || !is_file(BASE_DIR . $row->file)) {
              Debug::addMessage('errors', "file error", "File does not exist. Make sure you specified correct file name.", 'session');
              Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=1"));
              exit;
          }

          if (!array_key_exists($fext, $allowed_ext)) {
              Debug::addMessage('errors', "file error", "This file type it's not allowed.", 'session');
              Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=2"));
              exit;
          }

          if ($row->downloads == 0) {
              Debug::addMessage('errors', "file error", "No more downloads allowed.", 'session');
              Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=4"));
              exit;
          }

		  if($row->downloads > 0) {
			Db::run()->pdoQuery("
				UPDATE `" . Digishop::xTable . "` 
				SET downloads = downloads - 1
				WHERE id = '" . $row->id . "'
			");
		  }
		  
          File::download(BASE_DIR . $row->file, $row->file);

      } else {
          Url::redirect(Url::url('/' . App::Core()->modname['digishop']));
      }

  } else {
      Debug::addMessage('errors', "file error", "Illegal download access.", 'session');
      Url::redirect(Url::url('/' . App::Core()->modname['digishop'], "?error=5"));
      exit;
  }