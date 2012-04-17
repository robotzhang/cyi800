<div>
	<a href="<?php echo site_url('admin/modify/'); ?>"><span class="add icon">添加产品</span></a>
</div>
<div class="space_15"></div>
<table class="table">
	<tr class="head">
		<td width="40">产品ID</td>
		<td width="120">产品标题</td>
		<td width="60">产品简介</td>
		<td width="30">购买链接</td>
		<td>创建时间</td>
		<td>更新时间</td>
		<td>操作</td>
	</tr>
	<?php foreach ($records as $key=>$record): ?>
	<tr <?php echo $key % 2 == 0 ? 'class="odd"' : ''; ?>>
		<td><?php echo $record->id;?></td>
		<td><?php echo $record->name;?></td>
		<td><?php echo $record->brief;?></td>
		<td><?php echo $record->buy_url;?></td>
		<td><?php echo $record->created;?></td>
		<td><?php echo $record->updated;?></td>
		<td>
			<a class="btn_icon edit" href="<?php echo site_url('admin/modify/'.$record->id); ?>" title="编辑">&nbsp;</a> 
			<span class="icon hline">&nbsp;</span>
			<a class="btn_icon delete" href="<?php echo site_url('admin/delete/'.$record->id); ?>" title="删除">&nbsp;</a> 
		</td>
	</tr>
	<?php endforeach;?>
</table>
<div><?php echo $pagination;?></div>