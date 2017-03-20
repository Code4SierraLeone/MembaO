<?php
 /**
   * Search
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
*/

  define("_VALID_PHP", true);
  require_once("../init.php");
?>

<?php
  $string = sanitize($_POST['liveSearch'], 15);
  if (strlen($string) > 3):
	  $sql = "(SELECT CONCAT(first_name,' ',last_name) as name, slug, 'leader' as type" 
	  . "\n FROM " . Leaders::lTable
	  . "\n WHERE MATCH (last_name) AGAINST ('" . $db->escape($string) . "*' IN BOOLEAN MODE))" 
	  . "\n UNION (SELECT title, slug, 'bill' as type" 
	  . "\n FROM " . Bills::bTable
	  . "\n WHERE MATCH (title) AGAINST ('" . $db->escape($string) . "*' IN BOOLEAN MODE))" 	 
	  . "\n UNION (SELECT name, slug, 'committee' as type" 
	  . "\n FROM " . Committees::cTable
	  . "\n WHERE MATCH (name) AGAINST ('" . $db->escape($string) . "*' IN BOOLEAN MODE))";

	
	  $html = '';
	  if ($result = $db->fetch_all($sql)):
		  $html .= '<div id="search-results">';
		  foreach ($result as $row):
		  	if($row->type == 'leader'):		      
			   $link = ($core->seo == 1) ? SITEURL . '/leaders/' . $row->slug . '/' : SITEURL . '/item.php?leadername=' . $row->slug;
			   $html .= '<a href="' . $link . '">' . $row->name . '</a>';
			elseif ($row->type == 'bill'):
  			   $link = ($core->seo == 1) ? SITEURL . '/bills/' . $row->slug . '/' : SITEURL . '/item.php?billname=' . $row->slug;
			   $html .= '<a href="' . $link . '">' . $row->title . '</a>';
			elseif ($row->type == 'committee'):
 			   $link = ($core->seo == 1) ? SITEURL . '/committees/' . $row->slug . '/' : SITEURL . '/item.php?committeename=' . $row->slug;
			   $html .= '<a href="' . $link . '">' . $row->name . '</a>';
			endif;

		  endforeach;
		  $html .= '</div>';
		  print $html;
	  endif;
  endif;
?>