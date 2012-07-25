<?php
	echo "<div id='navcontainer'><ul style='padding: 3px 0; margin-left: 0; font: bold 12px Verdana, sans-serif; '>";

	echo "<li style='list-style: none; margin: 0; display: inline; '><a href='../index.php' style='padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: #DDE; text-decoration: none; '>"._AM_WEBINDEX_GO."</a></li>";

	echo "<li style='list-style: none; margin: 0; display: inline; '><a href='../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule -> getVar( 'mid' )."' style='padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: #DDE; text-decoration: none; '>"._AM_WEBINDEX_PREFERENCES."</a></li>";

	echo "<li style='list-style: none; margin: 0; display: inline; '><a href='index.php' style='padding: 3px 0.5em; margin-left: 3px; border: 1px solid #778; background: white; text-decoration: none; '>"._AM_WEBINDEX_CONFIG."</a></li></ul></div>";



?>