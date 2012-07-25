<?php
function webindex_getmoduleoption($option)
{
	global $xoopsModuleConfig;
	static $tbloptions= Array();
	if(is_array($tbloptions) && array_key_exists($option,$tbloptions)) {
		return $tbloptions[$option];
	}

	$retval=false;
	if(!isset($xoopsModuleConfig)) {
		$module_handler =& xoops_gethandler('module');
		$module =& $module_handler->getByDirname("webindex");
		$config_handler =& xoops_gethandler('config');
		if ($module) {
		    $moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
	    	if(isset($moduleConfig[$option])) {
	    		$retval= $moduleConfig[$option];
	    	}
		}
	} else {
		if(isset($xoopsModuleConfig[$option])) {
			$retval= $xoopsModuleConfig[$option];
		}
	}
	$tbloptions[$option]=$retval;
	return $retval;
}

?>