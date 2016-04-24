<?php
	function connect()
	{
		$cxn = mysql_connect('tund.cefns.nau.edu', 'eld66', 'cs477rocks') or die(mysql_error());
		mysql_selectdb('eld66', $cxn) or die(mysql_error());
		return $cxn;
	}
?>