<?php

function webindex_search($queryarray, $andor, $limit, $offset, $userid){
	include_once XOOPS_ROOT_PATH . "/modules/webindex/class/class.webindex.php";
	global $xoopsDB, $xoopsUser;

	$sql = "SELECT * FROM ".$xoopsDB->prefix("webindex")." WHERE visible=1" ;
	if ( $userid != 0 ) {
		$sql .= " AND uid=".$userid." ";
	}

	if ( is_array($queryarray) && $count = count($queryarray) ) {
		$sql .= " AND ((title LIKE '%$queryarray[0]%' OR zone01 LIKE '%$queryarray[0]%' OR zone02 LIKE '%$queryarray[0]%' OR zone03 LIKE '%$queryarray[0]%' OR zone04 LIKE '%$queryarray[0]%' OR zone05 LIKE '%$queryarray[0]%' OR zone06 LIKE '%$queryarray[0]%' OR zone07 LIKE '%$queryarray[0]%' OR zone08 LIKE '%$queryarray[0]%' OR zone09 LIKE '%$queryarray[0]%' OR zone10 LIKE '%$queryarray[0]%')";
		for($i=1;$i<$count;$i++){
			$sql .= " $andor ";
			$sql .= "(title LIKE '%$queryarray[$i]%' OR zone01 LIKE '%$queryarray[$i]%' OR zone02 LIKE '%$queryarray[$i]%' OR zone03 LIKE '%$queryarray[$i]%' OR zone04 LIKE '%$queryarray[$i]%' OR zone05 LIKE '%$queryarray[$i]%' OR zone06 LIKE '%$queryarray[$i]%' OR zone07 LIKE '%$queryarray[$i]%' OR zone08 LIKE '%$queryarray[$i]%' OR zone09 LIKE '%$queryarray[$i]%' OR zone10 LIKE '%$queryarray[$i]%')";
		}
		$sql .= ") ";
	}
	$sql .= "ORDER BY weight";
	$result = $xoopsDB->query($sql,$limit,$offset);
	$ret = array();
	$i = 0;
	$group = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);

 	while($myrow = $xoopsDB->fetchArray($result))
 	{
 		$index = new webindex($myrow['indexid']);
		$groups = explode(" ",$index->groups());
		if(count(array_intersect($group,$groups)) > 0)
		{
			$ret[$i]['image'] = "images/webindex_icon.gif";
			$ret[$i]['uid'] = $myrow['uid'];
			$ret[$i]['link'] = "index.php";
			$ret[$i]['title'] = $myrow['title'];
			$ret[$i]['time'] = $myrow['created'];
			$i++;
		}
	}
	return $ret;
}
?>