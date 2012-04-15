<?php 
$action = $this->uri->segment(1);
$action_next = $this->uri->segment(2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $layout['description']; ?>" />
<meta name="keywords" content="<?php echo $layout['keywords']; ?>" />
<title><?php echo $layout['title']; ?></title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>static/images/favicon.ico"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>static/stylesheets/reset.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>static/stylesheets/global.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>static/javascripts/jquery.js"></script>
<?php 
    if (!empty($layout['css'])) {
        foreach ($layout['css'] as $css) {
            echo '<link rel="stylesheet" type="text/css" href="'.$css.'" />';
        }
    }
    
    if (!empty($layout['javascript'])) {
        foreach ($layout['javascript'] as $javascript) {
            echo '<script type="text/javascript" src="'.$javascript.'"></script>';
        }
    }
?>
</head>

<body>
	<?php $this->load->view('comm/header.php'); ?>
	<div id="wrapper">
		<div class="container">
			<?php echo $layout['content']; //内容?>
		</div>
		<div class="clear"></div>		
	</div>
	<?php $this->load->view('comm/footer.php'); ?>
</body>
</html>