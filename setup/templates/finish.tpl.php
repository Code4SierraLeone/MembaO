<div class="nav"><b>pre-installation check &raquo; configuration &raquo; completed</b></div>
<h2 id="install">Installation completed</h2>
<h3>Installation log:</h3>
<p>A copy of the configuration file will be downloaded to your computer when you click the button 'Download config.ini.php'. You should upload this file to the same directory where you have placed the Memba-O! application files. After this is done, log in to your admin panel using the credentials you provided on the previous form.<br />
</p>
<table class="inner-content data">
  <tr>
    <td>Database Installation</td>
    <td><?php if ($msg):?>
      <?php echo '<span class="no">Error during MySQL queries execution:</span><br />'; ?> <?php echo $msg; ?>
      <?php else : ?>
      <?php echo '<span class="yes">OK</span>'; ?>
      <?php endif; ?></td>
  </tr>
  <tr>
    <td>Configuration File</td>
    <td><span class="yes">Available for download</span><br />
      Should you have issues creating the config file, save config.inc.php file to your local PC and then upload to the application's <strong>lib</strong> directory. <a href="javascript:void(0);" onclick="if (document.getElementById('file_content').style.display=='block') { document.getElementById('file_content').style.display='none';} else {document.getElementById('file_content').style.display='block'}">Click here</a> to view the content of config.ini.php file.<br />
      <div style="margin: 10px 0; text-align: center;">
        <input type="button" onclick="document.location.href='safe_config.php?h=<?php echo $_POST['dbhost'].'&u='.$_POST['dbuser'].'&p='.$_POST['dbpwd'].'&n='.$_POST['dbname'];?>';" value="Download config.ini.php" />
      </div></td>
  </tr>
  <tr>
    <td colspan="2"><div style="display:none;border: 1px solid #777;height: 400px; background-color: #fff; padding:10px;overflow:auto;" id="file_content">
        <?php if (is_callable("highlight_string")):?>
        <?php highlight_string(safeConfig($_POST['dbhost'] , $_POST['dbuser'], $_POST['dbpwd'], $_POST['dbname']));?>
        <?php endif;?>
      </div></td>
  </tr>
  <tr>
    <td colspan="2"><div class="remove_install">DELETE 'setup' directory from your server.</div>
      <br />
      <div class="remove_install">Please for security reasons chmod your /lib/ directory to 0755.</div></td>
  </tr>
</table>
<div class="btn lgn">
  <button type="button" onclick="history.go(-1);" name="check">Back</button>
  &nbsp;&nbsp;
  <button type="button" onclick="document.location.href='../admin/';" name="next" tabindex="3">Admin</button>
</div>