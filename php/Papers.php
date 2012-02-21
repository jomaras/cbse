<?php
require_once("FileAccess.php");
require_once("DatabaseAccess.php");
require_once("HtmlHelper.php");
require_once("UrlHelper.php");

class Paper
{
	function __construct($title, $authors, $abstract, $keywords, $year, $label, $id, $citation, $topic, $rq, $result, $validation, $matureness)
	{
		$this->title = $title;
		$this->authors = $authors;
		$this->abstract = $abstract;
		$this->keywords = $keywords;
		$this->year = $year;
		$this->label = $label;
		
		$this->id = $id;
		$this->citation = $citation;
		$this->topic = $topic;
		$this->rq = $rq;
		$this->result = $result;
		$this->validation = $validation;
		$this->matureness = $matureness;
	}
	
	public $title;
	public $authors;
	public $abstract;
	public $keywords;
	public $year;
	public $label;
	
	public $id; 
	public $citation; 
	public $topic; 
	public $rq; 
	public $result; 
	public $validation; 
	public $matureness;
	
	public function generateHtml()
	{
		return "<tr>"
				."<td class='dataContainer'>"
						. "<span class='idContainer'>$this->id</span>"
				. "</td>"
				.  "<td class='titleContainer'>$this->title</td>"
				.  "<td class='abstractContainer'>$this->abstract</td>"
				.  "<td class='keywordsContainer'>$this->keywords</td>"
				.  "<td class='labelContainer'>$this->label</td>"
				.  "<td class='topicContainer'>$this->topic</td>"
				.  "<td class='rqContainer'>$this->rq</td>"
				.  "<td class='resultContainer'>$this->result</td>"
				.  "<td class='validationContainer'>$this->validation</td>"
				.  "<td class='maturenessContainer'>$this->matureness</td>"
				.  "<td class='authorsContainer'>$this->authors</td>"
				.  "<td class='yearContainer'>$this->year</td>"
				.  "<td class='citationContainer'>$this->citation</td>"
			 . "</tr>";
	}
	
	function __toString()
	{
		return "Title: " . $this->title ."<br/>"
			.  "Authors:" . $this->authors ."<br/>"
			.  "Abstract:" . $this->abstract ."<br/>"
			.  "Keywords:" . $this->keywords ."<br/>"
			.  "Label:" . $this->label ."<br/>"
			.  "Year:" . $this->year ."<br/><br/><br/>";
	}
	
	public static function getPapersFromEndNote($pathToEndNoteXmlEncodedPapers)
	{
		$papers = array();
		
		$xmlData = new SimpleXMLElement(FileAccess::GetFileContent($pathToEndNoteXmlEncodedPapers));
		
		foreach ($xmlData->records->record as $record)
		{
			$papers[] = new Paper
			(
				self::_mergeValues($record->titles->title),
				self::_mergeValues($record->contributors->authors->author),
				$record->abstract,
				self::_mergeValues($record->keywords->keyword),
				$record->dates->year,
				str_replace(";", "; ", $record->label),
				"", "","","","","",""
			);
		}
		
		return $papers; 
	}
	
	public static function getPapersHtmlByYear($year)
	{
		if($year == "") { $year = 1998; }
		
		$papers = $year == "All" ? self::getAllPapersFromDb()
								 : self::getPapersFromDbByYear($year);
		
		$html = "";
		
		foreach($papers as $paper)
		{
			$html .= $paper->generateHtml();
		}
		
		return $html;
	}
	
	public static function getAllPapersFromDb()
	{
		return self::getPapersFromDb("SELECT * FROM papers;");
	}
	
	public static function getPapersFromDbByYear($year)
	{
		return self::getPapersFromDb("SELECT * FROM papers WHERE Year=$year;");
	}
	
	public static function getPapersFromDb($query)
	{
		$table = DatabaseAccess::ExQuery($query);
	
		$papers = array();
	
		foreach($table as $row)
		{
			$papers[] = new Paper
			(
				$row[1], $row[2], $row[4],
				$row[6], $row[3], $row[7],
				$row[0], $row[5], $row[8],
				$row[9], $row[10], $row[11],
				$row[12]
			);
		}
	
		return $papers;
	}
	
	private static function _mergeValues($elements)
	{
		$merged = "";
		
		if($elements == null) { return ""; }
		
		foreach($elements as $element)
		{
			$merged .= $element . "; ";
		}
		
		return $merged;
	}
}