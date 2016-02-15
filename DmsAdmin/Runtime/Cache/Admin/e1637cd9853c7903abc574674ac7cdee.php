<?php if (!defined('THINK_PATH')) exit();?><script language="JavaScript">function dialogAjaxDoneProductAdd(json)
{
	DWZ.ajaxDone(json);
	navTab.reload();          //刷新列表
	if(!json.data.next)
	{
		if (json.statusCode == DWZ.statusCode.ok)
		{
			$.pdialog.closeCurrent(); //关闭添加话框
		}
	}
	
}
</script><div class="pageContent"><form action="__URL__/addSave" method="post" class="pageForm required-validate" onsubmit="return iframeCallback(this,dialogAjaxDoneProductAdd)"><input type="hidden" name="callbackType" value="closeCurrent"/><div class="pageFormContent" layoutH="58"><table cellpadding="3" cellspacing="3" ><tr><td style="text-align:right;width:150px">标题：</td><td style="text-align:left" ><input type="text" class="required"  name="title" value=""/></td></tr><tr><td style="text-align:right;width:80px">转出货币：</td><td style="text-align:left" ><select name="outbank"  class="required"  id="outbank" onchange="xfje(this.options[this.options.selectedIndex].value)"><?php if(is_array($banknames)): foreach($banknames as $bankname=>$bankbyname): ?><option value="<?php echo ($bankname); ?>"><?php echo ($bankbyname); ?></option><?php endforeach; endif; ?></select></td></tr><tr><td style="text-align:right;width:80px">转入货币：</td><td style="text-align:left" ><select name="tobank"  class="required"  id="tobank" onchange="xfje(this.options[this.options.selectedIndex].value)"><?php if(is_array($banknames)): foreach($banknames as $bankname=>$bankbyname): ?><option value="<?php echo ($bankname); ?>"><?php echo ($bankbyname); ?></option><?php endforeach; endif; ?></select></td></tr><tr><td style="text-align:right;width:80px">转账类型：</td><td style="text-align:left"><input id='toyou' type='checkbox' name='toyou' value='true' checked='checked' onclick="changeto(this)">转给其他人
        					<input id='tome' type='checkbox' name='tome' value='true' disabled>转给自己
                </td></tr><tr id="transtype"><td style="text-align:right;width:80px">转给他人选择：</td><td><input type="checkbox" name="toyoutype[]" value="0-0">会员转给会员
                  <input type="checkbox" name="toyoutype[]" value="0-1">会员转给店铺<br/><input type="checkbox" name="toyoutype[]" value="1-1">店铺转给店铺
                  <input type="checkbox" name="toyoutype[]" value="1-0">店铺转给会员
                </td></tr><tr><td style="text-align:right;width:80px">手续费来源：</td><td style="text-align:left" ><input name="taxfrom" value="0" type="radio" checked/>额外货币
            		<input name="taxfrom" value="1" type="radio" />转出金额
            	</td></tr><tr><td style="text-align:right;width:80px">转账手续费：</td><td style="text-align:left" ><input class="required number" size='5' type='text' name='tax' value='0'/>%
                </td></tr><tr><td style="text-align:right;width:80px">转账手续费上限：</td><td style="text-align:left" ><input class="required number" type='text' name='taxtop' value='0'/></td></tr><tr><td style="text-align:right;width:80px">转账手续费下限：</td><td style="text-align:left" ><input class="required number" type='text' name='taxlow' value='0'/></td></tr><tr><td style="text-align:right;width:80px">转换比率：</td><td style="text-align:left" ><input class="required number" size='5' type='text' name='sacl' value='100'/>%
                </td></tr><tr><td style="text-align:right;width:80px">转账允许最大金额：</td><td style="text-align:left" ><input class="required number" type='text' name='max' value='0'/></td></tr><tr><td style="text-align:right;width:80px">转账允许最小金额：</td><td style="text-align:left" ><input class="required number" type='text' name='min' value='0'/></td></tr><tr><td style="text-align:right;width:80px">网络体系限定：</td><td style="text-align:left" ><select name="nets" id="nets" ><option value="无">无</option><?php if(is_array($netsets)): foreach($netsets as $netset=>$netsets): ?><option value="<?php echo ($netset); ?>"><?php echo ($netsets); ?></option><?php endforeach; endif; ?></select></td></tr><tr><td style="text-align:right;width:80px">转账整数额：</td><td style="text-align:left" ><input class="required digits" type='text' name='intnum' value='0'/></td></tr><tr><td style="text-align:right;width:80px">服务中心限定：</td><td style="text-align:left" ><select name="shop" id="shop" ><option value="无">无</option><option value="仅限服务中心">仅限服务中心</option></select></td></tr><tr><td style="text-align:right;width:80px">状态：</td><td style="text-align:left"><input type="radio" value="1"  name="status" checked/>开启
					<input type="radio" value="0" name="status"/>关闭
            	</td></tr></table></div><div class="formBar"><ul><li><div class="buttonActive"><div class="buttonContent"><button id="submit" type="submit" >确认</button></div></div></li><li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li></ul></div></form></div><script>
	function xfje(s)
	{
		var outbank = $("#outbank").val();
		var tobank = $('#tobank').val();
		if(outbank == tobank)
		{
			$('#tome').attr("disabled",true);
		}else{
			$('#tome').removeAttr("disabled");
		}
	}
  function changeto(e){
    var val=$(e).attr("checked");
    if(val=='checked'){
      $("#transtype").show();
    }else{
      $("#transtype").hide();
    }
  }
</script>