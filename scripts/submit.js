$(document).ready(function()
{
	function isNumber(num) 
	{
		return !isNaN(parseInt(num));
	}
	
	$("#addFieldButton").click(function()
	{
		var yearValue = $("#yearField").attr("value");
		
		if(isNumber(yearValue))
		{
			$("#userForm").submit();
		}
		else
		{
			alert("Value for year: " + yearValue + " is not a number!");
		}
	});
});