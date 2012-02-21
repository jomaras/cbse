<?php
class HtmlHelper
{
	public static function encapsulateInTableRow($string)
	{
		return self::encapsulateInElement($string, "tr");
	}
	
	public static function encapsulateInTableCell($string)
	{
		return self::encapsulateInElement($string, "td");
	}
	
	public static function encapsulateInLink($href, $content)
	{
		return "<a href='$href'>$content</a>";
	}
	
	public static function encapsulateInOption($content, $selectedContent)
	{
		if($content === $selectedContent)
		{
			return "<option value='$content' selected>$content</option>";
		}
		
		return "<option value='$content'>$content</option>";
	}
	
	public static function encapsulateInElement($string, $element)
	{
		return "<$element>$string</$element>";
	}
}