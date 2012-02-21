<?php
require_once("php/FileAccess.php");
require_once("php/DatabaseAccess.php");
require_once("php/Papers.php");

$mainFolder= "data/mendeley/";
$dbAccess = new DatabaseAccess("localhost", "admin", "admin", "passAdmin1");
 
foreach(FileAccess::getFilesNamesInFolder($mainFolder) as $fileName)
{
	$fileName = $mainFolder . $fileName;
	$papers = Paper::getPapersFromEndNote($fileName);
	
	foreach($papers as $paper)
	{
 		$dbAccess->ExecuteQuery
 		(
 			"INSERT INTO papers (title, authors, year, abstract, keywords, locationTag) VALUES ('$paper->title', '$paper->authors', $paper->year, '$paper->abstract', '$paper->keywords', '$paper->label');"
 		);
	}
}