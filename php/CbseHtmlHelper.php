<?php

require_once("DAL.php");
require_once("HtmlHelper.php");
require_once("UrlHelper.php");

class CbseHtmlHelper
{
	public static function generateYearsHtml()
	{
		$years = DAL::getYears();
		
		$html = "";
		$selectedYear = UrlHelper::GetAttributeValue("selectedYear");
		
		if($selectedYear == "") { $selectedYear = "1998"; }
		
		foreach($years as $year)
		{
			$html .= HtmlHelper::encapsulateInOption($year, $selectedYear);
		}
		
		return $html;
	}
}