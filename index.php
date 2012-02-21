<?php
	require_once("php/Papers.php");
	require_once("php/CbseHtmlHelper.php");
	require_once("php/UrlHelper.php");
?>
<html>
	<head>	
		<title>CBSE Literature Review</title>
		<link href="styles/style.css" rel="stylesheet"/>
		<script src="scripts/jQuery.js"></script>
		<script>
			$(document).ready(function()
			{
				$("#selectYear").change(function()
				{
					window.location = "?selectedYear=" + $(this).val();
				});

				$("#viewButton").click(function()
				{
					
					return false;
				});
			});
		</script>
	</head>
	<body>
		<div id="mainContainer">
			<div id="innerContainer">
				<h2>CBSE</h2>
				<form>
					<select name="selectedYear" id="selectYear">
						<?php echo(CbseHtmlHelper::generateYearsHtml()); ?>
					</select>
					
					<select name="author">
						<option>Ivica</option>
						<option>Luka</option>
						<option>Josip</option>
					</select>
					<button id="viewButton">View</button>
					<table id="papersTable">
						<thead>
							<tr>
								<th style="display: none;"></th>
								<th>Title</th>
								<th>Abstract</th>
								<th>Keywords</th>
								<th>Location</th>
								<th>Topic</th>
								<th>RQ</th>
								<th>Result</th>
								<th>Validation</th>
								<th>Matureness</th>
								<th>Authors</th>
								<th>Year</th>
								<th>Citation</th>
							</tr>
						</thead>
						<tbody>
							<?php echo(Paper::getPapersHtmlByYear(UrlHelper::GetAttributeValue("selectedYear")));?>
						</tbody>		
					</table>
				</form>
				<div style="clear:both; margin:10px; height: 10px;"></div>
			</div>
		</div>
	</body>
</html>