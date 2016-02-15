<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="__PUBLIC__/favicon.ico" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CONFIG('SYSTEM_TITLE');?></title>
<link rel="stylesheet" type="text/css" href="__TMPL__Public/css/style.css" />
<link href="__TMPL__Public/css/css.css" rel="stylesheet" type="text/css">
<script  src="__PUBLIC__/jquery-1.x.min.js"></script>
<script src="__PUBLIC__/directSell/area_select.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/xstable.js" type="text/javascript"></script>
<script src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script src="__PUBLIC__/js/transfer.js" type="text/javascript"></script>
<script type="text/javascript"> 
	$(document).ready(function(){
	//判断当前方法是哪一个 对其进行显
	var data = '<?php echo ($menu_jsons); ?>';
	var action = '<?php echo ($now_action); ?>';
	var model = '<?php echo ($now_model); ?>';
	var title='';
	data_arr = {};
	 data_arr = eval('('+data+')');
       for(var key in data_arr){//key 为资料管理 data_arr[key] 为一维数组 key 为一级菜单的标题
           for(var key1 in data_arr[key]){//key1 为一维数组的元素 data_arr[key][key1]['model']为模型 data_arr[key][key1]['Action']为方法 data_arr[key][key1]['title']为二级菜单标题  
             if(data_arr[key][key1]['model']==model && data_arr[key][key1]['action']==action){
               //替换属性的值
               $("#"+key).next().css('display','block').siblings(".menuContent").hide();
               //判断Action是否相等
               if(data_arr[key][key1]['action']==action){

                  $("#"+key).attr("class","menuTitle_active");                    	
						$("#"+data_arr[key][key1]['title']).addClass("curr");
                     	title = data_arr[key][key1]['title'];
               }
             }
             
           }
       
       }
   //判断事件     
          
		$("#ulstyle li").mousemove(function(){
		  if(title){
			 var title_now = $(this).attr("id");
			 if(title!=title_now){				
				$(this).addClass("curr");				
				$("#"+title).removeClass("curr");					
			 }
		  }
		});
		$("#ulstyle li").mouseleave(function(){
		  if(title){
			 var title_now = $(this).attr("id");
			 if(title!=title_now){				
				$(this).removeClass("curr");				
				$("#"+title).addClass("curr");					
			 }
		  }
		});
    });
    
 	$(function(){
		$(".menuTitle,.menuTitle_active").click(function(){
		   if($(this).next().css('display')=='none'){
			 $(this).next().css('display','block').siblings(".menuContent").hide();
		   }else{
			   $(this).next().css('display','none');
		   }
		});
		$("#ulstyle li").mousemove(function(){		  			
				$(this).addClass("curr");				
		});
		$("#ulstyle li").mouseleave(function(){		  			
			$(this).removeClass("curr");				
		});

        var bdh = $('body').height();
        var crh = $('.centre_right').height();
        if (bdh > crh) {
            $('.container').height(bdh - 83);
        } else {
            $('.container').height(crh + 50);
        }
	});	
</script>
</head> 
<!--onkeydown="if(event.keyCode==116){location.href='__GROUP__/Index/index';return false;}"-->
<body  id="blanc_blue"><!---->
<!--头部-->
<div class="header">
 <div class="left" style="padding-top: 15px;text-indent: 10px;">
    <span style="font-size:20px;padding-top:50px;color:white"><?php echo CONFIG('SYSTEM_COMPANY');?><span style="font-size:11px;display:block;padding-top:5px;"><?php echo CONFIG('SYSTEM_MEMO');?></span></span> 
 </div>
 <div class="right">
   <div class="right_1">
     <div id="user-nav" class="navbar">
       <ul class="nav1">
         <li><a title="" href="__GROUP__/Index/index"><div class="icon-user"></div><span class="text">欢迎回来！</span></a></li>
         <li><a title="" href="__GROUP__/User/viewnotice"><div class="icon-messages"></div><span class="text">系统信息</span></a></li>
         <!-- <li><a title="" href=""><div class="icon-cog"></div><span class="text">系统设置</span></a></li> -->
         <li><a title="" href="__GROUP__/Public/logout"><div class="icon-share-alt"></div> <span class="text">安全退出</span></a></li>                        
         <li style="float:right; border:none; padding-top:5px;">        
         <form class="top_form" >
           <input type="text" value="" class="input_left"/>
           
           <input type="button" value="" class="input_search"/>
         </form>
           
         </li>         
       </ul>
     </div>
   </div>
   <div class="right_2">
     <div id="breadcrumb"><span class="icon-home"></span><a href="__GROUP__/Index/index"><span class="icon-align-justify"></span><?php echo L('home_page');?></a></div>
   </div>
 </div>
 <div class="clearfix"></div>
</div>
<!--头部结束-->

<div class="centre">
 <!--左侧菜单栏-->
 <div class="centre_left">
     <div class="container">
		<div  <?php if($now_model == 'Index'): ?>class="menuTitle_active"<?php else: ?>class="menuTitle"<?php endif; ?> > <a href="__GROUP__/Index/index"><span class="dh-home"></span>首页</a></div>
	
		<?php if(is_array($menu)): foreach($menu as $key=>$vo): ?><div  id="<?php echo ($key); ?>" class="menuTitle" ><span class="dh-signal" oldClass=""></span><?php echo ($key); ?><span class="dh_sec"><?php echo (count($vo)); ?></span></div>
			<div class="menuContent">
			<ul id="ulstyle">
			<?php if(is_array($vo)): foreach($vo as $key=>$val): if(!$userMenuPower or in_array($val['model'].'-'.$val['action'],$userMenuPower)): ?><li id="<?php echo ($val["title"]); ?>"><a href="__GROUP__/<?php echo ($val["model"]); ?>/<?php echo ($val["action"]); ?>"><?php echo ($val["title"]); ?></a></li><?php endif; endforeach; endif; ?>
			</ul>
			</div><?php endforeach; endif; ?>
     </div>
 </div>
 <!--左侧菜单栏结束-->

 





<link href="__TMPL__Public/style/res.css" rel="stylesheet" type="text/css" />
<link href="__TMPL__Public/style/view.css" rel="stylesheet" type="text/css" />
<div class="centre_right">
    <script type="text/javascript" src="__PUBLIC__/directSell/area_select.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/fnc.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/moneyout.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/inputFormat.js"></script>
<div class="core_main Fun_bank" id="get">
<input id="xpath" type="hidden" value="__XPATH__"/>
     <div class="core_title">
    	<span class="core_title_con"><span>当前位置</span>：<?php echo ($nowtitle); ?></span>
    </div>
    <div class="core_title">
	  	<span class="core_title_con">选择一个提款地址</span><span style="float:right;color:#f60;">（修改时请填写已有地址标签）</span>
	</div>
    <div class="core_con">
	    <table class="tablebg">
		<thead>
			<tr align="center">
				<th>选择</th>
				<th>地址标签</th>
				<th>提款地址</th>
				<th>操作</th>
			</tr>
		</thead>
        <form action="/user_exchange/rmbout" method="post" id="rmbout_con"></form>
		<tbody>
			<?php if(is_array($mycards)): foreach($mycards as $tkey=>$mycard): ?><tr align="center">
				<td><input type="radio" class="getbanktype" value="<?php echo ($mycard['id']); ?>" <?php if($mycard['状态'] == 1): ?>checked<?php endif; ?>/></td>
				<td><?php echo ($mycard['标签']); ?></td>
				<td><?php echo ($mycard['银行']); ?>&nbsp;|&nbsp;<?php echo ($mycard['银行卡号']); ?>&nbsp;|&nbsp;<?php echo ($mycard['开户名']); ?>&nbsp;|&nbsp;<?php echo ($mycard['省份']); ?>&nbsp;|&nbsp;<?php echo ($mycard['城市']); ?>&nbsp;|&nbsp;<?php echo ($mycard['区县']); ?></td>
				<td><a href="javascript:;" onclick="cnyOut.delAddr(<?php echo ($mycard['id']); ?>)">删除</a>&nbsp;&nbsp;&nbsp;<?php if(($mycard['状态']) == "1"): ?><span style='color:#f60;'>默认</span><?php else: ?><a href="javascript:;" onclick="cnyOut.setAddr(<?php echo ($mycard['id']); ?>)">默认</a><?php endif; ?></td>
			</tr><?php endforeach; endif; ?>
			<style>
				.bankcon li{
				    height: 34px;
				    line-height: 34px;
				    text-align: left;
				}
				.bankcon li label{
					width: 30%;
					padding-left: 40px;
    				color: #666;
    				float: left;
    				text-align: right;
				}
			</style>
            <tr>
				<td colspan="4" id="newAddress" style="display:none;">
                <div id="rmb_out_ok">
				<ul class="bankcon" id="rollout" style="margin-top:10px;">
					<li>
						<label>新标签：</label><input type="text" id="new_label">
						<span id="labelmsg" style="color:red;"></span>
					</li>
					<li>
						<label>银行名称：</label>
						<select name="bank" id="bank" class="loginValue">
						<option value="">请选择银行</option>
						<?php if(is_array($bankcards)): foreach($bankcards as $key=>$bankcard): ?><option value="<?php echo ($bankcard["开户行"]); ?>"><?php echo ($bankcard["开户行"]); ?></option><?php endforeach; endif; ?>
					    </select>
					    <span style="color:red;" id="bankmsg"></span>
					</li>
					<li>
					    <label>银行卡所在地：</label>
	                	<select name="country" id="country_id" data-role="none" style="display:none;">
	                    <option value="">请选择</option>
	                	</select>
	                	<select name="province"  id="province_id" data-role="none" style="">
	                    <option value="">省份</option>
	                	</select>
	                    <select name="city" id="city_id" data-role="none">
	                    <option value="">城市</option>
	                	</select>
	                	<select name="county" id="county_id" data-role="none">
	                    <option value="">区/县</option>
	                	</select>
	                	<span id="addressmsg" style="color:red;"></span>
					</li>
					<li>
					    <label>银行卡号：</label>
					    <input type="text" onkeyup="value=value.replace(/[^\d]/g,'')" name="account" id="account" value="" class="loginValue" style="font-size:14px;font-weight:bold;color:#f60;background:#fff7f2;">
					    <span class="false" id="accountmsg" style="color:red;"></span>
					</li>
					<li>
					    <label>开户姓名：</label>
					    <input type="text" name="name" id="name" value="<?php echo ($userinfo['姓名']); ?>" class="loginValue" <?php if(!empty($userinfo['姓名'])): ?>disabled=""<?php endif; ?>>
					    <span class="false" id="accountmsg" style="color:red;"></span>
					</li>
					<li id="yes_add">
					    <label>&nbsp;</label>
					    <input type="button" class="addition" id="addNew" onclick="$(this).attr('disabled','disabled');cnyOut.submitNewAddr()" value="确认添加">
					    <input type="button" class="addition" onclick="$('#newAddress').hide();$('#addAddress_tr').show();" value="取消">
					    <span id="showMsg_address" style="color:red;">最多添加10条提款地址</span>
					</li>
				</ul>
                </div>
				</td>
			</tr>
			<script>
		    $('#account').inputFormat('account');
			</script>
			<script type="text/javascript">
			$.area_default_show=true;
			$.area_default_country="中国";
			$.area_default_province="<?php echo ($userinfo['省份']); ?>";
			$.area_default_city="<?php echo ($userinfo['城市']); ?>";
			$.area_select_bind( 'country_id' , 'province_id' , 'city_id' , 'county_id', 'town_id' );
			</script>
			<tr align="center" id="addAddress_tr">
				<td colspan="4"><a href="javascript:cnyOut.addNewAddr();" id="addNewAddress">点击添加一个新的提款地址</a></td>
			</tr>
		</tbody>
	    </table>
	  </div>
	    <div class="core_title">
	    	<span class="core_title_con" style="width:60%;float:left;">可提现余额：<span id="out_over"><?php echo $funbank[$bank->byname]['num'];?></span></span>
	    	<span style="float:right;font-size:12px;margin-right:20px;color:red;float:right;"><strong id="rmbout_showtips">&nbsp;</strong></span>
	    </div>
	 <div class="core_con">
		<table class="tablebg">
			<TR class="datalist">
				<TD class="tbkey">提现金额：</TD>
				<TD class="tbval">
					<span><input type="text" class="sum" name="getsum" id="getsum" onkeyup="cnyOut.daozhang()" autocomplete="off"></span>
					<span style="color:#f60;">
					<?php if($bank->getMoneyMin > 0): ?>最小提款额 <span id="out_min"><?php echo ($bank->getMoneyMin); ?></span><?php endif; ?>
					<?php if($bank->getMoneyMax > 0): ?>最大提款额 <span id="out_max"><?php echo ($bank->getMoneyMax); ?></span><?php endif; ?>
					</span>
				</TD>
			</TR>
			<TR class="datalist">
				<TD class="tbkey">实际到帐：</TD>
				<TD class="tbval"><input type="text" class="sum" id="true_daozhang" disabled=""> 
					<span style="color:#f60;">(手续费 <?php if(($bank->getTaxFrom) == "0"): ?>【额外】<?php endif; ?><span id="outfee"><?php echo ($bank->getMoneyTax); ?></span> %) 
					<?php if(($bank->getMoneyTaxMin) > "0"): ?>手续费最小 <span id="outfeemin"><?php echo $bank->getMoneyTaxMin;?></span><?php endif; ?>
					<?php if(($bank->getMoneyTaxMax) > "0"): ?>手续费最大 <span id="outfeemax"><?php echo $bank->getMoneyTaxMax;?></span><?php endif; ?>
					<?php if(($bank->getMoneyRatio) != "1"): ?>汇率换算 ：1:<span id="outRatio"><?php echo $bank->getMoneyRatio;?></span><?php endif; ?>
					</span>
				</TD>
			</TR>
			<?php if(($bank->getMoneyPass2 == true)): ?><TR class="datalist">
				<TD class="tbkey">二级密码：</TD>
				<TD class="tbval"><span><input type="password" value="" name="pass2" id="pass2" autocomplete="off"/></span></TD>
			</TR><?php endif; ?>
			<?php if(($bank->getMoneyPass3 == true)): ?><TR class="datalist">
				<TD class="tbkey">三级密码：</TD>
				<TD class="tbval"><span><input type="password" value="" name="pass3" id="pass3" autocomplete="off"/></span></TD>
			</TR><?php endif; ?>
			<?php if(($bank->getMoneySmsSwitch == true)): ?><tr class="datalist">
				<TD class="tbkey">短信验证码：</td>
				<TD class="tbval"><input name="getSmsVerfy" type="text" id="getSmsVerfy" ><input style="margin-left:10px" type="button" id="sendMess" value="点击获取" /></td>
			</tr><?php endif; ?>
			<?php if((($reg_safe == true) and ($bank->getSecretSafe == true))): ?><tr>
				<td class="tbkey"><?php echo L('密保问题');?>：</td>
				<td class="tbval"><?php echo L($userinfo['密保问题']);?>
			</td>
			</tr>
			<tr>
				<td class="tbkey"><?php echo L('密保答案');?>：</td>
				<td class="tbval"><input type="text" value="" name="getsafeanswer" id="getsafeanswer" />
			</td>
			</tr><?php endif; ?>
			<?php if(isset($onlyLock) && $onlyLock): ?><td colspan="3" style="text-align:center;padding-right:70px;"><span style="color:#f60;">您有一笔未审核的提现记录，暂不能继续提现</span></td>
			<?php else: ?>
			<TR>
				<td colspan="3" style="text-align:center;padding-right:70px;"><input type="button" id="tijiao" class="confirm" onclick="$(this).attr('disabled','disabled');cnyOut.rmbconfirm();" value="确认提交" style="width:80px;"></td>
			</TR><?php endif; ?>
			<input type="hidden" id="outfrom" value="<?php echo $bank->getTaxFrom;?>"/>
		</tr>
		</table>
		{__TOKEN__}
     </div>
    <div class="core_title">
    	<span class="core_title_con"><?php echo ($name); ?>列表</span>
        <?php if(isset($data['edit'])): ?><span class="core_title_edit"><a href="#" onclick="ShowDialog('<?php echo ($data["edit"]); ?>',330);return false;">编辑</a></span><?php endif; ?>        
    </div>
    <div class="core_con">
        <table class="tablebg">
        <TR class="datafield">
            <?php if(is_array($data["field"])): foreach($data["field"] as $key=>$name): ?><TH ><?php echo ($name); ?></TH><?php endforeach; endif; ?>
        </TR>
        <?php if(is_array($data["list"])): foreach($data["list"] as $key=>$name): ?><TR class="datalist">
            <?php if(is_array($name)): foreach($name as $name1=>$value): ?><TD><nobr><?php echo ($name["$name1"]); ?></nobr></TD><?php endforeach; endif; ?>
        </TR><?php endforeach; endif; ?>
        </table>
    </div>
    <div class="core_page">
        <span>共<?php echo ($data["count"]); ?>条记录 <?php echo ($data["nowPage"]); ?>/<?php echo ($data["totalPages"]); ?>页 &nbsp;</span>
        <?php if($data['nowPage'] != 1): ?><a href="<?php echo ($data["firstRow"]); ?>">首页</a>&nbsp;&nbsp;
        <?php else: ?><span>首页&nbsp;&nbsp;</span><?php endif; ?>
        <a href="<?php echo ($data["upRow"]); ?>">上一页</a>&nbsp;&nbsp;
        <?php if(isset($data['rollPage'][-2])): ?><a href="<?php echo ($data["rollPage"]["-2"]); ?>"><?php echo ($data['nowPage']-2); ?></a>&nbsp;&nbsp;<?php endif; ?>
        <?php if(isset($data['rollPage'][-1])): ?><a href="<?php echo ($data["rollPage"]["-1"]); ?>"><?php echo ($data['nowPage']-1); ?></a>&nbsp;&nbsp;<?php endif; ?>
        <?php echo ($data["nowPage"]); ?>&nbsp;&nbsp;
        <?php if(isset($data['rollPage'][1])): ?><a href="<?php echo ($data["rollPage"]["1"]); ?>"><?php echo ($data['nowPage']+1); ?></a>&nbsp;&nbsp;<?php endif; ?>
        <?php if(isset($data['rollPage'][2])): ?><a href="<?php echo ($data["rollPage"]["2"]); ?>"><?php echo ($data['nowPage']+2); ?></a>&nbsp;&nbsp;<?php endif; ?>
        <a href="<?php echo ($data["downRow"]); ?>">下一页</a>&nbsp;&nbsp;
        <?php if($data['nowPage'] < $data['totalPages']): ?><a href="<?php echo ($data["theEndRow"]); ?>">尾页</a>
        <?php else: ?><span>尾页</span><?php endif; ?>
    </div> 
</div>
<script>
var wait=300;
var sta = true;
function time(o) {
    if(sta == true){
        var type = '<?php echo ($bank->name); ?>提现';
        var content = '<?php echo ($bank->getMoneySmsContent); ?>';
        $.post('__URL__/sendSmsVerify',{type:type,content:content},function(data){
			eval('var data='+data);
			if(data.status == 1){
				alert('发送成功!');
			}else{
				alert('发送失败!');
			}
        });
        sta = false;
    }
    if (wait == 0) {
		o.removeAttribute("disabled");      
		o.value="点击获取";
		wait = 300;
		sta = true;
    } else {
		o.setAttribute("disabled", true);
		o.value="重新发送(" + wait + ")";
		wait--;
		setTimeout(function() {
			time(o)
		},
		1000)
    }
}
document.getElementById("sendMess").onclick=function(){time(this);}
</script>

    <div class="clearfix"></div>
</div>
<!--中间结束-->
</div>
</body>
</html>