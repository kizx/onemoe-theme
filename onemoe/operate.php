    <div id="mask" class="mask" style="display:none;"></div>
<?php
    if ($_SERVER['admin']) {
        if (!isset($_GET['preview'])) { ?>
    <div style="word-break: break-all;word-wrap: break-word;">
        <div id="rename_div" class="operatediv" style="display:none">
            <div>
                <label id="rename_label"></label><br><br><a onclick="operatediv_close('rename')" class="operatediv_close"><?php echo getconstStr('Close'); ?></a>
                <form id="rename_form" onsubmit="return submit_operate('rename');">
                <input id="rename_sid" name="rename_sid" type="hidden" value="">
                <input id="rename_hidden" name="rename_oldname" type="hidden" value="">
                <input id="rename_input" name="rename_newname" type="text" value="">
                <input name="operate_action" type="submit" value="<?php echo getconstStr('Rename'); ?>">
                </form>
            </div>
        </div>
        <div id="delete_div" class="operatediv" style="display:none">
            <div>
                <br><a onclick="operatediv_close('delete')" class="operatediv_close"><?php echo getconstStr('Close'); ?></a>
                <label id="delete_label"></label>
                <form id="delete_form" onsubmit="return submit_operate('delete');">
                <label id="delete_input"><?php echo getconstStr('Delete'); ?>?</label>
                <input id="delete_sid" name="delete_sid" type="hidden" value="">
                <input id="delete_hidden" name="delete_name" type="hidden" value="">
                <input name="operate_action" type="submit" value="<?php echo getconstStr('Submit'); ?>">
                </form>
            </div>
        </div>
        <div id="encrypt_div" class="operatediv" style="display:none">
            <div>
                <label id="encrypt_label"></label><br><br><a onclick="operatediv_close('encrypt')" class="operatediv_close"><?php echo getconstStr('Close'); ?></a>
                <form id="encrypt_form" onsubmit="return submit_operate('encrypt');">
                <input id="encrypt_sid" name="encrypt_sid" type="hidden" value="">
                <input id="encrypt_hidden" name="encrypt_folder" type="hidden" value="">
                <input id="encrypt_input" name="encrypt_newpass" type="text" value="" placeholder="<?php echo getconstStr('InputPasswordUWant'); ?>">
                <?php if (getConfig('passfile')!='') {?><input name="operate_action" type="submit" value="<?php echo getconstStr('encrypt'); ?>"><?php } else { ?><br><label><?php echo getconstStr('SetpassfileBfEncrypt'); ?></label><?php } ?>
                </form>
            </div>
        </div>
        <div id="copy_div" class="operatediv" style="display:none">
            <div>
                <label id="copy_label"></label><br><br><a onclick="operatediv_close('copy')" class="operatediv_close"><?php echo getconstStr('Close'); ?></a>
                <form id="copy_form" onsubmit="return submit_operate('copy');">
                <input id="copy_sid" name="copy_sid" type="hidden" value="">
                <input id="copy_hidden" name="copy_name" type="hidden" value="">
                <input id="copy_input" name="copy_input" type="hidden" value="">
                <input name="operate_action" type="submit" value="<?php echo getconstStr('Copy'); ?>">
                </form>
            </div>
        </div>
        <div id="move_div" class="operatediv" style="display:none">
            <div>
                <label id="move_label"></label><br><br><a onclick="operatediv_close('move')" class="operatediv_close"><?php echo getconstStr('Close'); ?></a>
                <form id="move_form" onsubmit="return submit_operate('move');">
                <input id="move_sid" name="move_sid" type="hidden" value="">
                <input id="move_hidden" name="move_name" type="hidden" value="">
                <select id="move_input" name="move_folder">
<?php   if ($path != '/') { ?>
                    <option value="/../"><?php echo getconstStr('ParentDir'); ?></option>
<?php   }
        if (isset($files['children'])) foreach ($files['children'] as $file) {
            if (isset($file['folder'])) { ?>
                    <option value="<?php echo str_replace('&','&amp;', $file['name']);?>"><?php echo str_replace('&','&amp;', $file['name']);?></option>
<?php       }
        } ?>
                </select>
                <input name="operate_action" type="submit" value="<?php echo getconstStr('Move'); ?>">
                </form>
            </div>
        </div>
        <div id="create_div" class="operatediv" style="display:none">
            <div>
                <a onclick="operatediv_close('create')" class="operatediv_close"><?php echo getconstStr('Close'); ?></a>
                <form id="create_form" onsubmit="return submit_operate('create');">
                    <input id="create_sid" name="create_sid" type="hidden" value="">
                    <input id="create_hidden" type="hidden" value="">
                    <table>
                        <tr>
                            <td></td>
                            <td><label id="create_label"></label></td>
                        </tr>
                        <tr>
                            <td>　　　</td>
                            <td>
                                <label><input id="create_type_folder" name="create_type" type="radio" value="folder" onclick="document.getElementById('create_text_div').style.display='none';"><?php echo getconstStr('Folder'); ?></label>
                                <label><input id="create_type_file" name="create_type" type="radio" value="file" onclick="document.getElementById('create_text_div').style.display='';" checked><?php echo getconstStr('File'); ?></label>
                            <td>
                        </tr>
                        <tr>
                            <td><?php echo getconstStr('Name'); ?>：</td>
                            <td><input id="create_input" name="create_name" type="text" value=""></td>
                        </tr>
                        <tr id="create_text_div">
                            <td><?php echo getconstStr('Content'); ?>：</td>
                            <td><textarea id="create_text" name="create_text" rows="6" cols="40"></textarea></td>
                        </tr>
                        <tr>
                            <td>　　　</td>
                            <td><input name="operate_action" type="submit" value="<?php echo getconstStr('Create'); ?>"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php   }
    } else {
        if (getConfig('admin')!='') if (getConfig('adminloginpage')=='') { ?>
    <div id="login_div" class="operatediv" style="display:none">
        <div style="margin:50px">
            <a onclick="operatediv_close('login')" class="operatediv_close"><?php echo getconstStr('Close'); ?></a>
	        <center>
	            <form action="<?php echo isset($_GET['preview'])?'?preview&':'?';?>admin" method="post">
		        <input id="login_input" name="password1" type="password" placeholder="<?php echo getconstStr('InputPassword'); ?>">
		        <input type="submit" value="<?php echo getconstStr('Login'); ?>">
	            </form>
            </center>
        </div>
	</div>
<?php   }
    }