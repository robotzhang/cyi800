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
<title>A计划装修平台CMS系统</title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>/static/images/favicon.ico"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>/static/stylesheets/reset.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/static/stylesheets/admin/admin.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/static/stylesheets/admin/icon.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>/static/javascripts/jquery.js"></script>
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

<div id="header">
	<div style="float:right; line-height:40px;height40px; color:#FFFFFF;margin-right:50px;">
		<span>欢迎：<!--? php echo $_SESSION['user']->username; ?--></span>
		<span class="icon hline">&nbsp;</span>
		<span><a href="<?php echo site_url('welcome/logout');?>" class="icon logout" style="color:#fff;">退出系统</a></span>
	</div>
	<img src="<?php echo base_url();?>static/images/logo.png" />
	<div class="clear"></div>
</div>
<div class="clear"></div>

<div class="container">
	<?php $action = $this->uri->segment(2); ?>
	<?php if ($action == 'login'): ?>
		<?php echo $layout['content']; //内容?>
	<?php else: ?>
	<div style="float:left;margin-right:20px;">
		<?php $this->load->view('comm/admin/menu.php');?>
	</div>

	<div>
		<?php echo $layout['content']; //内容?>
	</div>
	<?php endif; ?>
	
	<div class="clear"></div>
	
	<?php $this->load->view('comm/admin/footer.php'); ?>
	<div class="clear"></div>	
</div>

<div class="clear"></div>

</body>
</html>