<?php

namespace App\Controllers;

//os recursos do agendou
use App\Models\agendamento;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {
	protected $info;

	public function __construct(){
		parent::__construct();

		$this->info['website'] = Container::getModel('WebSite');
	}

	public function index(){ // Screen index home

		$website = $this->info['website'];
		$website_data =  $website->getData();
		$website_address =  $website->getAddress();
		$website_social =  $website->getSocial();

		// echo "<pre>";
		// print_r($website_data);

		$view = [
			"view" => "index",
			"layout" => "layout_default",

		];

		$header =  [
			"title_page" => "Home",
			"subtitle_page" => $website_data["name"],
			"description" => $website_data["description"],
			"author" => "@1Berto_Júnior",
			"previous" => false
		];
		
		$footer = [
			"name" => $website_data["name"],
			"year" => date('Y'),
			"rights" => "Todos os direitos reservados"
		];

		$info = [
			"view" => $view,
			"header" => $header,

			"website" => [
				"info" => $website_data,
				"address" => $website_address,
				"social" => $website_social
			],

			"footer" => $footer,
			
		];

		// Rendering to screen
		$this->render($info);
	}

	public function pageNotFound(){ // Screen 404


		$view = [
			"view" => "404",
			"layout" => "layout_default",

		];
	
		$infos = [
			"title_page" => "404",
			"description" => "description",
			"author" => "author",
			"previous" => false
		];

		// Rendering to screen
		$this->render($view, $infos);
	}

	public function scheduling(){ // Screen index of admin

		$view = [
			"view" => "scheduling",
			"layout" => "layout_default",

		];
		
		$now =  date("Y-m-d h:i:s");

		$infos = [
			"title_page" => "Agendamento online",
			"description" => "description",
			"author" => "author",
			"previous" => false
		];

		// Gerando token (faltar implementar)
		$this->infos["token"] = MD5($now);
		// echo $infos["token"];

		// Rendering to screen
		$this->render($view, $infos);
	}
	

	public function scheduling_city(){
		$scheduling = Container::getModel('Scheduling');
		$scheduling->getCities();
	}

	public function scheduling_service(){
		$scheduling = Container::getModel('Scheduling');
		$scheduling->getService();
	}

	public function scheduling_day_by_city_and_employee(){

		$city = $_GET['city'] ?? null;
		$employee = $_GET['employee'] ?? null;

		$scheduling = Container::getModel('Scheduling');
		$scheduling->getDayByBityAndEmployee($city, $employee);
		// $scheduling->getDayByBityAndEmployee();
	}

}
