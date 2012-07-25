<?php
function b_webindex_show($options)
{
	global $xoopsUser, $xoopsConfig;
	include_once XOOPS_ROOT_PATH . "/modules/webindex/class/class.webindex.php";
	include_once XOOPS_ROOT_PATH . "/modules/webindex/include/functions_block.php";

	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname('webindex');
	$pv=$cpt=0;
	$block = array();

	$group = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);
	$index = new webindex();
	//$indexarray = $index->getAllIndexs();
	$indexarray = $index->getAllCategory();
	$count = count($indexarray);
	if ($count > 0)
	{
// Zones visibility by day

	if ( $options[0] == 1 ){
        	setlocale (LC_TIME,$xoopsConfig['language']);
      	$jour_num =		date("w")+1 +$options[11] ;
		if ( $jour_num == 1 ) {$block['zone01visibility']= 1;}  else {$block['zone01visibility']= $options[1];}
		if ( $jour_num == 2 ) {$block['zone02visibility']= 1;}  else {$block['zone02visibility']= $options[2];}
		if ( $jour_num == 3 ) {$block['zone03visibility']= 1;}  else {$block['zone03visibility']= $options[3];}
		if ( $jour_num == 4 ) {$block['zone04visibility']= 1;}  else {$block['zone04visibility']= $options[4];}
		if ( $jour_num == 5 ) {$block['zone05visibility']= 1;}  else {$block['zone05visibility']= $options[5];}
		if ( $jour_num == 6 ) {$block['zone06visibility']= 1;}  else {$block['zone06visibility']= $options[6];}
		if ( $jour_num == 7 ) {$block['zone07visibility']= 1;}  else {$block['zone07visibility']= $options[7];}
		if ( $jour_num == 8 ) {$block['zone08visibility']= 1;}  else {$block['zone08visibility']= $options[8];}
		if ( $jour_num == 9 ) {$block['zone09visibility']= 1;}  else {$block['zone09visibility']= $options[9];}
		if ( $jour_num == 10 ) {$block['zone10visibility']= 1;} else {$block['zone10visibility']= $options[10];}

		} else {

		$block['zone01visibility'] = $options[1];
		$block['zone02visibility'] = $options[2];
		$block['zone03visibility'] = $options[3];
		$block['zone04visibility'] = $options[4];
		$block['zone05visibility'] = $options[5];
		$block['zone06visibility'] = $options[6];
		$block['zone07visibility'] = $options[7];
		$block['zone08visibility'] = $options[8];
		$block['zone09visibility'] = $options[9];
		$block['zone10visibility'] = $options[10];
		}

		// Zones names
		$block['title']= $module->getVar('name');
		$block['columname01']= webindex_getmoduleoption('columnname01');
		$block['columname02']= webindex_getmoduleoption('columnname02');
		$block['columname03']= webindex_getmoduleoption('columnname03');
		$block['columname04']= webindex_getmoduleoption('columnname04');
		$block['columname05']= webindex_getmoduleoption('columnname05');
		$block['columname06']= webindex_getmoduleoption('columnname06');
		$block['columname07']= webindex_getmoduleoption('columnname07');
		$block['columname08']= webindex_getmoduleoption('columnname08');
		$block['columname09']= webindex_getmoduleoption('columnname09');
		$block['columname10']= webindex_getmoduleoption('columnname10');



		foreach($indexarray as $index)
		{
			$groups = explode(" ",$index->groups());
			if($index->visible() == 1 && count(array_intersect($group,$groups)) > 0) {
				if($index->pid()!= 0) {
					if($pv != $index->pid()) {
						$cpt++;
						$pv=$index->pid();
					}
				} else {
					$cpt=0;
				}

				$whitespace=str_repeat('&nbsp;&nbsp;',$cpt);
				$tblindex=Array();

				$tblindex['id']=$index->indexid();
				$tblindex['pid']=$index->pid();
				$tblindex['created']=$index->created();
				$tblindex['modified']=$index->modified();
				$tblindex['weight']= $index->weight();
		if ( $index->url()) {$tblindex['title']="<a href='".$index->url()."'>".$whitespace.$index->title()."</a>";} 
		else {$tblindex['title']=$whitespace.$index->title();}
		if ( $index->zone01()) {$tblindex['zone01']=$index->zone01();} else {$tblindex['zone01']="-";}
		if ( $index->zone02()) {$tblindex['zone02']=$index->zone02();} else {$tblindex['zone02']="-";}
		if ( $index->zone03()) {$tblindex['zone03']=$index->zone03();} else {$tblindex['zone03']="-";}
		if ( $index->zone04()) {$tblindex['zone04']=$index->zone04();} else {$tblindex['zone04']="-";}
		if ( $index->zone05()) {$tblindex['zone05']=$index->zone05();} else {$tblindex['zone05']="-";}
		if ( $index->zone06()) {$tblindex['zone06']=$index->zone06();} else {$tblindex['zone06']="-";}
		if ( $index->zone07()) {$tblindex['zone07']=$index->zone07();} else {$tblindex['zone07']="-";}
		if ( $index->zone08()) {$tblindex['zone08']=$index->zone08();} else {$tblindex['zone08']="-";}
		if ( $index->zone09()) {$tblindex['zone09']=$index->zone09();} else {$tblindex['zone09']="-";}
		if ( $index->zone10()) {$tblindex['zone10']=$index->zone10();} else {$tblindex['zone10']="-";}


				$block['indexes'][] =& $tblindex;
				unset($tblindex);
			}
		}
	}
	return $block;
}


function b_webindex_edit($options) {
	include_once XOOPS_ROOT_PATH . "/modules/webindex/include/functions.php";

    $form .= "<p>"._MB_WEBINDEX_COLDAY."<input type='radio' name='options[0]' value='1'";
    if ( $options[0] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[0]' value='0'";
    if ( $options[0] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;


    $form .= "<p><b><u>"._MB_WEBINDEX_DISPLAY."</u> : "._MB_WEBINDEX_FORCE."</b><table width='300'><tr align='right'><td>".webindex_getmoduleoption('columnname01')."&nbsp;<input type='radio' name='options[1]' value='1'";
    if ( $options[1] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[1]' value='0'";
    if ( $options[1] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;



    $form .= "</td></tr><tr align='right'><td>".webindex_getmoduleoption('columnname02')."&nbsp;<input type='radio' name='options[2]' value='1'";
    if ( $options[2] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[2]' value='0'";
    if ( $options[2] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;



    $form .= "</td></tr><tr align='right'><td>".webindex_getmoduleoption('columnname03')."&nbsp;<input type='radio' name='options[3]' value='1'";
    if ( $options[3] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[3]' value='0'";
    if ( $options[3] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;






    $form .= "</td></tr><tr align='right'><td>".webindex_getmoduleoption('columnname04')."&nbsp;<input type='radio' name='options[4]' value='1'";
    if ( $options[4] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[4]' value='0'";
    if ( $options[4] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;

    




    $form .= "</td></tr><tr align='right'><td>".webindex_getmoduleoption('columnname05')."&nbsp;<input type='radio' name='options[5]' value='1'";
    if ( $options[5] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[5]' value='0'";
    if ( $options[5] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;

    




    $form .= "</td></tr><tr align='right'><td>".webindex_getmoduleoption('columnname06')."&nbsp;<input type='radio' name='options[6]' value='1'";
    if ( $options[6] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[6]' value='0'";
    if ( $options[6] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;

    





    $form .= "</td></tr><tr align='right'><td>".webindex_getmoduleoption('columnname07')."&nbsp;<input type='radio' name='options[7]' value='1'";
    if ( $options[7] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[7]' value='0'";
    if ( $options[7] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;

    




    $form .= "</td></tr><tr align='right'><td>".webindex_getmoduleoption('columnname08')."&nbsp;<input type='radio' name='options[8]' value='1'";
    if ( $options[8] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[8]' value='0'";
    if ( $options[8] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;

    




    $form .= "</td></tr><tr align='right'><td>".webindex_getmoduleoption('columnname09')."&nbsp;<input type='radio' name='options[9]' value='1'";
    if ( $options[9] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[9]' value='0'";
    if ( $options[9] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO;

    




    $form .= "</td></tr><tr align='right'><td>".webindex_getmoduleoption('columnname10')."&nbsp;<input type='radio' name='options[10]' value='1'";
    if ( $options[10] == 1 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._YES."&nbsp;<input type='radio' name='options[10]' value='0'";
    if ( $options[10] == 0 ) {
        $form .= " checked='checked'";
    }
    $form .= " />&nbsp;"._NO."</td></tr></table>";

	$form.= "" . _MB_WEBINDEX_EXCLUDE . " <input type='text' size='2' name='options[11]' value='" . $options[11] . "' /><br />";


    
	return $form;
}
