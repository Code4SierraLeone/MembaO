<script type="text/javascript" src="script.js"></script>
<div class="nav"><b>pre-installation check</b> &raquo; configuration &raquo; completed</div>
<h2 id="install">Pre-installation check</h2>
<h3>1. Server configuration</h3>
<p>If any of these items are highlighted in red then please take actions to correct them. Failure to do so could lead to your installation not functioning correctly. </p>
<table class="inner-content">
  <thead>
    <tr>
      <th>PHP Settings</th>
      <th>Current Settings</th>
      <th>Required Settings</th>
      <th>Status</th>
    </tr>
  </thead>
  <tr>
    <td>PHP Version:</td>
    <td><?php echo phpversion(); ?></td>
    <td>5.3+</td>
    <td><?php echo (phpversion() >= '5.3') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
  <tr>
    <td>Register Globals:</td>
    <td><?php echo (ini_get('register_globals')) ? 'On' : 'Off'; ?></td>
    <td>Off</td>
    <td><?php echo (!ini_get('register_globals')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
  <tr>
    <td>Safe Mode:</td>
    <td><?php echo (ini_get('safe_mode')) ? 'On' : 'Off'; ?></td>
    <td>Off</td>
    <td><?php echo (!ini_get('safe_mode')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
  <tr>
    <td>Magic Quotes GPC:</td>
    <td><?php echo (ini_get('magic_quotes_gpc')) ? 'On' : 'Off'; ?></td>
    <td>Off</td>
    <td><?php echo (!ini_get('magic_quotes_gpc')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
  <tr>
    <td>File Uploads:</td>
    <td><?php echo (ini_get('file_uploads')) ? 'On' : 'Off'; ?></td>
    <td>On</td>
    <td><?php echo (ini_get('file_uploads')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
  <tr>
    <td>Php Memory:</td>
    <td><?php echo $mem = ini_get('memory_limit');?></td>
    <td>64MB</td>
    <td><?php echo ($mem >= 64) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
  <tr>
    <td>Session Auto Start:</td>
    <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
    <td>Off</td>
    <td><?php echo (!ini_get('session_auto_start')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
</table>
<h3>2. Server Extensions</h3>
<p>These settings are recommended for PHP in order to ensure full compatibility with Digital Downloads Pro.
  However, Digital Downloads Pro will still operate if your settings do not quite match the recommended.</p>
<table class="inner-content">
  <thead>
    <tr>
      <th>Extension</th>
      <th>Current Settings</th>
      <th>Required Settings</th>
      <th>Status</th>
    </tr>
  </thead>
  <tr>
    <td>MySqli:</td>
    <td><?php echo extension_loaded('mysqli') ? 'On' : 'Off'; ?></td>
    <td>On</td>
    <td><?php echo extension_loaded('mysqli') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
  <tr>
    <td>GD:</td>
    <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
    <td>On</td>
    <td><?php echo extension_loaded('gd') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
  <tr>
    <td>Curl Enabled:</td>
    <td><?php echo (function_exists('curl_version')) ? 'On' : 'Off'; ?></td>
    <td>On</td>
    <td><?php echo (function_exists('curl_version')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
  <tr>
    <td>ZIP:</td>
    <td><?php echo extension_loaded('zlib') ? 'On' : 'Off'; ?></td>
    <td>On</td>
    <td><?php echo extension_loaded('zlib') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
  </tr>
</table>
<h3>3. Directory &amp; File Permissions</h3>
<p>In order for Digital Downloads Pro to function correctly it needs to be able to access or write to certain files or directories. If you see "Unwriteable" you need to change the permissions on the file or directory to allow Digital Downloads Pro to write to it.</p>
<table class="inner-content">
  <?php getWritableCell('lib');?>
  <?php getWritableCell('uploads');?>
  <?php getWritableCell('cache');?>
  <tr>
    <td>.htaccess</td>
    <td><?php
			  if (is_writable('../.htaccess')):
				  echo '<span class="yes">Writeable</span>';
			  else:
				  echo '<span class="no">Unwriteable</span>';
			  endif;
		  ?></td>
  </tr>
  <tr>
    <td>Apache mod_rewrite</td>
    <td id="modrewcont"><?php testModRewrite();?></td>
  </tr>
</table>
<div class="btn lgn">
  <button type="button" onclick="document.location.href='install.php';" name="check">Check</button>
  &nbsp;&nbsp;
  <button type="button" onclick="document.location.href='install.php?step=1';" name="next" tabindex="3" >Next</button>
</div>
