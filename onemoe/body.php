<?php
            if (isset($files['children']['head.md'])) { ?>
    <div class="list-wrapper" id="head-div">
        <div class="list-container">
            <div class="list-header-container">
                <div class="readme">
                    <div class="markdown-body" id="head">
                        <textarea id="head-md" style="display:none;"><?php echo fetch_files(spurlencode(path_format(urldecode($path) . '/head.md'),'/'))['content']['body']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php       } ?>
    <div class="list-wrapper" id="list-div">
        <div class="list-container">
            <div class="list-header-container">
<?php
    if ($path !== '/') {
        $current_url = $_SERVER['PHP_SELF'];
        while (substr($current_url, -1) === '/') {
            $current_url = substr($current_url, 0, -1);
        }
        if (strpos($current_url, '/') !== FALSE) {
            $parent_url = substr($current_url, 0, strrpos($current_url, '/'));
        } else {
            $parent_url = $current_url;
        }
?>
                <a href="<?php echo $parent_url.'/'; ?>" class="back-link">
                    <ion-icon name="arrow-back"></ion-icon>
                </a>
<?php } ?>
                <h3 class="table-header"><?php echo str_replace('%23', '#', str_replace('&','&amp;', $path)); ?></h3>
            </div>
            <div class="list-body-container">
<?php
    $pdfurl = false;
    $DPvideo = false;
    if ($_SERVER['is_guestup_path']&&!$_SERVER['admin']) { ?>
                <div id="upload_div" style="margin:10px">
                <center>
                    <input id="upload_file" type="file" name="upload_filename">
                    <input id="upload_submit" onclick="preup();" value="<?php echo getconstStr('Upload'); ?>" type="button">
                <center>
                </div>
<?php } else {
        if ($_SERVER['ishidden']<4) {
            if (isset($files['error'])) {
                    echo '<div style="margin:8px;">' . $files['error']['message'] . '</div>';
                    $statusCode=404;
            } else {
                if (isset($files['file'])) {
?>
                <div style="margin: 12px 4px 4px; text-align: center">
                    <div style="margin: 24px">
                        <textarea id="url" title="url" rows="1" style="width: 100%; margin-top: 2px;" readonly><?php echo str_replace('%2523', '%23', str_replace('%26amp%3B','&amp;',spurlencode(path_format($_SERVER['base_disk_path'] . '/' . $path), '/'))); ?></textarea>
                        <a href="<?php echo path_format($_SERVER['base_disk_path'] . '/' . $path);//$files[$_SERVER['DownurlStrName']] ?>"><ion-icon name="download" style="line-height: 16px;vertical-align: middle;"></ion-icon>&nbsp;<?php echo getconstStr('Download'); ?></a>
                    </div>
                    <div style="margin: 24px">
<?php               $ext = strtolower(substr($path, strrpos($path, '.') + 1));
                    if (in_array($ext, $exts['img'])) {
                        echo '                        <img src="' . $files[$_SERVER['DownurlStrName']] . '" alt="' . substr($path, strrpos($path, '/')) . '" onload="if(this.offsetWidth>document.getElementById(\'url\').offsetWidth) this.style.width=\'100%\';" />
';
                    } elseif (in_array($ext, $exts['video'])) {
                    //echo '<video src="' . $files[$_SERVER['DownurlStrName']] . '" controls="controls" style="width: 100%"></video>';
                        $DPvideo=$files[$_SERVER['DownurlStrName']];
                        echo '                        <div id="video-a0"></div>
';
                    } elseif (in_array($ext, $exts['music'])) {
                        echo '                        <audio src="' . $files[$_SERVER['DownurlStrName']] . '" controls="controls" style="width: 100%"></audio>
';
                    } elseif (in_array($ext, ['pdf'])) {
                        /*echo '
                        <embed src="' . $files[$_SERVER['DownurlStrName']] . '" type="application/pdf" width="100%" height=800px">
';*/
                        $pdfurl = $files[$_SERVER['DownurlStrName']];
                        echo '                        <div id="pdf-d"></div>
';
                    } elseif (in_array($ext, $exts['office'])) {
                        echo '                        <iframe id="office-a" src="https://view.officeapps.live.com/op/view.aspx?src=' . urlencode($files[$_SERVER['DownurlStrName']]) . '" style="width: 100%;height: 800px" frameborder="0"></iframe>
';
                    } elseif (in_array($ext, $exts['txt'])) {
                        $txtstr = htmlspecialchars(curl_request($files[$_SERVER['DownurlStrName']])['body']);
?>
                        <div id="txt">
<?php                   if ($_SERVER['admin']) { ?>
                        <form id="txt-form" action="" method="POST">
                            <a onclick="document.getElementById('txt-a').readOnly='';document.getElementById('txt-save').style.display='';document.getElementById('txt-editbutton').style.display='none';document.getElementById('txt-cancelbutton').style.display='';" id="txt-editbutton"><ion-icon name="create"></ion-icon><?php echo getconstStr('ClicktoEdit'); ?></a>
                            <a onclick="document.getElementById('txt-a').readOnly='readonly';document.getElementById('txt-save').style.display='none';document.getElementById('txt-editbutton').style.display='';document.getElementById('txt-cancelbutton').style.display='none';" id="txt-cancelbutton" style="display:none"><ion-icon name="close"></ion-icon><?php echo getconstStr('CancelEdit'); ?></a>&nbsp;&nbsp;&nbsp;
                            <a id="txt-save" style="display:none"><ion-icon name="save"></ion-icon><?php echo getconstStr('Save'); ?></a>
<?php                   } ?>
                            <textarea id="txt-a" name="editfile" readonly style="width: 100%; margin-top: 2px;" <?php if ($_SERVER['admin']) echo 'onchange="document.getElementById(\'txt-save\').onclick=function(){document.getElementById(\'txt-form\').submit();}"';?> ><?php echo $txtstr;?></textarea>
<?php                   if ($_SERVER['admin']) echo '</form>'; ?>
                        </div>
<?php               } /*elseif (in_array($ext, ['md'])) {
                        echo '                        <div class="markdown-body" id="readme">
                            <textarea id="readme-md" style="display:none;">' . curl_request($files[$_SERVER['DownurlStrName']])['body'] . '</textarea>
                        </div>
';
                    }*/ else {
                        echo '<span>'.getconstStr('FileNotSupport').'</span>';
                    } ?>
                    </div>
                </div>
<?php           } elseif (isset($files['folder'])) {
                    if (isset($_POST['filenum'])) $filenum = $_POST['filenum'];
                    if (!isset($filenum) and isset($files['folder']['page'])) $filenum = ($files['folder']['page']-1)*200;
                    else $filenum = 0; ?>
                <table class="list-table" id="list-table">
                    <tr id="tr0">
                        <th class="file"><a onclick="sortby('a');"><?php echo getconstStr('File'); ?></a><?php if (!(isset($_SERVER['USER'])&&$_SERVER['USER']=='qcloud')) { ?>&nbsp;&nbsp;&nbsp;<button onclick="showthumbnails(this);"><?php echo getconstStr('ShowThumbnails'); ?></button><?php } ?>&nbsp;<button onclick="CopyAllDownloadUrl('.download');"><?php echo getconstStr('CopyAllDownloadUrl'); ?></button></th>
                        <th class="updated_at"><a onclick="sortby('time');"><?php echo getconstStr('EditTime'); ?></a></th>
                        <th class="size"><a onclick="sortby('size');"><?php echo getconstStr('Size'); ?></a></th>
                    </tr>
                    <!-- Dirs -->
<?php               //echo json_encode($files['children'], JSON_PRETTY_PRINT);
                    foreach ($files['children'] as $file) {
                        // Folders
                        if (isset($file['folder'])) { 
                            $filenum++; ?>
                    <tr data-to id="tr<?php echo $filenum;?>">
                        <td class="file">
<?php                       if ($_SERVER['admin']) { ?>
                            <li class="operate"><ion-icon name="construct"></ion-icon><a><?php echo getconstStr('Operate'); ?></a>
                            <ul>
                                <li><a onclick="showdiv(event,'encrypt',<?php echo $filenum;?>);"><ion-icon name="lock"></ion-icon><?php echo getconstStr('encrypt'); ?></a></li>
                                <li><a onclick="showdiv(event, 'rename',<?php echo $filenum;?>);"><ion-icon name="create"></ion-icon><?php echo getconstStr('Rename'); ?></a></li>
                                <li><a onclick="showdiv(event, 'move',<?php echo $filenum;?>);"><ion-icon name="move"></ion-icon><?php echo getconstStr('Move'); ?></a></li>
                                <li><a onclick="showdiv(event, 'copy',<?php echo $filenum;?>);"><ion-icon name="copy"></ion-icon><?php echo getconstStr('Copy'); ?></a></li>
                                <li><a onclick="showdiv(event, 'delete',<?php echo $filenum;?>);"><ion-icon name="trash"></ion-icon><?php echo getconstStr('Delete'); ?></a></li>
                            </ul>
                            </li>
<?php                       } ?>
                            <ion-icon name="folder"></ion-icon>
                            <a id="file_a<?php echo $filenum;?>" name="filelist" href="<?php echo path_format($_SERVER['base_disk_path'] . '/' . $path . '/' . encode_str_replace($file['name']) . '/'); ?>"><?php echo str_replace('&','&amp;', $file['name']);?></a>
                        </td>
                        <td class="updated_at" id="folder_time<?php echo $filenum;?>"><?php echo time_format($file['lastModifiedDateTime']); ?></td>
                        <td class="size" id="folder_size<?php echo $filenum;?>"><?php echo size_format($file['size']); ?></td>
                    </tr>
<?php                   }
                    }
                    // if ($filenum) echo '<tr data-to></tr>';
                    foreach ($files['children'] as $file) {
                        // Files
                        if (isset($file['file'])) {
                            if ($_SERVER['admin'] or !isHideFile($file['name'])) {
                                $filenum++; ?>
                    <tr data-to id="tr<?php echo $filenum;?>">
                        <td class="file">
<?php                           if ($_SERVER['admin']) { ?>
                            <li class="operate"><ion-icon name="construct"></ion-icon><a><?php echo getconstStr('Operate'); ?></a>
                            <ul>
                                <li><a onclick="showdiv(event, 'rename',<?php echo $filenum;?>);"><ion-icon name="create"></ion-icon><?php echo getconstStr('Rename'); ?></a></li>
                                <li><a onclick="showdiv(event, 'move',<?php echo $filenum;?>);"><ion-icon name="move"></ion-icon><?php echo getconstStr('Move'); ?></a></li>
                                <li><a onclick="showdiv(event, 'copy',<?php echo $filenum;?>);"><ion-icon name="copy"></ion-icon><?php echo getconstStr('Copy'); ?></a></li>
                                <li><a onclick="showdiv(event, 'delete',<?php echo $filenum;?>);"><ion-icon name="trash"></ion-icon><?php echo getconstStr('Delete'); ?></a></li>
                            </ul>
                            </li>
<?php                           }
                                $ext = strtolower(substr($file['name'], strrpos($file['name'], '.') + 1));
                                if (in_array($ext, $exts['music'])) { ?>
                            <ion-icon name="musical-notes"></ion-icon>
<?php                           } elseif (in_array($ext, $exts['video'])) { ?>
                            <ion-icon name="logo-youtube"></ion-icon>
<?php                           } elseif (in_array($ext, $exts['img'])) { ?>
                            <ion-icon name="image"></ion-icon>
<?php                           } elseif (in_array($ext, $exts['office'])) { ?>
                            <ion-icon name="paper"></ion-icon>
<?php                           } elseif (in_array($ext, $exts['txt'])) { ?>
                            <ion-icon name="clipboard"></ion-icon>
<?php                           } elseif (in_array($ext, $exts['zip'])) { ?>
                            <ion-icon name="filing"></ion-icon>
<?php                           } elseif ($ext=='iso') { ?>
                            <ion-icon name="disc"></ion-icon>
<?php                           } elseif ($ext=='apk') { ?>
                            <ion-icon name="logo-android"></ion-icon>
<?php                           } elseif ($ext=='exe') { ?>
                            <ion-icon name="logo-windows"></ion-icon>
<?php                           } else { ?>
                            <ion-icon name="document"></ion-icon>
<?php                           } ?>
                            <a id="file_a<?php echo $filenum;?>" name="filelist" href="<?php echo path_format($_SERVER['base_disk_path'] . '/' . $path . '/' . encode_str_replace($file['name'])); ?>?preview" target=_blank><?php echo str_replace('&','&amp;', $file['name']); ?></a>
                            <a class="download" href="<?php echo path_format($_SERVER['base_disk_path'] . '/' . $path . '/' . str_replace('&','&amp;', $file['name']));?>"><ion-icon name="download"></ion-icon></a>
                        </td>
                        <td class="updated_at" id="file_time<?php echo $filenum;?>"><?php echo time_format($file['lastModifiedDateTime']); ?></td>
                        <td class="size" id="file_size<?php echo $filenum;?>"><?php echo size_format($file['size']); ?></td>
                    </tr>
<?php                       }
                        }
                    } ?>
                </table>
<?php               if ($files['folder']['childCount']>200) {
                        $pagenum = $files['folder']['page'];
                        $maxpage = ceil($files['folder']['childCount']/200);
                        $prepagenext = '
                <form action="" method="POST" id="nextpageform">
                    <input type="hidden" id="pagenum" name="pagenum" value="'. $pagenum .'">
                    <table width=100% border=0>
                        <tr>
                            <td width=60px align=center>';
                        if ($pagenum!=1) {
                            $prepagenum = $pagenum-1;
                            $prepagenext .= '
                                <a onclick="nextpage('.$prepagenum.');">'.getconstStr('PrePage').'</a>';
                        }
                        $prepagenext .= '
                            </td>
                            <td class="updated_at">';
                        for ($page=1;$page<=$maxpage;$page++) {
                            if ($page == $pagenum) {
                                $prepagenext .= '
                                <font color=red>' . $page . '</font> ';
                            } else {
                                $prepagenext .= '
                                <a onclick="nextpage('.$page.');">' . $page . '</a> ';
                            }
                        }
                        $prepagenext = substr($prepagenext,0,-1);
                        $prepagenext .= '
                            </td>
                            <td width=60px align=center>';
                        if ($pagenum!=$maxpage) {
                            $nextpagenum = $pagenum+1;
                            $prepagenext .= '
                                <a onclick="nextpage('.$nextpagenum.');">'.getconstStr('NextPage').'</a>';
                        }
                        $prepagenext .= '
                            </td>
                        </tr>
                    </table>
                </form>';
                        echo $prepagenext;
                    }
                    if ($_SERVER['admin']) { ?>
                <div id="upload_div" style="margin:0 0 16px 0">
                <center>
                    <input id="upload_file" type="file" name="upload_filename" multiple="multiple">
                    <input id="upload_submit" onclick="preup();" value="<?php echo getconstStr('Upload'); ?>" type="button">
                </center>
                </div>
<?php               }
                } else {
                    $statusCode=500;
                    echo 'Unknown path or file.';
                    echo json_encode($files, JSON_PRETTY_PRINT);
                }
                if (isset($files['children']['readme.md'])) {
                    echo '
            </div>
        </div>
    </div>
    <div class="list-wrapper" id="readme-div">
        <div class="list-container">
            <div class="list-header-container">
                <div class="readme">
                    <div class="markdown-body" id="readme">
                        <textarea id="readme-md" style="display:none;">' . fetch_files(spurlencode(path_format(urldecode($path) . '/readme.md'),'/'))['content']['body'] . '</textarea>
                    </div>
                </div>
';
                }
            }
        } else {
            echo '
                <div style="padding:20px">
	            <center>
	                <form action="" method="post">
		            <input name="password1" type="password" placeholder="'.getconstStr('InputPassword').'">
		            <input type="submit" value="'.getconstStr('Submit').'">
	                </form>
                </center>
                </div>';
            $statusCode = 401;
        }
    } ?>
            </div>
        </div>
    </div>
