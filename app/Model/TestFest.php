<?php 
App::uses('AppModel', 'Model');

class TestFest extends AppModel {
	public $useTable = false;
	public $validate = array(
		'file' => array(
			'rule' => 'notEmpty',
			'message' => 'Location of file to update required'
		),
		'organization' => array(
			'rule' => 'notEmpty',
			'message' => 'Organization Required'
		),
		'location' => array(
			'rule' => 'notEmpty',
			'message' => 'Location Required'
		),
	);
	
	public $_schema = array(
		'file' => array(
			'type' => 'string',
			'length' => 500,
			'null' => false,
		),
		'filePath' => array(
			'type' => 'string',
			'length' => 500,
			'null' => false,
		),
		'id' => array(
			'type' => 'string',
			'length' => 200,
			'null' => true,
		),
		'organization' => array(
			'type' => 'string',
			'length' => 150,
			'null' => false
		),
		'location' => array(
			'type' => 'string',
			'length' => 200,
			'null' => false
		),
		'eventDate' => array(
			'type' => 'date',
			'null' => false,
		),
		'eventStartTime' => array(
			'type' => 'time',
			'null' => true,
		),
		'eventEndTime' => array(
			'type' => 'time',
			'null' => true,
		),
		'eventCost' => array(
			'type' => 'string',
			'length' => 200,
			'null' => true,
		),
		'isPreRequisiteRequired' => array(
			'type' => 'boolean'
		),
		'isReviewIncluded' => array(
			'type' => 'boolean'
		),
		'eventManager' => array(
			'type' => 'string',
			'length' => 200,
			'null' => false,
		),
		'eventSummary' => array(
			'type' => 'text',
			'length' => 200,
			'null' => false,
		),
	);
	
	public function addData($data = null){
		if(empty($data)) return false;
		else{
			$test = $data['TestFest'];
			$idLoc = explode(' ', $test['location']);
			$idLoc = explode(',', $idLoc[0]);
			$test['id'] = $idLoc[0].$test['eventDate']['month'].$test['eventDate']['day'];
			$test['isPreRequisiteRequired'] = $test['isPreRequisiteRequired'] == 1 ? 'Yes': 'No';
			$test['isReviewIncluded'] = $test['isReviewIncluded'] == 1 ? 'Yes': 'No';
			if($test['eventStartTime']['meridian'] =='pm') $test['eventStartTime']['hour'] += 12;
			if($test['eventEndTime']['meridian'] =='pm') $test['eventEndTime']['hour'] += 12;
			if(empty($test['eventCost'])) $test['eventCost'] = 'Free';
			if(empty($test['eventManager'])) $test['eventManager'] = 'TBA';
			if(empty($test['eventSummary'])) $test['eventSummary'] = 'Coming Soon!';
			$test['filePath'] .= $test['file']['name'];
			//var_dump($test);
			
			return $this->mergeHtml($this->getHtml($test['filePath']),$this->makeRow($test),$test['filePath']);
		}
	}
	
	private function getHtml($url = "Z:/mta-test-fest/index.html"){
		$doc = file_get_contents($url);
		return $doc;
		
	}
	
	private function mergeHtml($doc,$row,$url = "Z:/mta-test-fest/index - Copy.html"){
		$splitDoc = explode('<!--PDI-->',$doc);
		if(is_array($splitDoc)){
			$reconst = $splitDoc[0].$row.$splitDoc[1];
			file_put_contents($url,$reconst);
			return true;
		}
		return false;
	}
	
	private function makeRow(array $test) {
		$html = '<tr onClick="showInfo(\'currentEvents\',\''.$test['id'].'\', this);">
			<td class="th1">'.$test['organization'].'</td>
			<td class="th2">'.$test['location'].'</td>
			<td class="th3">'.date('F jS, Y',mktime(0,0,0,$test['eventDate']['month'],$test['eventDate']['day'],$test['eventDate']['year'])).'</td>
			<div class="th4" id="'.$test['id'].'">
				<p>'.$test['organization'].'</p>
				<p>'.$test['location'].'</p>
				<p>'.date('F jS, Y',mktime(0,0,0,$test['eventDate']['month'],$test['eventDate']['day'],$test['eventDate']['year'])).'</p>
				<p>'.date('g:i A',mktime($test['eventStartTime']['hour'],$test['eventStartTime']['min'])).' &mdash; '.date('g:i A',mktime($test['eventEndTime']['hour'],$test['eventEndTime']['min'])).'</p>
				<p>'.$test['eventCost'].'</p>
				<p>'.$test['isPreRequisiteRequired'].'</p>
				<p>'.$test['isReviewIncluded'].'</p>
				<p>'.$test['eventManager'].'</p>
				<p>'.$test['eventSummary'].'</p>
			</div>
		</tr>
		<!--PDI-->';
		//var_dump ($html);
		return $html;
	}

} 