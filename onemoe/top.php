    <div style="padding:1px" id="top-div">
<?php
    if (getConfig('admin')!='') if (!$_SERVER['admin']) {
        if (getConfig('adminloginpage')=='') { ?>
        <a class="login" onclick="login();"><ion-icon name="log-in"></ion-icon><?php echo getconstStr('Login'); ?></a>
<?php   }
    } else { ?>
        <li class="operate"><ion-icon name="construct"></ion-icon><?php echo getconstStr('Operate'); ?><ul>
<?php   if (isset($files['folder'])) { ?>
            <li><a onclick="showdiv(event,'create','');"><ion-icon name="add-circle"></ion-icon><?php echo getconstStr('Create'); ?></a></li>
            <li><a onclick="showdiv(event,'encrypt','');"><ion-icon name="lock"></ion-icon><?php echo getconstStr('encrypt'); ?></a></li>
            <li><a href="?RefreshCache"><ion-icon name="refresh"></ion-icon><?php echo getconstStr('RefreshCache'); ?></a></li>
<?php   } ?>
            <li><a href="<?php echo isset($_GET['preview'])?'?preview&':'?';?>setup"><ion-icon name="settings"></ion-icon><?php echo getconstStr('Setup'); ?></a></li>
            <li><a onclick="logout()"><ion-icon name="log-out"></ion-icon><?php echo getconstStr('Logout'); ?></a></li>
        </ul></li>
<?php
    } ?>
        &nbsp;
        <select class="changelanguage" name="language" onchange="changelanguage(this.options[this.options.selectedIndex].value)">
            <option value="">Language</option>
<?php
    foreach ($constStr['languages'] as $key1 => $value1) { ?>
            <option value="<?php echo $key1; ?>" <?php echo $key1==$constStr['language']?'selected="selected"':'' ?>><?php echo $value1; ?></option>
<?php
    } ?>
        </select>
    </div>
<?php
    if (isset($_SERVER['needUpdate'])&&$_SERVER['needUpdate']) { ?>
    <div style='position:absolute;'><font color='red'><?php echo getconstStr('NeedUpdate'); ?></font></div>
<?php }
