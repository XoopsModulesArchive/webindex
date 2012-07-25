<?php
include_once("../../../mainfile.php");
include_once(XOOPS_ROOT_PATH."/class/xoopsmodule.php");
include_once(XOOPS_ROOT_PATH."/include/cp_functions.php");
if ( is_object($xoopsUser) ) {
	$xoopsModule = XoopsModule::getByDirname("webindex");
	if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
		redirect_header($xoopsConfig['xoops_url']." / ",3,_NOPERM);
		exit();
	}
} else {
	redirect_header($xoopsConfig['xoops_url']." / ",3,_NOPERM);
	exit();
}
if ( file_exists("../language/".$xoopsConfig['language']."/admin.php") ) {
	include_once("../language/".$xoopsConfig['language']."/admin.php");
} else {
	include_once("../language/english/admin.php");
}
?>
