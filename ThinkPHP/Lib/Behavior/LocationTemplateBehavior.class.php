<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: LocationTemplateBehavior.class.php 2702 2012-02-02 12:35:01Z liu21st $

/**
 +------------------------------------------------------------------------------
 * 系统行为扩展 自动定位模板文件
 +------------------------------------------------------------------------------
 */
class LocationTemplateBehavior extends Behavior {
    // 行为扩展的执行入口必须是run
    public function run(&$templateFile){
        // 自动定位模板文件
        if(!file_exists_case($templateFile))
            $templateFile   = $this->parseTemplateFile($templateFile);
    }

    /**
     +----------------------------------------------------------
     * 自动定位模板文件
     +----------------------------------------------------------
     * @access private
     +----------------------------------------------------------
     * @param string $templateFile 文件名
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    private function parseTemplateFile($templateFile) {
        if(''==$templateFile) {
            // 如果模板文件名为空 按照默认规则定位
			$templateFile = C('TEMPLATE_NAME');
			if(!file_exists_case($templateFile)){
				$depr = defined('GROUP_NAME')?GROUP_NAME:'';
				$action_name=ACTION_NAME;
				if(strpos($action_name,':')!==false)
				{
					$action_name=substr($action_name,0,strpos($action_name,':'));
				}
				$coreTemplateFile=TMPL_PATH.$depr.'/core/'.MODULE_NAME.'/'.$action_name.C('TMPL_TEMPLATE_SUFFIX');
				if(!file_exists_case($coreTemplateFile)){
					
					throw_exception(L('_TEMPLATE_NOT_EXIST_').'['.C('TEMPLATE_NAME').']');
				}else{
					$templateFile = $coreTemplateFile;
				}
			}
        }elseif(false === strpos($templateFile,C('TMPL_TEMPLATE_SUFFIX'))){
            // 解析规则为 模板主题:模块:操作 不支持 跨项目和跨分组调用
            $path   =  explode(':',$templateFile);
			
            $action = array_pop($path);
            $module = !empty($path)?array_pop($path):MODULE_NAME;
            if(!empty($path)) {// 设置模板主题
                $path = dirname(THEME_PATH).'/'.array_pop($path).'/';
            }else{
                $path = THEME_PATH;
            }
			
            $depr = defined('GROUP_NAME')?C('TMPL_FILE_DEPR'):'/';
            $templateFile  =  $path.$module.$depr.$action.C('TMPL_TEMPLATE_SUFFIX');
			if(!file_exists_case($templateFile)){
				$corePath = TMPL_PATH.(defined('GROUP_NAME')?GROUP_NAME:'').'/core/';
				$coreTemplateFile  =  $corePath.$module.$depr.$action.C('TMPL_TEMPLATE_SUFFIX');
				if(file_exists_case($coreTemplateFile)){
					$templateFile = $coreTemplateFile;
				}else{
					throw_exception(L('_TEMPLATE_NOT_EXIST_').'['.$templateFile.']');
				}
			}
        }
        return $templateFile;
    }
}
?>