<?php

namespace App\Controllers;

//os recursos do agendou
use App\Models\agendamento;
use MF\Controller\Action;
use MF\Model\Container;

class SchedulingController extends Action {
	protected $info;

	public function __construct(){
		parent::__construct();

		$this->info['website'] = Container::getModel('WebSite');
	}

	public function checkAuth(){
		session_start();
		$result = 0;

		if(isset($_SESSION['user'])) if($_SESSION['user']['level'] ) $result = $_SESSION['user']['level']; 

		return $result;
	}

    public function service(){
		if( $this->checkAuth() ){
			
			$service = Container::getModel('service');
			
			$result = $service->getAll();

			$result = is_array($result) ? $result : [];

			echo json_encode($result);
		}
    }


	public function dayActive(){
		if( $this->checkAuth() ){

			$dayActive = Container::getModel('dayActive');
			$holiday = Container::getModel('holiday');

			$h = $holiday->getAllFormated();



			$da = $dayActive->getAllDay();

			if(is_array($da) ){
				
				// print_r($da);

				$days = array();
				for ($i = 0; $i < count($da); $i++) {
					// echo $da[$i]["day"];
					array_push($days, $da[$i]["day"]);
				}
				// print_r($days);
				// $new_da= $days;

			}

			$result = [];

			array_push($result, $days);
			array_push($result, $h);


			// $result= $h;
			

			echo json_encode($result);

			
			// $dayActive = Container::getModel('dayActive');
			
			
			// $result = $dayActive->getAllDay();

			// if(is_array($result) ){
				
			// 	// print_r($result);

			// 	// print_r($result);
			// 	$days = array();
			// 	for ($i = 0; $i < count($result); $i++) {
			// 		array_push($days, $result[$i]["day"]);
			// 	}
			// 	// print_r($days); // Output: Array ( [0] => 1 [1] => 4 [2] => 7 )

			// 	$result= $days;

			// }

			// $result = is_array($result) ? $result : [];

			// echo json_encode($result);
		}
    }

	public function dataOff(){
		if( $this->checkAuth() ){
			
			$dayActive = Container::getModel('dayActive');
			
			$result = $dayActive->getAllDay();

			if(is_array($result) ){
				
				// print_r($result);

				// print_r($result);
				$days = array();
				for ($i = 0; $i < count($result); $i++) {
					array_push($days, $result[$i]["day"]);
				}
				// print_r($days); // Output: Array ( [0] => 1 [1] => 4 [2] => 7 )

				$result= $days;

			}

			$result = is_array($result) ? $result : [];

			echo json_encode($result);
		}

		// if( $this->checkAuth() ){
		// 	$result = [];
			
		// 	$dayActive = Container::getModel('dayActive');
		// 	$holiday = Container::getModel('holiday');
		// 	$holiday->__set("fk_employee", 1);
			
		// 	$dayOff = $dayActive->getAllDay();
		// 	$holidayFormated = $holiday->getAllFormated();

		// 	if( is_array($dayOff) ){
		// 		$days = array();
		// 		for ($i = 0; $i < count($dayOff); $i++) array_push($days, $dayOff[$i]["day"]);
		// 		// $dayOff= $days;
		// 		$result['day'] = $days;
		// 	}

		// 	if( is_array($holidayFormated) ){
		// 		$holiday = array();
		// 		for ($i = 0; $i < count($holidayFormated); $i++) array_push( $holiday,  $holidayFormated[$i]['date'] );
		// 		$result['holiday'] = $holiday;
		// 	}

		// 	// Define o cabeçalho Content-Type para application/json
		// 	header('Content-Type: application/json');

		// 	echo json_encode([]);
		// }
    }

	public function time(){
		if( $this->checkAuth() ){
			
			$result = [];
			$date = isset($_GET['date']) ? $_GET['date'] : "00-00-0000" ;

			$timestamp = strtotime( str_replace( "-", "/", $date) );
			$day = date("w", $timestamp) + 1;


			$timeActive = Container::getModel('timeActive');
			$timeActive->__set("fk_day", $day);
			$timeActive->__set("fk_employee", 1);
			$allDay = $timeActive->getTimeByDay() ;


			$scheduling = Container::getModel('scheduling');
			$scheduling->__set("start", date_create_from_format('m-d-Y', $date)->format('Y-m-d') );

			$allTimeSche = $scheduling->getAllAgendandados();

			$time = Container::getModel('time');


			$freeTimes = array();

			for ($i = 0; $i < count($allDay); $i++) {
				$isScheduled = false;
				for ($j = 0; $j < count($allTimeSche); $j+=2) {
					$start = strtotime($allTimeSche[$j]);
					$end = strtotime($allTimeSche[$j+1]);
					$currentTime = strtotime($allDay[$i]);
					if ($currentTime >= $start && $currentTime < $end) {
						$isScheduled = true;
						break;
					}
				}
				if (!$isScheduled) {
					array_push($freeTimes, $allDay[$i]);
				}
			}
			
			$arr = [];
			foreach ($freeTimes as $id => $t) {
				$time->__set('time', $t);
				$value = $time->getIdByTime()['id'];
				// echo $value;
				$arr= [
					'name' => $t,
					'value' => $value
				];

				array_push($result, $arr);
	
			}
	
			// echo json_encode($freeTimes);
			echo json_encode($result);


		}

	
    }



	// public function dayActive(){
	// 	if( $this->checkAuth() ){
			
	// 		$dayActive = Container::getModel('dayActive');
			
	// 		$result = $dayActive->getAllDay();

	// 		if(is_array($result) ){
				
	// 			// print_r($result);

	// 			// print_r($result);
	// 			$days = array();
	// 			for ($i = 0; $i < count($result); $i++) {
	// 				array_push($days, $result[$i]["day"]);
	// 			}
	// 			// print_r($days); // Output: Array ( [0] => 1 [1] => 4 [2] => 7 )

	// 			$result= $days;

	// 		}

	// 		$result = is_array($result) ? $result : [];

	// 		echo json_encode($result);
	// 	}
    // }


}