<?php if (!defined('THINK_PATH')) exit();?>﻿<!--<style type="text/css">
	.pageHeader{
		display:none;
	}
</style>
<div class="pageContent">
	  	<table class="list">
			<tr>
			<td align='center' width="50px">会员ID:</td>	<td  width="20px"><?php echo ($id); ?></td>
			<td  width="100px">注册时间:</td>	<td  width="50px"><?php echo ($user_zcrq); ?></td>
			<td  width="100px">审查时间:</td>	<td  width="50px"><?php echo ($user_shrq); ?></td>
			<td  width="100px">最后登录IP:</td>	<td  width="50px"><?php echo ($user_zhip); ?></td>
			<td  width="70px">登录次数:</td><td  width="20px"><?php echo ($user_dlcs); ?></td>
			</tr>
		</table>
		<hr />
		
		<table class="list">	
		<tr>
			<td align='center' width="280px">操作时间</td>
			<td align='center' width="240px">操作内容</td>
			<td align='center' width="160px">登录IP</td>
			<td align='center' width="280px">登录地址</td>
			</tr>
			<?php if(is_array($showData)): foreach($showData as $key=>$keys): ?><tr>
					<td align='center' ><?php echo (date("Y-m-d H:i:s",$keys['create_time'])); ?></td>
					<td align='center' ><?php echo ($keys['content']); ?></td>
					<td align='center' ><?php echo ($keys['ip']); ?></td>
					<td align='center' ><?php echo ($keys['address']); ?></td>
				</tr><?php endforeach; endif; ?>
		</table>
		<div class="result page" align="right" ><?php echo ($page); ?></div>
</div>--><?php echo ($list); ?>