<?php
	global $xoopsUser, $xoopsConfig, $xoopsModuleConfig;

include_once "header.php";
include_once XOOPS_ROOT_PATH . "/modules/webindex/class/class.webindex.php";
$xoopsOption['template_main'] = 'webindex_index.html';
	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname('webindex');

include_once XOOPS_ROOT_PATH."/header.php";

$group = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);

$index = new webindex();
$indexarray= $index->getAllIndexs();
$count=count($indexarray);
$cpt=0;

if($count > 0)
{
	foreach($indexarray as $index)
	{
		$groups = explode(" ",$index->groups());
		if($index->visible()==1 && count(array_intersect($group,$groups)) > 0)
		{
			$cpt++;
			$tblindex=Array();
			$tblindex['id']=$index->indexid();
			$tblindex['pid']=$index->pid();
			$tblindex['created']=$index->created();
			$tblindex['modified']=$index->modified();
			$tblindex['weight']=$index->weight();

			if ( $index->url()) {
			$tblindex['title']= "<a href='".$index->url()."'>".$index->title()."</a>";
			}else {
			$tblindex['title']= $index->title();
			}
			$tblindex['zone01']=$index->zone01("Show");
			$tblindex['zone02']=$index->zone02("Show");
			$tblindex['zone03']=$index->zone03("Show");
			$tblindex['zone04']=$index->zone04("Show");
			$tblindex['zone05']=$index->zone05("Show");
			$tblindex['zone06']=$index->zone06("Show");
			$tblindex['zone07']=$index->zone07("Show");
			$tblindex['zone08']=$index->zone08("Show");
			$tblindex['zone09']=$index->zone09("Show");
			$tblindex['zone10']=$index->zone10("Show");
			$tblindex['hits']=$index->hits();
			$xoopsTpl->append('indexes', $tblindex);
			unset($tblindex);
		}
	}
}

// Create all the names, module's name and columns names
$infos['title'] = 	$module->getVar('name');
$infos['zone01'] = 	$xoopsModuleConfig['columnname01'];
$infos['zone02'] = 	$xoopsModuleConfig['columnname02'];
$infos['zone03'] = 	$xoopsModuleConfig['columnname03'];
$infos['zone04'] = 	$xoopsModuleConfig['columnname04'];
$infos['zone05'] = 	$xoopsModuleConfig['columnname05'];
$infos['zone06'] = 	$xoopsModuleConfig['columnname06'];
$infos['zone07'] = 	$xoopsModuleConfig['columnname07'];
$infos['zone08'] = 	$xoopsModuleConfig['columnname08'];
$infos['zone09'] = 	$xoopsModuleConfig['columnname09'];
$infos['zone10'] = 	$xoopsModuleConfig['columnname10'];

// Titles for the admin links and icons
$infos['admin']  = _MI_WEBINDEX_ADMIN;
$infos['edit']   = _MI_WEBINDEX_EDIT;
$infos['insert'] = _MI_WEBINDEX_INSERT;
$infos['delete'] = _MI_WEBINDEX_DELETE;

// Columns visiblity
$infos['zone01visibility'] = $xoopsModuleConfig['columnvisibility01'];
$infos['zone02visibility'] = $xoopsModuleConfig['columnvisibility02'];
$infos['zone03visibility'] = $xoopsModuleConfig['columnvisibility03'];
$infos['zone04visibility'] = $xoopsModuleConfig['columnvisibility04'];
$infos['zone05visibility'] = $xoopsModuleConfig['columnvisibility05'];
$infos['zone06visibility'] = $xoopsModuleConfig['columnvisibility06'];
$infos['zone07visibility'] = $xoopsModuleConfig['columnvisibility07'];
$infos['zone08visibility'] = $xoopsModuleConfig['columnvisibility08'];
$infos['zone09visibility'] = $xoopsModuleConfig['columnvisibility09'];
$infos['zone10visibility'] = $xoopsModuleConfig['columnvisibility10'];

$col=0;
if($xoopsModuleConfig['columnvisibility01']==1) { $col++; }
if($xoopsModuleConfig['columnvisibility02']==1) { $col++; }
if($xoopsModuleConfig['columnvisibility03']==1) { $col++; }
if($xoopsModuleConfig['columnvisibility04']==1) { $col++; }
if($xoopsModuleConfig['columnvisibility05']==1) { $col++; }
if($xoopsModuleConfig['columnvisibility06']==1) { $col++; }
if($xoopsModuleConfig['columnvisibility07']==1) { $col++; }
if($xoopsModuleConfig['columnvisibility08']==1) { $col++; }
if($xoopsModuleConfig['columnvisibility09']==1) { $col++; }
if($xoopsModuleConfig['columnvisibility10']==1) { $col++; }

$module_handler =& xoops_gethandler('module');
$module =& $module_handler->getByDirname('webindex');

if (is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid()) && $xoopsModuleConfig['admin_show'] == 1) {
	$infos['col_admin'] = $col+1;
	$infos['col'] = $col+1;
	$infos['adminlink'] = 1;
}else{
	$infos['col_admin'] = $col+1;
	$infos['col'] = $col+1;
	$infos['adminlink'] = 0;
}

$xoopsTpl->assign('module_name', $module->getVar('name'));
$xoopsTpl->assign('infos', $infos);
$xoopsTpl->assign('indexes_count', $cpt);
include_once XOOPS_ROOT_PATH.'/footer.php';
?>