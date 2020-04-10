<?php if ($files) { ?>
<?php if (isset($files['children']['head.md'])||isset($files['children']['readme.md'])) { ?><link rel="stylesheet" href="//unpkg.zhimg.com/github-markdown-css@3.0.1/github-markdown.css">
<script type="text/javascript" src="//unpkg.zhimg.com/marked@0.6.2/marked.min.js"></script><?php } ?>
<?php if (isset($files['folder']) && $_SERVER['is_guestup_path'] && !$_SERVER['admin']) { ?><script type="text/javascript" src="//cdn.bootcss.com/spark-md5/3.0.0/spark-md5.min.js"></script><?php } ?>
<?php if ($pdfurl!='') { ?><script src="//cdn.bootcss.com/pdf.js/2.3.200/pdf.min.js"></script><?php } ?>
<?php }