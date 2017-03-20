<?php
  /**
   * Crumbs Navigation
   *
   * @package Membao
   * @author Alan Kawamara
   * @copyright 2017
   */

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php
  switch (Filter::$do) {
      case "users";

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=users" class="section">User Management</a> <div class="divider"></div> <div class="active section">Edit User</div>';
                  break;
              case "add":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=users" class="section">User Management</a> <div class="divider"></div> <div class="active section">Add User</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">User Management</div>';
                  break;
          }

          break;

      case "config":

      default:
          echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Configuration Manager</div>';
          break;

      case "files":

          echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">File Manager</div>';
          break;
		  
      case "backup":

          echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Backup Manager</div>';
          break;

      case "maintenance":

          echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Maintenance Manager</div>';
          break;

      case "system":

          echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">System Settings</div>';
          break;

      case "language":

          echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Language Manager</div>';
          break;		        

      case "templates":

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=templates" class="section">Template Management</a> <div class="divider"></div> <div class="active section">Edit Template</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Template Management</div>';
                  break;
          }

          break;

      case "menus":

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=menus" class="section">' . Lang::$word->MNU_TITLE . '</a> <div class="divider"></div> <div class="active section">Edit Menu</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Menu Management</div>';
                  break;
          }

          break;

      case "categories":

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=categories" class="section">' . Lang::$word->CAT_TITLE . '</a> <div class="divider"></div> <div class="active section">Edit Category</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Category Management</div>';
                  break;
          }
		  
          break;
		  		  
      case "newsletter":

          echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Newsletter Management</div>';
          break;

      case "pages";

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=pages" class="section">Page Management</a> <div class="divider"></div> <div class="active section">Edit Page</div>';
                  break;
              case "add":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <a href="index.php?do=pages" class="section">Page Management</a> <div class="divider"></div> <div class="active section">Add New Page</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Page Management</div>';
                  break;
          }

          break;

      case "slider":

          switch (Filter::$action) {
              case "config":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=slider" class="section">Slide Management</a> <div class="divider"></div> <div class="active section">Slide Configuration</div>';
                  break;
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=slider" class="section">Slider Management</a> <div class="divider"></div> <div class="active section">Edit Slide</div>';
                  break;
              case "add":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=slider" class="section">Slider Management</a> <div class="divider"></div> <div class="active section">Add Slide</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Slider Management</div>';
                  break;
          }

          break;
		  
      case "faq";

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=faq" class="section">FAQs Management</a> <div class="divider"></div> <div class="active section">Edit FAQs</div>';
                  break;
              case "add":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <a href="index.php?do=faq" class="section">FAQs Management</a> <div class="divider"></div> <div class="active section">Add FAQ</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">FAQs Management</div>';
                  break;
          }

          break;

      case "news";

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=news" class="section">News Management</a> <div class="divider"></div> <div class="active section">Edit News Item</div>';
                  break;
              case "add":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <a href="index.php?do=news" class="section">News Management</a> <div class="divider"></div> <div class="active section">Add News Item</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">News Management</div>';
                  break;
          }

          break;

      case "countries";

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=countries" class="section">Country Management</a> <div class="divider"></div> <div class="active section">Edit Country</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Country Management</div>';
                  break;
          }

          break;
		  
      case "leaders";

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=leaders" class="section">Leaders Management</a> <div class="divider"></div> <div class="active section">Edit Leader</div>';
                  break;
              case "add":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=leaders" class="section">Leaders Management</a> <div class="divider"></div> <div class="active section">Add Leader</div>';
                  break;              
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Leaders Management</div>';
                  break;
          }

          break;

      case "bills";

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=bills" class="section">Bills Management</a> <div class="divider"></div> <div class="active section">Edit Bill</div>';
                  break;
              case "add":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=bills" class="section">Bill Management</a> <div class="divider"></div> <div class="active section">Add Bills</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Bills Management</div>';
                  break;
          }

          break;

      case "committees";

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=committees" class="section">Committees Management</a> <div class="divider"></div> <div class="active section">Edit Cmmittee</div>';
                  break;
              case "add":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=committees" class="section">Committee Management</a> <div class="divider"></div> <div class="active section">Add Committee</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Committees Management</div>';
                  break;
          }

          break;

      case "committees-type";

          switch (Filter::$action) {
              case "edit":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=committees-type" class="section">Committee Types Management</a> <div class="divider"></div> <div class="active section">Edit Type</div>';
                  break;
              case "add":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=committees-type" class="section">Committee Types Management</a> <div class="divider"></div> <div class="active section">Add Type</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Committee Types Management</div>';
                  break;
          }

          break;

      case "constituencies":

          echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Constituency Manager</div>';
          break;
                      
		        
		  
      case "comments":

          switch (Filter::$action) {
              case "config":
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div><a href="index.php?do=comments" class="section">Comments Management</a> <div class="divider"></div> <div class="active section">Comments Configuration</div>';
                  break;
              default:
                  echo '<i class="icon home"></i> <a href="index.php" class="section">Dashboard</a> <div class="divider"></div> <div class="active section">Comments Management</div>';
                  break;
          }

          break;
		  

          echo '<i class="icon home"></i> <div class="divider"></div> <div class="active section">Welcome</div>';

      break;
  }
?>