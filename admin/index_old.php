<?php
include_once '../../../include/cp_header.php';
include_once XOOPS_ROOT_PATH . "/modules/webindex/class/class.webindex.php";
include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
$module_id = $xoopsModule->getVar('mid');

$op = 'default';
if (isset($_POST)) {
    foreach($_POST as $k => $v ) {
        ${$k} = $v;
    }
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
    if ( isset( $_GET['storyid'])) {
        $storyid = intval( $_GET['storyid'] );
    }
}


// Fonction pour ajouter et/ou éditer un élément
function AddEditIndexForm($IndexId, $Action, $FormTitle, $titlevalue, $weightvalue, $urlvalue, $permittedgroups, $zone01value, $zone02value, $zone03value, $zone04value, $zone05value, $zone06value, $zone07value, $zone08value, $zone09value, $zone10value , $LabelSubmitButton, $pid, $visiblevalue)
{
	include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
	global $xoopsModule, $xoopsModuleConfig;

	$sform = new XoopsThemeForm($FormTitle, "indexform", XOOPS_URL.'/modules/webindex/admin/index.php');
	$sform->addElement(new XoopsFormText(_AM_WEBINDEX_TITLE, 'title', 33, 256, $titlevalue), true);
	$sform->addElement(new XoopsFormText(_AM_WEBINDEX_WEIGHT, 'weight', 3, 4, $weightvalue), false);
	$sform->addElement(new XoopsFormText(_AM_WEBINDEX_URL, 'url', 64, 256, $urlvalue), false);

	$db =& Database::getInstance();
	$xt = new XoopsTree($db->prefix("webindex"), "indexid", "pid");

	ob_start();
	$xt->makeMySelBox('title', 'weight', $pid, 1,'pid');
	$sform->addElement(new XoopsFormLabel(_AM_WEBINDEX_FATHER_INDEX, ob_get_contents()));
	ob_end_clean();

	$groups = explode(" ", $permittedgroups);
    $posselect = new XoopsFormSelectGroup(_AM_WEBINDEX_AUTHORIZEDGROUPS, 'groups', true, $groups, 5, true);
    $sform->addElement($posselect);

	$sform->addElement(new XoopsFormRadioYN(_AM_WEBINDEX_VISIBLE, 'visible', $visiblevalue, _YES, _NO));

	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname01'], 'zone01', $zone01value, 3, 16), false);
	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname02'], 'zone02', $zone02value, 3, 16), false);
	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname03'], 'zone03', $zone03value, 3, 16), false);
	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname04'], 'zone04', $zone04value, 3, 16), false);
	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname05'], 'zone05', $zone05value, 3, 16), false);
	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname06'], 'zone06', $zone06value, 3, 16), false);
	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname07'], 'zone07', $zone07value, 3, 16), false);
	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname08'], 'zone08', $zone08value, 3, 16), false);
	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname09'], 'zone09', $zone09value, 3, 16), false);
	$sform->addElement(new XoopsFormTextArea($xoopsModuleConfig['columnname10'], 'zone10', $zone10value, 3, 16), false);

	$sform->addElement(new XoopsFormHidden('op', $Action), false);
	if(!empty($IndexId)) {
		$sform->addElement(new XoopsFormHidden('indexid', $IndexId), false);
	}

	$button_tray = new XoopsFormElementTray('' ,'');
	$submit_btn = new XoopsFormButton('', 'submit', $LabelSubmitButton, 'submit');
	$button_tray->addElement($submit_btn);
	$cancel_btn = new XoopsFormButton('', 'reset', _AM_WEBINDEX_RESETBUTTON, 'reset');
	$button_tray->addElement($cancel_btn);
	$sform->addElement($button_tray);
	$sform->display();
}

// ******************************************************************************************************************************************
// **** Main ********************************************************************************************************************************
// ******************************************************************************************************************************************
switch ($op)
{
	// Vérification avant ajout d'un élément
	case "verifybeforeedit":
		if ( isset($_POST['submit']) && $_POST['submit'] != "" ) {
			if ($_POST['title']== '') {
				redirect_header( 'index.php', 2, _AM_WEBINDEX_ERROR_ADD_INDEX );
			}
			$grouplist='';
			while ( list($null, $groupid) = each($_POST["groups"]) ) {
				$grouplist.= $groupid.' ';
			}
			$indexid=intval($_POST['indexid']);
			$index = new webindex($indexid);
			$index->setIndexId($indexid);
			$index->setPid(intval($_POST['pid']));
			$index->setModified(time());
			$index->setVisible(intval($_POST['visible']));
			$index->setGroups(trim($grouplist));
			$index->setWeight(intval($_POST['weight']));
			$index->setTitle($_POST['title']);
			$index->setUrl($_POST['url']);
			$index->setZone01($_POST['zone01']);
			$index->setZone02($_POST['zone02']);
			$index->setZone03($_POST['zone03']);
			$index->setZone04($_POST['zone04']);
			$index->setZone05($_POST['zone05']);
			$index->setZone06($_POST['zone06']);
			$index->setZone07($_POST['zone07']);
			$index->setZone08($_POST['zone08']);
			$index->setZone09($_POST['zone09']);
			$index->setZone10($_POST['zone10']);
			$index->setUid($xoopsUser->getVar("uid"));

			if(!$index->store()) {
				redirect_header("index.php", 1,_AM_WEBINDEX_ERROR_MODIFY_DB);
				exit();
			}
			redirect_header("./index.php", 1, _AM_WEBINDEX_DBUPDATED);
		}
        break;

	// Edition d'un élément
    case "edit":
        xoops_cp_header();
		include_once XOOPS_ROOT_PATH . "/modules/webindex/include/nav.php";
        if(isset($_GET['indexid'])) {
    	    $indexid=intval($_GET['indexid']);
    	    $index = new webindex($indexid);
    	    AddEditIndexForm($indexid,'verifybeforeedit', _AM_WEBINDEX_CONFIG, $index->title('Edit'), $index->weight(), $index->url('Edit'), $index->groups(), $index->zone01('Edit'), $index->zone02('Edit'), $index->zone03('Edit'), $index->zone04('Edit'), $index->zone05('Edit'), $index->zone06('Edit'), $index->zone07('Edit'), $index->zone08('Edit'), $index->zone09('Edit'), $index->zone10('Edit'),_AM_WEBINDEX_UPDATE, $index->pid(), $index->visible());
        } else {
			redirect_header("./index.php", 1, _ERRORS);
		}

        break;

    // Suppression d'une ligne
    case "delete":
        if ($_POST['ok'] != 1 ) {
            xoops_cp_header();
            $indexid=intval($_GET['indexid']);
            $index = new webindex($indexid);
            echo "<h4>" . _AM_WEBINDEX_CONFIG . "</h4>";
            xoops_confirm( array( 'op' => 'delete', 'indexid' => $indexid, 'ok' => 1 ), 'index.php', _AM_WEBINDEX_RUSUREDEL.'<br />'.$index->title() );
        } else {
            if (empty( $_POST['indexid']) ) {
                redirect_header('index.php', 2, _AM_WEBINDEX_ERROR_ADD_INDEX);
                exit();
            }
            $indexid=intval($_POST['indexid']);
            $index = new webindex($indexid);
       		$index_arr = $index->getAllChildIndexes();
       		array_push($index_arr, $index);
       		foreach( $index_arr as $eachindex) {
           		$eachindex->delete();
       		}
            redirect_header( 'index.php', 1, _AM_WEBINDEX_DBUPDATED);
            exit();
        }
        break;


	// Vérification avant ajout
    case "verifytoadd":
		if (isset($_POST['submit']) && $_POST['submit'] != "" ) {
			if ($_POST['title'] == '') {
				redirect_header( 'index.php', 2, _AM_WEBINDEX_ERROR_ADD_INDEX );
			}
			$grouplist='';
			while (list($null, $groupid) = each($_POST["groups"]) ) {
				$grouplist.= $groupid.' ';
			}
			$index = new webindex();
			$index->setTitle($_POST['title']);
			$index->setWeight(intval($_POST['weight']));
			$index->setUrl($_POST['url']);
			$index->setPid(intval($_POST['pid']));
			$index->setGroups(trim($grouplist));
			$index->setZone01($_POST['zone01']);
			$index->setZone02($_POST['zone02']);
			$index->setZone03($_POST['zone03']);
			$index->setZone04($_POST['zone04']);
			$index->setZone05($_POST['zone05']);
			$index->setZone06($_POST['zone06']);
			$index->setZone07($_POST['zone07']);
			$index->setZone08($_POST['zone08']);
			$index->setZone09($_POST['zone09']);
			$index->setZone10($_POST['zone10']);
			$index->setCreated(time());
			$index->setModified(time());
			$index->setVisible(intval($_POST['visible']));
			$index->setUid($xoopsUser->getVar("uid"));
			if(!$index->store()) {
				redirect_header("index.php", 1,_AM_WEBINDEX_ERROR_ADD_INDEX);
				exit();
			}
			redirect_header("./index.php", 1, _AM_WEBINDEX_ADDED_OK);
		}
        break;

	// Affichage du formulaire d'ajout
    case "addindex":
    	xoops_cp_header();
		include_once XOOPS_ROOT_PATH . "/modules/webindex/include/nav.php";
		AddEditIndexForm(0,'verifytoadd', _AM_WEBINDEX_CONFIG, '',  0,'', '1 2 3 4 5 6 7', '','','','','','','','','','',_AM_WEBINDEX_ADDBUTTON,0,1);
        break;

	// Action par défaut, lister les indexes
    case "default":
    default:
        xoops_cp_header();
		include_once XOOPS_ROOT_PATH . "/modules/webindex/include/nav.php";
        echo "<h4>" . _AM_WEBINDEX_CONFIG . "</h4><br />\n";
        echo"<table width='100%' border='0' cellspacing='1' class='outer'>\n";
        echo "<tr><th align='center'>". _AM_WEBINDEX_ID . "</th><th align='center'>" . _AM_WEBINDEX_TITLE . "</th><th align='center'>" . _AM_WEBINDEX_CREATED . "</th><th align='center'>" . _AM_WEBINDEX_MODIFIED . "</th><th align='center'>" .  _AM_WEBINDEX_WEIGHT . "</th><th align='center'>" . _AM_WEBINDEX_VISIBLE . "</th><th align='center'>" . _AM_WEBINDEX_ACTION . "</th></tr>\n";
		$pv=0;
		$cpt=0;
		$index = new webindex();
		$indexarray= $index->getAllIndexs();
		$class = 'even';
		$baseurl=XOOPS_URL.'/modules/'.$xoopsModule->getVar('dirname').'/admin/index.php';
		if (count($indexarray) >0) {
        	foreach($indexarray as $index) {
				$action_edit="<a href='".$baseurl."?op=edit&indexid=".$index->indexid()."' title='"._AM_WEBINDEX_EDIT."'><img src='../images/icon/edit.gif' alt='"._AM_WEBINDEX_EDIT."'></a>";
				$action_delete="<a href='".$baseurl."?op=delete&indexid=".$index->indexid()."' title='"._AM_WEBINDEX_DELETE."'><img src='../images/icon/delete.gif' alt='"._AM_WEBINDEX_DELETE."'></a>";
				$visible= "on";
				if($index->visible!=1) {
					$visible="off";
				}
				if($index->pid()!=0) {
					if($pv!=$index->pid()) {
						$cpt++;
						$pv=$index->pid();
					}
				} else {
					$cpt=0;
				}
				$whitespace=str_repeat('-',$cpt);
				if($cpt) {
					$whitespace.='&nbsp;';
				}
				echo "<tr class='".$class."'><td align='center'>" . $index->indexid() . "</td><td align='left'>" . $whitespace.'&nbsp;'.$index->title(). "</td><td align='center'>" . $index->created() . "</td><td align='center'>" . $index->modified() . "</td><td align='right'>" . $index->weight() . "</td><td align='center'><img src='../images/icon/" . $visible . ".gif'></td><td align='center'>" . $action_edit . "&nbsp;|&nbsp;" . $action_delete . "</td></tr>\n";
				$class = ($class == 'even') ? 'odd' : 'even';
        	}
        }
		echo "<tr class='".$class."'><td colspan='7' align='center'><form name='faddindex' method='post' action='index.php'><input type='hidden' name='op' value='addindex'><input type='submit' name='submit' value='"._AM_WEBINDEX_ADDINDEX."'></td></tr>";
        echo"</table>";
		echo "<p align=center>Webindex - (c) 2004 - <a href='http://www.wolfpackclan.com/'>Solo</a> & <a href='http://www.herve-thouzard.com/'>Hervé</a></p>";

        break;
}

xoops_cp_footer();
?>

