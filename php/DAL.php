<?php
require_once("DatabaseAccess.php");

class DAL
{
	public static function GetYears()
	{
		$years = array();
		
		$years[] = "1998"; $years[] = "2000";
		$years[] = "2001"; $years[] = "2002";
		$years[] = "2003"; $years[] = "2004";
		$years[] = "2005"; $years[] = "2006";
		$years[] = "2007"; $years[] = "2008";
		$years[] = "2009"; $years[] = "2010";
		$years[] = "2011"; $years[] = "All"; 
		
		return $years;
	}
}