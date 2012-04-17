<script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>static/plugins/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//为textarea绑定编辑器
		$.each($('textarea'), function(i, e){
			var editor_id = 'editor_' + i;
			$(this).attr('id', editor_id);
			KE.init({
		    id : editor_id,
				height: '350',
				urlType:'domain', //改变站内本地URL
				imageUploadJson:'<?php echo base_url();?>upload/editor',
				items : [
					'source', 'fullscreen', '|', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'removeformat', '|', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist', 'insertunorderedlist', '|', 'emoticons', 'image', 'link'
				]
			});
		});
		//加载编辑器
		KE.create($('textarea').attr('id'));
		
		//设置错误
		<?php foreach(array('title', 'sub_title', 'content', 'hits') as $value):?>
		<?php if (function_exists('form_error')) $error = form_error($value);?>
		<?php if (!empty($error)): ?>
		$('.form [name=<?php echo $value;?>]').addClass('field_error');
		<?php endif;?>
		<?php endforeach;?>
	});
</script>

<?php if (function_exists('validation_errors')) echo '<div class="error">'.validation_errors().'</div>'; ?>
<form action="<?php echo site_url('admin/modify');?>" method="post">
<input type="hidden" name="id" value="<?php echo isset($record->id) ? $record->id : ''; ?>"/>
<table class="form" style="width:100%;">
	<tr>
		<td>
			<span class="label">产品名称：</span>
			<input name="name" style="width:540px!important;" value="<?php echo isset($record->name) ? $record->name : ''; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">简短描述：</span>
			<input name="brief" style="width:540px!important;" value="<?php echo isset($record->brief) ? $record->brief : ''; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">购买链接：</span>
			<input name="buy_url" style="width:540px!important;" value="<?php echo isset($record->buy_url) ? $record->buy_url : ''; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">分类：</span>
			<input name="category" value="<?php echo isset($record->category) ? $record->category : ''; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">产品描述：</span>
			<textarea name="description"><?php echo isset($record->description) ? $record->description : ''; ?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<span class="label">&nbsp;</span>
			<input type="submit" class="btn" value="确认提交" style="height:25px;line-height:25px;width:80px;" />
			<a href="<?php echo site_url('admin');?>"><span class="icon return">返回文章维护</span></a>
		</td>
	</tr>
</table>
</form>