<?php

class MpnXmlBuilder {
	public $useTable = false; // This model does not use a database table
	private $txtFileName;
	private $products = array();
	
	public function loadData(){
		$handle = fopen($this->txtFileName,'r') or die("File unavailable");
		$previousLine = null;
		$product = new Category();
		$links = $this->getLinks();
		
		$n = 0; $i = 1;
		while(($line = fgets($handle)) !== false){
			if($n!=0){
				$line = str_replace("\n", "", $line);
				$line = str_replace("\r", "", $line);
				$lineArray = explode("\t",$line);
				//var_dump($lineArray);
				if(!isset($lineArray[4])){
					if($lineArray[0] != $previousLine){ //new Category
						if($previousLine != null){
							$this->products["info$i"] = $product;
							$product = new Category($lineArray[0], "info$i");
							$i++;
						}
						else{ $product->setTitle($lineArray[0]); $product->setWebId("info$i"); }
					}
					$link = null;
					foreach($links as $key => $val){
						
						print $key.'|'.$lineArray[2];
						//var_dump($key); var_dump($lineArray[2]);
						$link = trim($lineArray[2]) == trim($key) ? $val : null;
						if($link != null){
							$lineArray[4] = $link;
							$line = implode("\t", $lineArray).PHP_EOL; ;
							file_put_contents('C:/Users/Chris/webdocs/projects/app/webroot/mpn_updated.txt',$line, FILE_APPEND);
						}
						print '|'.$link.'<br>';
					}
					$test = new Test($lineArray[2],$lineArray[1],$link);
					$product->addTest($test);
					$previousLine = $lineArray[0];
				}
			}
			$n++;
		}
		
	}
	
	public function reloadData(){
		foreach($products as $category){
			
		}
	}
	
	private function getLinks(){
		$url = "http://www.measureup.com/All-Microsoft-Practice-Tests-C318.aspx";
		
		$doc = new DOMDocument();
		@$doc->loadHTMLFile($url);
		
		$elements = $doc->getElementsByTagName('td');
		$i = 0;
		$links;
		$prevVal = null;
		foreach($elements as $td){
			$anchors = $elements->item($i)->getElementsByTagName('a');
			$j = 0;
			foreach($anchors as $anchor){
				$url = $anchors->item($j)->getAttribute('href');
				$text = $anchors->item($j)->nodeValue;
				if(!strpos($url,"__doPostBack")	&& !strpos($url,"ProductDemoForm.aspx") && 
					strncmp($url,"/",1) 				&& $prevVal != $url){
						$text =  preg_replace('/\s+/', '', $text);
						//echo $text.'&nbsp; &nbsp;'.$url.'<br>';
						$links[$text] = $url;
				}
				$prevVal = $url;
				$j++;
			}
			$i++;
		}
		return $links;
	}
	
	public function loadLinks(array $links){
		foreach($links as $num => $link){
			foreach($this->products as $key =>$val){
				$findKey = array_search($num,$val);
				$this->products[$key][$findKey]->setWebUrl($link);
			}
		}
	}
	
	public function getProducts(){
		return $this->products;	
	}
	public function getCategory($cat){
		return $this->products[$cat];
	}
	public function setFileName($fileName){
		$this->txtFileName  = $fileName;
	}
	
	public function dumpData(){
		var_dump($this->products);
	}
}

class Category {
	//public $useTable = false; // This model does not use a database table
	private $title,$webId;
	private $tests = array();
	
	function __construct($title = null, $webId = null) {
		$this->setTitle($title);
		$this->setWebId($webId);
	}
	
	public function getTitle(){return $this->title;}
	public function getWebId(){return $this->webId;}
	
	public function setTitle($title){$this->title = $title;}
	public function setWebId($webId){$this->webId = $webId;}
	
	public function addTest($test){
		array_push($this->tests,$test);
	}
	
	public function getTest($number){
		return isset($this->tests[$number]) ? $this->tests[$number] : false;
	}
	
	public function deleteTest($number){
		if(isset($this->tests[$number])) {
			unset($this->tests[$number]);
			return true;
		}	
		else return false;
	}
} 

class Test {
	//public $useTable = false; // This model does not use a database table
	private $title,$number,$webUrl;
	
	function __construct($number, $title = null, $webUrl = null){
		$this->setNumber($number);
		$this->setTitle($title);
		$this->setWebUrl($webUrl);
	}
	
	public function getTitle(){return $this->title;}
	public function getWebUrl(){return $this->webUrl;}
	public function getNumber(){return $this->number;}

	public function setTitle($title){$this->title = $title;}
	public function setWebUrl($webUrl){$this->webUrl = $webUrl;}
	public function setNumber($number){$this->number = $number;}

}
$file = 'C:\Users\Chris\Documents\Product by Competencies_FINAL_April17.txt';
$build = new MpnXmlBuilder();
$build->setFileName($file);
$build->loadData();
//$build->dumpData();

//var_dump($elements);

//$build->loadLinks();
