<?php
include_once XOOPS_ROOT_PATH."/class/xoopstree.php";

class webindex
{
	var $db;
	var $table;
	// Variables propres à la table
	var $indexid;
	var $pid;
	var $created;
	var $modified;
	var $visible;
	var $groups;
	var $weight;
	var $title;
	var $url;
	var $zone01;
	var $zone02;
	var $zone03;
	var $zone04;
	var $zone05;
	var $zone06;
	var $zone07;
	var $zone08;
	var $zone09;
	var $zone10;
	var $uid;
	var $hits;

	// Constructeur
	function webindex($indexid=-1, $table='webindex')
	{
		$this->db =& Database::getInstance();
		$this->table = $this->db->prefix($table);
		if( $indexid != -1 ) {
			$this->getIndex(intval($indexid));
		}
	}

	function getIndex($indexid)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE indexid=".intval($indexid)."";
		$array = $this->db->fetchArray($this->db->queryF($sql));
		$this->makeIndex($array);
	}

	function makeIndex($array)
	{
		foreach ( $array as $key=>$value ){
			$this->$key = $value;
		}
	}

	function getAllIndexs()
	{
		$ret = array();
		$xt = new XoopsTree($this->table, "indexid", "pid");
//		$index_arr = $xt->getChildTreeArray(0, "weight");
		$index_arr = $xt->getChildTreeArray(0, "title");
		if (is_array($index_arr) && count($index_arr) )
		{
			foreach($index_arr as $index)
			{
				$ret[] = new webindex($index['indexid']);
			}
		}
		return $ret;
	}


	function getAllCategory()
	{
		$ret = array();
		$xt = new XoopsTree($this->table, "indexid", "pid");
//		$index_arr = $xt->getChildTreeArray(0, "weight");
		$index_arr = $xt->getChildTreeArray(0, "title");
		if (is_array($index_arr) && count($index_arr) )
		{
			foreach($index_arr as $index)
			{
				$ret[] = new webindex($index['indexid']);
			}
		}
		return $ret;
	}



	function store()
	{
		$myts =& MyTextSanitizer::getInstance();
		$title = $myts->makeTboxData4Save($myts->censorString($this->title));
		$url = $myts->makeTboxData4Save($myts->censorString($this->url));
		$zone01= $myts->makeTareaData4Save($myts->censorString($this->zone01));
		$zone02= $myts->makeTareaData4Save($myts->censorString($this->zone02));
		$zone03= $myts->makeTareaData4Save($myts->censorString($this->zone03));
		$zone04= $myts->makeTareaData4Save($myts->censorString($this->zone04));
		$zone05= $myts->makeTareaData4Save($myts->censorString($this->zone05));
		$zone06= $myts->makeTareaData4Save($myts->censorString($this->zone06));
		$zone07= $myts->makeTareaData4Save($myts->censorString($this->zone07));
		$zone08= $myts->makeTareaData4Save($myts->censorString($this->zone08));
		$zone09= $myts->makeTareaData4Save($myts->censorString($this->zone09));
		$zone10= $myts->makeTareaData4Save($myts->censorString($this->zone10));
		$groups = $myts->makeTboxData4Save($this->groups);

		if (!isset($this->indexid))
		{
			$sql = sprintf("INSERT INTO %s (pid, created, modified, visible, groups, weight, title, url, zone01, zone02, zone03, zone04, zone05, zone06, zone07, zone08, zone09, zone10, uid, hits) VALUES (%u, %u, %u, %u, '%s', %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %u, %u )",$this->table,$this->pid(), $this->created('Edit'), $this->modified('Edit'), $this->visible(), $groups, $this->weight(), $title, $url, $zone01, $zone02, $zone03, $zone04, $zone05, $zone06, $zone07, $zone08, $zone09, $zone10, $this->uid(), $this->hits());
			$newindexid=0;
		}
		else
		{
			$sql = sprintf("UPDATE %s set pid=%u, created=%u, modified=%u, visible=%d, groups='%s', weight=%u, title='%s', url='%s',zone01='%s', zone02='%s', zone03='%s', zone04='%s', zone05='%s', zone06='%s', zone07='%s', zone08='%s', zone09='%s', zone10='%s', uid=%u, hits=%u WHERE indexid=%u",$this->table, $this->pid(), $this->created('Edit'), $this->modified('Edit'), $this->visible(), $groups, $this->weight(), $title, $url, $zone01, $zone02, $zone03, $zone04, $zone05, $zone06, $zone07, $zone08, $zone09, $zone10, $this->uid(), $this->hits(), $this->indexid());
			$newindexid = $this->indexid();
		}
		if (!$result = $this->db->queryF($sql)) {
			return false;
		}
		if (empty($newindexid)) {
			$newindexid= $this->db->getInsertId();
			$this->indexid= $newindexid;
		}
		return $newindexid;
	}

	// *****************************************************************************************************************************
	// Tous les Get
	// *****************************************************************************************************************************
	function indexid()
	{
		return intval($this->indexid);
	}

	function pid()
	{
		return intval($this->pid);
	}

	function created($format="Show")
	{
		switch ( $format )
		{
			case "Show":
				if(!empty($this->created)) {
					return formatTimestamp($this->created);
				} else {
					return '';
				}
				break;
			case "Edit":
				return intval($this->created);
				break;
		}
	}

	function modified($format="Show")
	{
		switch ( $format )
		{
			case "Show":
				if(!empty($this->modified)) {
					return formatTimestamp($this->modified);
				} else {
					return '';
				}
				break;
			case "Edit":
				return intval($this->modified);
				break;
		}
	}

	function visible()
	{
		return intval($this->visible);
	}

	function groups()
	{
		return $this->groups;
	}

	function weight()
	{
		return intval($this->weight);
	}

	function title($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		switch ( $format ) {
		case "Show":
			$title = $myts->makeTboxData4Show($this->title);
			break;
		case "Edit":
			$title = $myts->makeTboxData4Edit($this->title);
			break;
		case "Preview":
			$title = $myts->makeTboxData4Preview($this->title);
			break;
		case "InForm":
			$title = $myts->makeTboxData4PreviewInForm($this->title);
			break;
		}
		return $title;
	}

	function url($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		switch ( $format ) {
		case "Show":
			$url = $myts->makeTboxData4Show($this->url);
			break;
		case "Edit":
			$url = $myts->makeTboxData4Edit($this->url);
			break;
		case "Preview":
			$url = $myts->makeTboxData4Preview($this->url);
			break;
		case "InForm":
			$url = $myts->makeTboxData4PreviewInForm($this->url);
			break;
		}
		return $url;
	}

	function zone01($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone01;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function zone02($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone02;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function zone03($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone03;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function zone04($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone04;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function zone05($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone05;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function zone06($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone06;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function zone07($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone07;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function zone08($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone08;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function zone09($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone09;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function zone10($format="Show")
	{
		$myts =& MyTextSanitizer::getInstance();
		$tmp=$this->zone10;
		switch ( $format ) {
		case "Show":
			$zone = $myts->makeTareaData4Show($tmp);
			break;
		case "Edit":
			$zone = $myts->makeTareaData4Edit($tmp);
			break;
		case "Preview":
			$zone = $myts->makeTareaData4Preview($tmp);
			break;
		case "InForm":
			$zone = $myts->makeTareaData4PreviewInForm($tmp);
			break;
		case "keep":
			$zone=$tmp;
		}
		return $zone;
	}

	function uid()
	{
		return intval($this->uid);
	}

	function hits()
	{
		return intval($this->hits);
	}

	// *****************************************************************************************************************************
	// Tous les Set
	// *****************************************************************************************************************************
	function setIndexId($value)
	{
		$this->indexid=intval($value);
	}

	function setPid($value)
	{
		$this->pid=intval($value);
	}

	function setCreated($value)
	{
		$this->created = intval($value);
	}

	function setModified($value)
	{
		$this->modified = intval($value);
	}

	function setVisible($value)
	{
		$this->visible =intval($value);
	}

	function setGroups($value)
	{
		$this->groups = $value;
	}

	function setWeight($value)
	{
		$this->weight=intval($value);
	}

	function setTitle($value)
	{
		$this->title = $value;
	}

	function setUrl($value)
	{
		$this->url = $value;
	}


	function setZone01($value)
	{
		$this->zone01 = $value;
	}

	function setZone02($value)
	{
		$this->zone02 = $value;
	}

	function setZone03($value)
	{
		$this->zone03 = $value;
	}

	function setZone04($value)
	{
		$this->zone04 = $value;
	}

	function setZone05($value)
	{
		$this->zone05 = $value;
	}

	function setZone06($value)
	{
		$this->zone06 = $value;
	}

	function setZone07($value)
	{
		$this->zone07 = $value;
	}

	function setZone08($value)
	{
		$this->zone08 = $value;
	}

	function setZone09($value)
	{
		$this->zone09 = $value;
	}

	function setZone10($value)
	{
		$this->zone10 = $value;
	}

	function setUid($value)
	{
		$this->uid=intval($value);
	}

	function setHits($value)
	{
		$this->hits=intval($value);
	}

	function getAllChildIndexes()
	{
		$ret = array();
		$xt = new XoopsTree($this->table, "indexid", "pid");
		$index_arr = $xt->getAllChild($this->indexid, "weight");
		if ( is_array($index_arr) && count($index_arr) ) {
			foreach($index_arr as $index){
				$ret[] = new webindex($index['indexid']);
			}
		}
		return $ret;
	}

	function delete()
	{
		$sql = sprintf("DELETE FROM %s WHERE indexid=%u", $this->table, $this->indexid);
		if( !$result = $this->db->queryF($sql) ) {
			return false;
		}
		return true;
	}
}
?>
