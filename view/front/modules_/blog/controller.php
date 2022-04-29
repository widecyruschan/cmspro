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

  Bootstrap::Autoloader(array(AMODPATH . 'blog/'));

  $action = Validator::request('action');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Actions == */
  switch ($action):
      /* == Like Item == */
      case "like":
          if(Filter::$id) :
		      $type = Validator::sanitize($_POST['type'], "string", 4);
			  if (!Session::cookieExists("BLOG_voted", Filter::$id)):
				  Db::run()->pdoQuery("
					  UPDATE `" . Blog::mTable . "` 
					  SET like_$type = like_$type + 1
					  WHERE id = '" . Filter::$id . "'
				  ");
				  $json['status'] = 'success';
			  else:
				  $json['status'] = 'error';
			  endif;
			  print json_encode($json);
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
					  `" . Blog::mTable . "`
					WHERE MATCH (title" . Lang::$lang . ") AGAINST ('" . $string . "*' IN BOOLEAN MODE)
					ORDER BY title" . Lang::$lang . " 
					LIMIT 10 ";

                  $html = '';
                  if ($result = Db::run()->pdoQuery($sql)->results()):
                      $html .= '<div class="wojo ajax search full padding">';
					  $html .= '<div class="wojo divided relaxed fluid list">';
                      foreach ($result as $row):
                          $link = Url::url('/' . App::Core()->modname['blog'], $row->slug);
                          $html .= '<div class="item align middle">';
                          $html .= '<div class="content auto">';
                          $html .= '<img class="wojo small rounded image" src="' . Blog::hasThumb($row->thumb, $row->id) . '">';
                          $html .= '</div>';
                          $html .= '<div class="content left padding"">';
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
  endswitch;