    <h1 class="title" id="title">
        <a href="<?php echo $_SERVER['base_path']; ?>"><?php echo $_SERVER['sitename']; ?></a>
    </h1>
<?php $disktags = explode("|",getConfig('disktag'));
    if (count($disktags)>1) { ?>
    <div class="list-wrapper" id="more-disk-div">
        <div class="list-container">
            <div class="list-header-container">
                <div class="more-disk">
<?php foreach ($disktags as $disk) {
        $diskname = getConfig('diskname', $disk);
        if ($diskname=='') $diskname = $disk;
        echo '                    <a href="'.path_format($_SERVER['base_path'].'/'.$disk.'/').'"'.($_SERVER['disktag']==$disk?' now':'').'>'.$diskname.'</a>
';
    } ?>
                </div>
            </div>
        </div>
    </div>
<?php }
