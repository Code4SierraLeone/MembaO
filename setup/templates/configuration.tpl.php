<div class="nav"><b>pre-installation check</b> &raquo; <b>configuration</b> &raquo; completed</div>
<h2 id="install">General Configuration</h2>
<?php echo ($msg) ?  "<div class=\"error\">{$msg}</div>" : '';?>
<form action="install.php?step=2" method="post">
  <p>Follow the 2 steps to have Memba-O! run on your server. It is recommended to install the sample data.</p>
  <h3>1. MySQL database configuration:</h3>
  <table class="inner-content data">
    <tr>
      <td>MySQL Hostname:</td>
      <td><input type="text" name="dbhost" size="30" value="<?php echo isset($_POST['dbhost']) ? sanitize($_POST['dbhost']) : 'localhost'; ?>" id="t1" />
        <span class="err" id="err1">Please input correct MySQL hostname.</span></td>
    </tr>
    <tr>
      <td>User Name:</td>
      <td><input type="text" name="dbuser" size="30" value="<?php echo isset($_POST['dbuser']) ? sanitize($_POST['dbuser']) : ''; ?>" id="t2" />
        <span class="err" id="err2">Please input correct MySQL username.</span></td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input type="password" name="dbpwd" size="30" value="" /></td>
    </tr>
    <tr>
      <td>Database Name:</td>
      <td><input type="text" name="dbname" size="30" value="<?php echo isset($_POST['dbname']) ? sanitize($_POST['dbname']) : ''; ?>" id="t3"/>
        <span class="err" id="err3">Please input correct database name.</span></td>
    </tr>
    <tr>
      <td>Install sample data:</td>
      <td><input type="checkbox" id="install_data" name="install_data" checked="checked" /></td>
    </tr>
  </table>
  <input type="hidden" name="db_action" id="db_action" value="1" />
  <h3>2. Common configuration</h3>
  <p>Configure correct paths and URLs to your Memba-O! installation. Please select the <strong>camembao</strong> theme as your template.</p>
  <table class="inner-content data">
    <tr>
      <td>URL:</td>
      <td><input type="text" name="site_url" value="http://<?php echo $_SERVER['SERVER_NAME'];?>" size="30"/></td>
    </tr>
    <tr>
      <td>Install Directory:</td>
      <td><input type="text" name="site_dir" value="<?php echo str_replace("/", "", $script_path);?>" size="30"/></td>
    </tr>
    <tr>
      <td>Application Name:</td>
      <td><input type="text" name="site_name" value="Your App Name" size="30"/></td>
    </tr>
    <tr>
      <td>Organisation Name:</td>
      <td><input type="text" name="company" value="Your Organisation Name" size="30"/></td>
    </tr>
    <tr>
      <td>Application Email:</td>
      <td><input type="text" name="site_email" value="me@domain.com" size="30"/></td>
    </tr>
  </table>
  <h3>3. Administrator configuration</h3>
  <p>Set your admin username and password. You will use these credentials to log into your administrator section and manage your data. All application notifications will be sent from this email and can be changed in your admin panel later.</p>
  <table class="inner-content data">
    <tr>
      <td>Admin Username:</td>
      <td><input type="text" name="admin_username" value="<?php echo isset($_POST['admin_username']) ? sanitize($_POST['admin_username']) : 'admin'; ?>" size="30" id="t4" />
        <span class="err" id="err4">Please input correct admin username.</span></td>
    </tr>
    <tr>
      <td>Admin Password:</td>
      <td><input type="password" name="admin_password" value="<?php echo isset($_POST['admin_password']) ? sanitize($_POST['admin_password']) : ''; ?>" size="30" id="t5" />
        <span class="err" id="err5">Please input password.</span></td>
    </tr>
    <tr>
      <td>Admin Password[confirm]:</td>
      <td><input type="password" name="admin_password2" value="" size="30" id="t6" />
        <span class="err" id="err6">Entered passwords do not match.</span></td>
    </tr>
  </table>
  <div class="btn lgn">
    <button type="button" onclick="document.location.href='install.php';" name="back">Back</button>
    &nbsp;&nbsp;
    <button type="submit" name="next">Next</button>
  </div>
</form>