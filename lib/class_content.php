<?php
  /**
   * Content
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */
  
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Content
  {
	  const muTable = "menus";
	  const pTable = "pages";
	  const fqTable = "faq";
	  const nTable = "news";
	  const eTable = "email_templates";
	  const exTable = "extras";
	  const slTable = "slider";
	  const slcTable = "slider_config";
	  const cnTable = "countries";
	  
	  public static $gfileext = array("jpg","jpeg","png");
	  
	  public $pageslug = null;
	  public $tag = null;
	  
	  private static $db;
	  
      /**
       * Content::__construct()
       * 
       * @return
       */
      function __construct()
      {
		  self::$db = Registry::get("Database");
		  $this->getContentSlug();
		  $this->getTag();

      }

	  
	  /**
	   * Content::getContentSlug()
	   * 
	   * @return
	   */
	  private function getContentSlug()
	  {
		  
		  if (isset($_GET['pagename'])) {
			  $this->pageslug = sanitize($_GET['pagename'],100);
			  return self::$db->escape($this->pageslug);
		  }
	  }
	  
	  /**
	   * Content::getTag()
	   * 
	   * @return
	   */
	  private function getTag()
	  {
		  
		  if (isset($_GET['tagname'])) {
			  $this->tag = sanitize($_GET['tagname'],60,false);
			  return self::$db->escape($this->tag);
		  }
	  }

      /**
       * Content::getCountryList()
       * 
       * @return
       */
      public function getCountryList()
      {
          $sql = "SELECT * FROM " . self::cnTable . " ORDER BY sorting DESC";
          $row = self::$db->fetch_all($sql);

          return ($row) ? $row : 0; 

      }

      /**
       * Content:::processCountry()
       * 
       * @return
       */
      public function processCountry()
      {

		  Filter::checkPost('name', Lang::$word->CNT_NAME);
		  Filter::checkPost('abbr', Lang::$word->CNT_ABBR);

          if (empty(Filter::$msgs)) {
              $data = array(
                  'name' => sanitize($_POST['name']),
                  'abbr' => sanitize($_POST['abbr']),
                  'active' => intval($_POST['active']),
                  'home' => intval($_POST['home']),
				  'vat' => floatval($_POST['vat']),
				  'sorting' => intval($_POST['sorting']),
				  );

			  if ($data['home'] == 1) {
				  self::$db->query("UPDATE `" . self::cnTable . "` SET `home`= DEFAULT(home);");
			  }	
			  
              Registry::get("Database")->update(self::cnTable, $data, "id=" . Filter::$id);

			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk(Lang::$word->CNT_UPDATED, false);
			  } else {
				  $json['type'] = 'info';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }
	  
      /**
       * Content::getMenuList()
       * 
       * @return
       */
	  public function getMenuList($save = true)
	  {
		  
		  if ($menurow = self::$db->fetch_all("SELECT * FROM " . self::muTable ." ORDER BY position")) {
			  print "<ul class=\"sortMenu\">\n";
			  foreach ($menurow as $row) {
				  print '<li class="dd-item" id="list_' . $row->id . '">' 
				  . '<div class="dd-handle"><a data-id="' . $row->id . '" data-name="' . $row->name . '" data-title="' . Lang::$word->MNU_DELETE . '" data-option="deleteMenu" class="delete">' 
				  . '<i class="icon red remove sign"></i></a><i class="icon reorder"></i>' 
				  . '<a href="index.php?do=menus&amp;action=edit&amp;id=' . $row->id . '" class="parent">' . $row->name . '</a></div>';
				  print "</li>\n";
			  }
		  }
		  unset($row);
		  print "</ul>\n";
		  
	  }

      /**
       * Content::getMenu()
       * 
       * @return
       */
	  public function getMenu()
	  {

		  $sql = "SELECT m.*, p.id, p.home_page,p.slug" 
		  . "\n FROM menus as m" 
		  . "\n LEFT JOIN pages AS p ON p.id = m.page_id" 
		  . "\n WHERE m.active = '1'"
		  . "\n ORDER BY m.position";
		  $row = self::$db->fetch_all($sql);
	
		  return ($row) ? $row : 0;
	  }
	  
	  /**
	   * Content::processMenu()
	   * 
	   * @return
	   */
	  public function processMenu()
	  {
		  
		  Filter::checkPost('name', Lang::$word->MNU_NAME);
		  Filter::checkPost('content_type', Lang::$word->MNU_TYPE_S);
		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'name' => sanitize($_POST['name']), 
				  'page_id' => intval($_POST['page_id']),
				  'content_type' => sanitize($_POST['content_type']),
				  'link' => (isset($_POST['web'])) ? sanitize($_POST['web']) : "NULL",
				  'target' => (isset($_POST['target'])) ? sanitize($_POST['target']) : "DEFAULT(target)",
				  'active' => intval($_POST['active'])
			  );
			  
			  (Filter::$id) ? self::$db->update(self::muTable, $data, "id=" . Filter::$id) : self::$db->insert(self::muTable, $data);
			  $message = (Filter::$id) ? Lang::$word->MNU_UPDATED : Lang::$word->MNU_ADDED;
			  
			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'info';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }
	  	 
	  
      /**
       * Content::getFileTree()
       * 
       * @return
       */
      public function getFileTree()
	  {
		  global $db, $core;
		  
		  $sql = "SELECT *, created as cdate FROM files ORDER BY name";
          $row = $db->fetch_all($sql);
          
		  return ($row) ? $row : 0;
	  }	  	  	  	  	  	  	       

	  
	  

	  /**
	   * Content::createSiteMap()
	   * 
	   * @return
	   */
	  public function createSiteMap()
	  {
		  
		  $sql1 = "SELECT id, slug, created FROM pages ORDER BY created DESC";
		  $pages = self::$db->query($sql1);

		  $sql2 = "SELECT id, slug, created FROM products ORDER BY created DESC";
		  $items = self::$db->query($sql2);
		  
		  $smap = "";
		  
		  $smap .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
		  $smap .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\r\n";
		  $smap .= "<url>\r\n";
		  $smap .= "<loc>" . SITEURL . "/index.php</loc>\r\n";
		  $smap .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
		  $smap .= "</url>\r\n";

		  while ($row = self::$db->fetch($pages)) {
			  if (Registry::get("Core")->seo == 1) {
				  $url = SITEURL . '/content/' . $row->slug . '/';
			  } else
				  $url = SITEURL . '/content.php?pagename=' . $row->slug;
			  
			  $smap .= "<url>\r\n";
			  $smap .= "<loc>" . $url . "</loc>\r\n";
			  $smap .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
			  $smap .= "<changefreq>weekly</changefreq>\r\n";
			  $smap .= "</url>\r\n";
		  }

		  while ($row = self::$db->fetch($items)) {
			  if (Registry::get("Core")->seo == 1) {
				  $url = SITEURL . '/product/' . $row->slug . '/';
			  } else
				  $url = SITEURL . '/item.php?itemname=' . $row->slug;
			  
			  $smap .= "<url>\r\n";
			  $smap .= "<loc>" . $url . "</loc>\r\n";
			  $smap .= "<lastmod>" . date('Y-m-d') . "</lastmod>\r\n";
			  $smap .= "<changefreq>weekly</changefreq>\r\n";
			  $smap .= "</url>\r\n";
		  }
		  
		  $smap .= "</urlset>";
		  
		  return $smap;
	  }

      /**
       * Content::writeSiteMap()
       * 
       * @return
       */
	  public function writeSiteMap()
	  {
		  
		  $filename = BASEPATH . 'sitemap.xml';
		  if (is_writable($filename)) {
			  file_put_contents($filename, $this->createSiteMap());
			  $json['type'] = 'success';
			  $json['message'] = Filter::msgOk(Lang::$word->MTN_STM_OK, false);
		  } else {
			  $json['type'] = 'error';
			  $json['message'] = Filter::msgAlert(str_replace("[FILENAME]", $filename, Lang::$word->MTN_STM_ERR), false);
		  }
		  
		  print json_encode($json);
	  }
	  	  
	  /**
	   * Content::processNewsletter()
	   * 
	   * @return
	   */
	  public function processNewsletter()
	  {
	
		  
		   Filter::checkPost('subject', Lang::$word->NWL_SUBJECT);
		   Filter::checkPost('body', Lang::$word->NWL_BODY);
		  
		  if (empty(Filter::$msgs)) {
				  $to = sanitize($_POST['recipient']);
				  $subject = sanitize($_POST['subject']);
				  $body = cleanOut($_POST['body']);
				  $numSent = 0;
				  $failedRecipients = array();

			  switch ($to) {
				  case "all":
					  require_once(BASEPATH . "lib/class_mailer.php");
					  $mailer = Mailer::sendMail();
					  $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
					  
					  $sql = "SELECT email, CONCAT(fname,' ',lname) as name FROM " . Users::uTable . " WHERE id != 1";
					  $userrow = self::$db->fetch_all($sql);
					  
					  $replacements = array();
					  if($userrow) {
                          foreach ($userrow as $cols) {
                              $replacements[$cols->email] = array(
                                  '[NAME]' => $cols->name,
                                  '[SITE_NAME]' => Registry::get("Core")->site_name,
                                  '[URL]' => Registry::get("Core")->site_url);
                          }
						
						$decorator = new Swift_Plugins_DecoratorPlugin($replacements);
						$mailer->registerPlugin($decorator);
						
						$message = Swift_Message::newInstance()
								  ->setSubject($subject)
								  ->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->site_name))
								  ->setBody($body, 'text/html');
						
						foreach ($userrow as $row) {
							$message->setTo(array($row->email => $row->name));
							$numSent++;
							$mailer->send($message, $failedRecipients);
						}
						unset($row);

					  }
					  break;
					  
				  case "newsletter":
					  require_once(BASEPATH . "lib/class_mailer.php");
					  $mailer = Mailer::sendMail();
					  $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));

					  $sql = "SELECT email, CONCAT(fname,' ',lname) as name FROM " . Users::uTable . " WHERE newsletter = '1' AND id != 1";
					  $userrow = self::$db->fetch_all($sql);
						  
					  $replacements = array();
					  if($userrow) {
                          foreach ($userrow as $cols) {
                              $replacements[$cols->email] = array(
                                  '[NAME]' => $cols->name,
                                  '[SITE_NAME]' => Registry::get("Core")->site_name,
                                  '[URL]' => Registry::get("Core")->site_url);
                          }
						  
						  $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
						  $mailer->registerPlugin($decorator);
						  
						  $message = Swift_Message::newInstance()
									->setSubject($subject)
									->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->site_name))
									->setBody($body, 'text/html');
						  
						  foreach ($userrow as $row) {
							  $message->setTo(array($row->email => $row->name));
							  $numSent++;
							  $mailer->send($message, $failedRecipients);
						  }
						  unset($row);
					  }
					  break;
					  				  	  
				  default:
					  require_once(BASEPATH . "lib/class_mailer.php");
					  $mailer = Mailer::sendMail();	
					  			  
					  $row = Registry::get("Database")->first("SELECT email, CONCAT(fname,' ',lname) as name FROM " . Users::uTable . " WHERE email LIKE '%" . sanitize($to) . "%'");
					  if ($row) {
						  $newbody = str_replace(array(
							  '[NAME]',
							  '[SITE_NAME]',
							  '[URL]'), array(
							  $row->name,
							  Registry::get("Core")->site_name,
							  Registry::get("Core")->site_url), $body);
	
						  $message = Swift_Message::newInstance()
									->setSubject($subject)
									->setTo(array($to => $row->name))
									->setFrom(array(Registry::get("Core")->site_email => Registry::get("Core")->site_name))
									->setBody($newbody, 'text/html');
						  
						  $numSent++;
						  $mailer->send($message, $failedRecipients);

					  }
					  break;
			  }

			  if ($numSent) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($numSent . ' ' . Lang::$word->MAIL_SENT, false);
			  } else {
				  $json['type'] = 'error';
				  $res = '';
				  $res .= '<ul>';
				  foreach ($failedRecipients as $failed) {
					  $res .= '<li>' . $failed . '</li>';
				  }
				  $res .= '</ul>';
				  $json['message'] = Filter::msgAlert(Lang::$word->NWL_SEND_ERR . $res, false);
	
				  unset($failed);
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	
	  }

      /**
       * Content::getHomePage()
       * 
       * @return
       */
      public function getHomePage()
      {
          $sql = "SELECT * FROM pages WHERE home_page = '1'";
          $row = self::$db->first($sql);
          
          return ($row) ? $row : 0;
      }
	  
      /**
       * Content::getPages()
       * 
       * @return
       */
      public function getPages()
      {
          $pager = Paginator::instance();
          $pager->items_total = countEntries(self::pTable);
          $pager->default_ipp = Registry::get("Core")->perpage;
          $pager->paginate();
		  
          $sql = "SELECT * FROM " . self::pTable ." ORDER BY title ASC" . $pager->limit;
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

	  /**
	   * Content:::processPage()
	   * 
	   * @return
	   */
	  public function processPage()
	  {
		  
		  Filter::checkPost('title', Lang::$word->PAG_NAME);
			  		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'title' => sanitize($_POST['title']), 
				  'slug' => (empty($_POST['slug'])) ? doSeo($_POST['title']) : doSeo($_POST['slug']),
				  'body' => $_POST['body'],
				  'created' => sanitize($_POST['created_submit']),
				  'contact' => intval($_POST['contact']),
				  'faq' => intval($_POST['faq']),
				  'home_page' => intval($_POST['home_page']),
				  'active' => intval($_POST['active'])
			  );


			  if ($data['home_page'] == 1) {
				  $home['home_page'] = "DEFAULT(home_page)";
				  self::$db->update(self::pTable, $home);
			  }
			  
			  if ($data['contact'] == 1) {
				  $contact['contact'] = "DEFAULT(contact)";
				  self::$db->update(self::pTable, $contact);
			  }

			  if ($data['faq'] == 1) {
				  $faq['faq'] = "DEFAULT(faq)";
				  self::$db->update(self::pTable, $faq);
			  }
			   
			  if (!Filter::$id) {
				  $data['created'] = "NOW()";
			  }
			  
			  (Filter::$id) ? self::$db->update(self::pTable, $data, "id=" . Filter::$id) : self::$db->insert(self::pTable, $data);
			  $message = (Filter::$id) ? Lang::$word->PAG_UPDATED : Lang::$word->PAG_ADDED;

			  if(self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
      }
	  
      /**
       * Content::getEmailTemplates()
       * 
       * @return
       */
      public function getEmailTemplates()
      {
          $sql = "SELECT * FROM email_templates ORDER BY name ASC";
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

	  /**
	   * Content:::processEmailTemplate()
	   * 
	   * @return
	   */
	  public function processEmailTemplate()
	  {
		  
		  Filter::checkPost('name', Lang::$word->ETP_NAME);
		  Filter::checkPost('subject', Lang::$word->ETP_SUBJECT);
		  Filter::checkPost('body', Lang::$word->ETP_BODY);
			  		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
					  'name' => sanitize($_POST['name']), 
					  'subject' => sanitize($_POST['subject']),
					  'body' => $_POST['body'],
					  'help' => sanitize($_POST['help'])
			  );

			  self::$db->update(self::eTable, $data, "id=" . Filter::$id);
			  
			  if(self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk(Lang::$word->ETP_UPDATED, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
      }

      /**
       * Content::getNews()
       * 
       * @return
       */
      public function getNews()
      {
		  
          $sql = "SELECT * FROM " . self::nTable . " ORDER BY title ASC";
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

      /**
       * Content::renderNews()
       * 
       * @return
       */
      public function renderNews()
      {
          
          $sql = "SELECT * FROM " . self::nTable . " WHERE active = 1";
          $row = self::$db->first($sql);
          
          return ($row) ? $row : 0;
      }
	  
	  /**
	   * Content::processNews()
	   * 
	   * @return
	   */
	  public function processNews()
	  {
		  
		  Filter::checkPost('title', Lang::$word->NWS_NAME);
		  Filter::checkPost('created_submit', Lang::$word->CREATED);
		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'title' => sanitize($_POST['title']), 
				  'author' => sanitize($_POST['author']), 
				  'body' => $_POST['body'],
				  'created' => sanitize($_POST['created_submit']),
				  'active' => intval($_POST['active'])
			  );

			  if ($data['active'] == 1) {
				  $news['active'] = "DEFAULT(active)";
				  self::$db->update(self::nTable, $news);
			  }
			  
			  (Filter::$id) ? self::$db->update(self::nTable, $data, "id='" . Filter::$id . "'") : self::$db->insert(self::nTable, $data);
			  $message = (Filter::$id) ? Lang::$word->NWS_UPDATED : Lang::$word->NWS_ADDED;
			  
			  if(self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
      }

      /**
       * Content::getFaq()
       * 
       * @return
       */
      public function getFaq()
      {
		  
          $sql = "SELECT * FROM " . self::fqTable . " ORDER BY position";
          $row = self::$db->fetch_all($sql);
          
          return ($row) ? $row : 0;
      }

	  /**
	   * Content::processFaq()
	   * 
	   * @return
	   */
	  public function processFaq()
	  {
		  
		  Filter::checkPost('question', Lang::$word->FAQ_QUEST);
		  Filter::checkPost('answer', Lang::$word->FAQ_ANSW);
		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'question' => sanitize($_POST['question']), 
				  'answer' => $_POST['answer'] 
			  );
			  
			  (Filter::$id) ? self::$db->update(self::fqTable, $data, "id='" . Filter::$id . "'") : self::$db->insert(self::fqTable, $data);
			  $message = (Filter::$id) ? Lang::$word->FAQ_UPDATED : Lang::$word->FAQ_ADDED;
			  
			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'info';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
			  
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }	 


	  /**
	   * Content::keepTags()
	   *
	   * @param mixed $str
	   * @param mixed $tags
	   * @return
	   */
	  public function keepTags($string, $allowtags = null, $allowattributes = null)
	  {
		  $string = strip_tags($string, $allowtags);
		  if (!is_null($allowattributes)) {
			  if (!is_array($allowattributes))
				  $allowattributes = explode(",", $allowattributes);
			  if (is_array($allowattributes))
				  $allowattributes = implode(")(?<!", $allowattributes);
			  if (strlen($allowattributes) > 0)
				  $allowattributes = "(?<!" . $allowattributes . ")";
			  $string = preg_replace_callback("/<[^>]*>/i", create_function('$matches', 'return preg_replace("/ [^ =]*' . $allowattributes . '=(\"[^\"]*\"|\'[^\']*\')/i", "", $matches[0]);'), $string);
		  }
		  return $string;
	  }

	  /**
	   * Content::censored()
	   *
	   * @param mixed $string
	   * @param mixed $words
	   * @return
	   */
	  public function censored($string, $words)
	  {
		  $array = explode("\r\n",$words);
		  reset($array);
		  
		  foreach ($array as $row) {
			  $string = preg_replace("`$row`", "***", $string);
		  }
		  unset($row);
		  return $string;
	  }
	  	  	  
	  

	  /**
	   * Content::sliderConfiguration()
	   * 
	   * @return
	   */
	  public function sliderConfiguration()
	  {
		  
		  $sql = "SELECT * FROM " . self::slcTable;
          $row = self::$db->first($sql);
          
		   return ($row) ? $row : 0;
	  }

	  /**
	   * Content::processSliderConfiguration()
	   * 
	   * @return
	   */
	  public function processSliderConfiguration()
	  {
		  
		  Filter::checkPost('slideTransition', Lang::$word->SLM_TRANS);
			  		  		  
		  if (empty(Filter::$msgs)) {
			  $data = array(
				  'sliderHeight' => intval($_POST['sliderHeight']),
				  'sliderHeightAdaptable' => intval($_POST['sliderHeightAdaptable']),
				  'sliderAutoPlay' => intval($_POST['sliderAutoPlay']),
				  'waitForLoad' => intval($_POST['waitForLoad']),
				  'slideTransition' => sanitize($_POST['slideTransition']),
				  'slideTransitionDirection' => sanitize($_POST['slideTransitionDirection']),
				  'slideTransitionSpeed' => intval($_POST['slideTransitionSpeed']),
				  'slideTransitionDelay' => intval($_POST['slideTransitionDelay']),
				  'slideTransitionEasing' => sanitize($_POST['slideTransitionEasing']),
				  'slideImageScaleMode' => sanitize($_POST['slideImageScaleMode']),
				  'slideShuffle' => intval($_POST['slideShuffle']),
				  'slideReverse' => intval($_POST['slideReverse']),
				  'showFilmstrip' => intval($_POST['showFilmstrip']),
				  'showCaptions' => intval($_POST['showCaptions']),
				  'simultaneousCaptions' => intval($_POST['simultaneousCaptions']),
				  'showTimer' => intval($_POST['showTimer']),
				  'showPause' => intval($_POST['showPause']),
				  'showArrows' => intval($_POST['showArrows']),
				  'showDots' => intval($_POST['showDots']),
			  );
			  
			  self::$db->update(self::slcTable, $data);
			  
			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk(Lang::$word->SLM_CONF_UPDATED, false);
			  } else {
				  $json['type'] = 'info';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
	
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }
	  
      /**
       * Content::getSlides()
       * 
       * @return
       */
	   public function getSlides()
	  {
		  
          $sql = "SELECT * FROM " . self::slTable
		  . "\n ORDER BY sorting";
          $row = self::$db->fetch_all($sql);
		  
		  return ($row) ? $row : 0;
	  }

      /**
       * Content::getImageInfo()
       * 
       * @return
       */
      public function getImageInfo()
      {
		  $row = Core::getRowById(self::slTable, Filter::$id);
          if(file_exists($file = UPLOADS . 'slider/' . $row->thumb)) {
			  $link = UPLOADURL . 'slider/' . $row->thumb;
			  
			  print "
			  <div id=\"filedetails\">
				<form class=\"xform modal\" id=\"admin_form\" method=\"post\">
				  <div class=\"row\">
					<section class=\"col col-4\">
					  <figure>";
						list($w, $h) = @getimagesize(UPLOADS . 'slider/' . $row->thumb);
						$resolution = "<li>Resolution: " . $w . " x " . $h . "</li>";
						print "<a href=\"" . $link . "\"  class=\"fancybox\" title=\"" . $row->caption . "\"> <img src=\"" . $link . "\" alt=\"\" style=\"max-width:100%\"/></a>";
						print " 
					  </figure>
					  <figcaption>
						<ul>
						  " . $resolution . "
						  <li>" . Lang::$word->GAL_SIZE . ": " . getSize(filesize(UPLOADS . 'slider/' . $row->thumb)) . "</li>
						  <li>" . Lang::$word->GAL_TYPE . ": " . getMIMEtype($row->thumb) . "</li>
						  <li>" . Lang::$word->GAL_FILELM . ": " . date('d-m-Y', filemtime(UPLOADS . 'slider/' . $row->thumb)) . "</li>
						</ul>
					  </figcaption>
					</section>
					<section class=\"col col-8\">
					  <div class=\"row\">
						<section class=\"col col-12\">
						  <label class=\"input\">
							<input type=\"text\" name=\"filename\" value=\"" . $row->caption . "\"> </label>
						  <div class=\"note\">" . Lang::$word->GAL_NAME . "</div>
						</section>
					  </div>
					  <div class=\"row\">
						<section class=\"col col-12\">
						  <label class=\"input state-disabled\">
							<input type=\"text\" name=\"filepath\" value=\"" . UPLOADS . 'slider/' . $row->thumb . "\" readonly=\"readonly\"> </label>
						  <div class=\"note\">" . Lang::$word->GAL_PATH . "</div>
						</section>
					  </div>
					  <div class=\"row\">
						<section class=\"col col-12\">
						  <label class=\"input state-disabled\">
							<input type=\"text\" name=\"fileurl\" value=\"" . $link . "\" readonly=\"readonly\">
						  </label>
						  <div class=\"note\">" . Lang::$word->GAL_URL . "</div>
						</section>
					  </div>
					  <div class=\"row\">
						<section class=\"col col-12\">
						  <label class=\"checkbox\">
							<input name=\"delfile_yes\" type=\"checkbox\" value=\"1\" class=\"checkbox\"/>
							<i></i>" . Lang::$word->GAL_DELIMG . "</label>
						  <div class=\"note note-error\">" . Lang::$word->GAL_DELIMG_T . "</div>
						</section>
					  </div>
					</section>
				  </div>
				  <input name=\"id\" type=\"hidden\" value=\"" . Filter::$id . "\" />
				  <input name=\"doSliderImage\" type=\"hidden\" value=\"1\" />
				</form>
			  </div>
			  ";
		  } else {
			  Filter::msgError(Lang::$word->GAL_IMGERROR);
		  }
		  
      }

	  /**
	   * Slider::processSlide()
	   * 
	   * @return
	   */
	  public function processSlide()
	  {
	
		  Filter::checkPost('caption', Lang::$word->SLM_NAME);
	
		  if (!Filter::$id) {
			  if (empty($_FILES['thumb']['name']))
				  Filter::$msgs['thumb'] = Lang::$word->SLM_IMG_SEL;
		  }
	
		  if (!empty($_FILES['thumb']['name'])) {
			  if (!preg_match("/(\.jpg|\.png)$/i", $_FILES['thumb']['name'])) {
				  Filter::$msgs['thumb'] = Lang::$word->CONF_LOGO_R;
			  }
			  $file_info = getimagesize($_FILES['thumb']['tmp_name']);
			  if (empty($file_info))
				  Filter::$msgs['thumb'] = Lang::$word->CONF_LOGO_R;
		  }
	
		  if (empty(Filter::$msgs)) {
			  $data['caption'] = sanitize($_POST['caption']);
			  $data['body'] = sanitize($_POST['body']);
	
			  if (isset($_POST['urltype']) && $_POST['urltype'] == "int" && isset($_POST['page_id'])) {
				  $slug = getValueByID("slug", Products::pTable, (int)$_POST['page_id']);
				  $data['url'] = $slug;
				  $data['urltype'] = "int";
				  $data['page_id'] = intval($_POST['page_id']);
			  } elseif (isset($_POST['urltype']) && $_POST['urltype'] == "ext" && isset($_POST['url'])) {
				  $data['url'] = sanitize($_POST['url']);
				  $data['urltype'] = "ext";
				  $data['page_id'] = "DEFAULT(page_id)";
			  } else {
				  $data['url'] = "#";
				  $data['urltype'] = "nourl";
				  $data['page_id'] = "DEFAULT(page_id)";
			  }
	
			  // Procces Image
			  if (!empty($_FILES['thumb']['name'])) {
				  $filedir = UPLOADS . "slider/";
				  $newName = "IMG_" . randName();
				  $ext = substr($_FILES['thumb']['name'], strrpos($_FILES['thumb']['name'], '.') + 1);
				  $fullname = $filedir . $newName . "." . strtolower($ext);
	
				  if (Filter::$id and $file = getValueById("thumb", self::slTable, Filter::$id)) {
					  @unlink($filedir . $file);
				  }
	
				  if (!move_uploaded_file($_FILES['thumb']['tmp_name'], $fullname)) {
					  die(Filter::msgError(Lang::$word->SLM_FILE_ERR, false));
				  }
				  $data['thumb'] = $newName . "." . strtolower($ext);
			  }
	
			  (Filter::$id) ? self::$db->update(self::slTable, $data, "id=" . Filter::$id) : $lastid = self::$db->insert(self::slTable, $data);
			  $message = (Filter::$id) ? Lang::$word->SLM_UPDATED : Lang::$word->SLM_ADDED;
	
			  if (self::$db->affected()) {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgOk($message, false);
			  } else {
				  $json['type'] = 'success';
				  $json['message'] = Filter::msgAlert(Lang::$word->NOPROCCESS, false);
			  }
			  print json_encode($json);
	
		  } else {
			  $json['message'] = Filter::msgStatus();
			  print json_encode($json);
		  }
	  }
	  
      /**
       * Content::getContentType()
       * 
	   * @param bool $selected
       * @return
       */ 	  
      public static function getContentType($selected = false)
	  {
		  $arr = array(
				'page' => Lang::$word->MNU_TYPE_PG,
				'web' => Lang::$word->MNU_TYPE_EL
		  );
		  
		  $html = '';
		  foreach ($arr as $key => $val) {
              if ($key == $selected) {
                  $html .= "<option selected=\"selected\" value=\"" . $key . "\">" . $val . "</option>\n";
              } else
                  $html .= "<option value=\"" . $key . "\">" . $val . "</option>\n";
          }
          unset($val);
          return $html;
      } 


      /**
       * Content::getTagName()
       * 
       * @return
       */
      public function getTagName()
      {
		  $sql = "SELECT tag FROM " . Products::tagTable . " WHERE tag = '" . self::$db->escape($this->tag) . "'";
		  $row = self::$db->first($sql);
		  
		  return ($row) ? $row : 0;
      }

	  /**
	   * Content::getProductList()
	   * 
	   * @return
	   */
	  public static function getProductList($id, $selected = false)
	  {
	
		  $sql = "SELECT id, slug, title FROM " . Products::pTable;
		  $result = self::$db->fetch_all($sql);
	
		  $display = '';
		  if ($result) {
			  $display .= "<select name=\"page_id\">";
			  foreach ($result as $row) {
				  $sel = ($row->$id == $selected) ? ' selected="selected"' : null;
				  $display .= "<option value=\"" . $row->$id . "\"" . $sel . ">" . $row->title . "</option>\n";
			  }
	
			  $display .= "</select>\n";
		  }
		  return $display;
	
	  }  
	  
	  /**
	   * Content::renderPages()
	   * 
	   * @return
	   */
	  public function renderPages()
	  {

		  $sql = "SELECT * FROM pages " . self::pTable
		  . "\n WHERE slug = '" . $this->pageslug . "'" 
		  . "\n AND active = '1'";
		  $row = self::$db->first($sql);
		  
		  return ($row) ? $row : 0;
	  }
	  	  	  
      
	  
      /**
       * Content::getSearchResults()
       * 
       * @return
       */
      public function getSearchResults($keyword)
      {
          
          $row = self::$db->fetch_all("SELECT * ,MATCH(first_name, last_name) AGAINST('$keyword') AS score, id as lid," 		  
		  . "\n (SELECT SUM(hits) FROM " . Leaders::lTable . " WHERE lid = id) as hits"
		  . "\n FROM " . Leaders::lTable
		  . "\n WHERE MATCH(first_name, last_name) AGAINST('$keyword)' IN BOOLEAN MODE) AND active = 1"
		  . "\n ORDER BY score ASC" 
		  . "\n LIMIT 20");
          
          return ($row) ? $row : 0;
      }
	  
      /**
       * Content::renderMetaData()
       * 
       * @return
       */ 
	  public function renderMetaData($row)
	  {
		  //$row = isset($row) ? $row : null;
		  
		  $sep = " | ";
		  $meta = "<meta charset=\"utf-8\">\n";
		  $meta .= "<title>" . Registry::get("Core")->site_name;
		  
		  if (Registry::get("Leaders")->leaderslug and $row) {
			  $meta .= $sep . $row->first_name .' '.$row->last_name;
		  } elseif ($this->pageslug and $row) {
			  $meta .= $sep . $row->title;
		  } elseif ($this->tag and $row) {
			  $meta .= $sep . $row->tag;
		  }
		  $meta .= "</title>\n";
		  $meta .= "<meta name=\"keywords\" content=\"";
		  if (Registry::get("Leaders")->leaderslug and $row) {
			  if ($row->metakeys) {
				  $meta .= $row->metakeys;
			  } else {
				  $meta .= Registry::get("Core")->metakeys;
			  }
		  } else{
			  $meta .= Registry::get("Core")->metakeys;
		  }
		  $meta .= "\" />\n";
		  $meta .= "<meta name=\"description\" content=\"";
		  if (Registry::get("Leaders")->leaderslug and $row) {
			  if ($row->metadesc and $row) {
				  $meta .= $row->metadesc;
			  } else {
				  $meta .= Registry::get("Core")->metadesc;
			  }
		  } else{
			  $meta .= Registry::get("Core")->metadesc;
		  }
		  $meta .= "\" />\n";
		  $meta .= "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"" .SITEURL ."/assets/favicon.ico\" />\n";
		  $meta .= "<meta name=\"dcterms.rights\" content=\"" . Registry::get("Core")->company . " &copy; All Rights Reserved\" >\n";
		  $meta .= "<meta name=\"robots\" content=\"index, follow\" />\n";
		  $meta .= "<meta name=\"revisit-after\" content=\"1 day\" />\n";
		  $meta .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\" />\n";
		  return $meta;
	  }
  }
?>