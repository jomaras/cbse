<?php
class UrlHelper
{
    /**
     * @return string
     */
    public static function GetCurrentURL()
    {
        return  $PHP_SELF;
    }

    /**
     * @param $attribute string
     * @return string
     */
    public static function GetAttributeValue($attribute)
    {
        if(isset($_REQUEST[$attribute])) {return $_REQUEST[$attribute];}
    }

    /**
     * @param $attribute string
     * @param $arrayOfPossibleValues array of string
     * @param $defaultValue string
     * @return string
     */
    public static function GetAttributeOrDefaultValue($attribute, $arrayOfPossibleValues, $defaultValue)
    {
        $attributeFromRequest = UrlHelper::GetAttributeValue($attribute);

        if(isset($attributeFromRequest))
        {
            foreach ($arrayOfPossibleValues as $possibleValue)
            {
                if(ValueTypeHelper::AreEqual($possibleValue, $attributeFromRequest))
                {
                    return $possibleValue;
                }
            }
        }

        return $defaultValue;
    }

    /**
     * @return string
     */
    public static function GetCurrentPageName()
    {
        return $_SERVER['SCRIPT_NAME'];
    }

    /**
     * @return string
     */
    public static function GetRequest()
    {
        $currentUrl =  ($_SERVER['REQUEST_URI']);

        $splittedUrl = explode('?', $currentUrl, 2);

        echo ($splittedUrl[1]);
    }
}
?>