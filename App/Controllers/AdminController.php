<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AdminController extends Action {
	// protected $info;

	public function __construct(){
		parent::__construct();

		$this->info['website'] = Container::getModel('WebSite');
	}

	public function login(){
		if( $this->checkAuth() ) header ("Location: /admin");

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$website = $this->info['website'];
		$website_data =  $website->getData();

		$view = [
			"view" => "login",
			"layout" => "layout_login_register",
		];

		$header =  [
			"title_page" => "Login",
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
				"login" => isset($_GET['login']) ? $_GET['login'] : '',
				"info" => $website_data
			],

			"footer" => $footer,
			
		];

		// Rendering to screen
		$this->render($info);
	}

	public function register(){
		$this->view->erroRegistration = isset($_GET['register']) ? $_GET['register'] : '';
		// echo "<br>Erro: " . isset($_GET['register']);
		// if(isset($_GET['register']))
		// echo "<br>erro: " . $_GET['register'];
		// isset($_GET['login']) ? $_GET['login'] : '';

		$website = $this->info['website'];
		$website_data =  $website->getData();

		$view = [
			"view" => "register",
			"layout" => "layout_login_register",
		];

		$header =  [
			"title_page" => "Criar conta",
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
				"info" => $website_data
			],

			"footer" => $footer,
			
		];

		// Rendering to screen
		$this->render($info);
	}

	public function checkAuth(){
		session_start();
		$result = 0;

		if(isset($_SESSION['user'])) if($_SESSION['user']['level'] ) $result = $_SESSION['user']['level']; 

		return $result;
	}

	public function logout(){
		session_start();
		session_destroy();
		header("Location: /");
	}

	public function index(){ // Screen index home
		
		$level = $this->checkAuth();

		if( $level ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			// echo "<pre>";
			// print_r($_SESSION['user']);
			// echo "</pre>";

			if( $level == 1 ){
				$scheduling = Container::getModel('scheduling');
				$scheduling->__set("fk_employee", $user->__get("id"));

				$service = Container::getModel('service');
				$percSerByUser = $service->getPercServiceByEmployee($user->__get("id"));

			} else if ( $level == 3 ){
				$scheduling = Container::getModel('scheduling');
				$scheduling->__set("fk_client", $user->__get("id"));

				$service = Container::getModel('service');
				// $service->__set("fk_employee", $user->__get("id"));
				$percSerByUser = $service->getPercServiceByUser($user->__get("id"));
				
			}


			$view = [
				"view" => "index",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Dashbord",
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

			if( $level == 1){
				$day =$scheduling->getSchedulingDayByEmployee();
				$month = $scheduling->getSchedulingByMonthByEmployee();
				$perService = $percSerByUser;
			}else if( $level == 3){
				$day =$scheduling->getSchedulingDayByClient();
				$month = $scheduling->getSchedulingByMonthByClient();
				$perService = $percSerByUser;
			}
	
			$info = [
				"view" => $view,
				"header" => $header,
	
				"website" => [
					"info" => $website_data,
					"user" => $_SESSION['user'],
					"scheduling" => [
						"day" => $day,
						"month" => $month
					],
					"perService" => $perService

				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);


			// Rendering to screen
			$this->render($info);



		}else header('Location: /login?login=erro');


	}

	// Cliente
	public function myProfile(){
		if( $this->checkAuth() ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			// Update


			$view = [
				"view" => "my_profile",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Meu perfil",
				"subtitle_page" => $website_data["name"],
				"description" => $website_data["description"],
				"author" => "@1Berto_Júnior",
				"previous" => true
			];
			
			$footer = [
				"name" => $website_data["name"],
				"year" => date('Y'),
				"rights" => "Todos os direitos reservados"
			];
			
			// print_r($_GET);
			// echo isset($_GET['update']);

			$info = [
				"view" => $view,
				"header" => $header,
	
				"website" => [
					"info" => $website_data,
					"user" => $user->get(),
					"update" => [
						"user" => (isset($_GET['update']) ? $_GET['update'] : 0 )
					]
				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);


			// Rendering to screen
			$this->render($info);



		}else header('Location: /login?login=erro');
	}

	public function mySchedules(){
		if( $this->checkAuth() ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			$scheduling = Container::getModel('scheduling');
			$scheduling->__set("fk_client", $user->__get("id"));

			$nextSchedules = $scheduling->getNextByUser();
			$latestSchedules = $scheduling->getLatestByUser();

			$view = [
				"view" => "my_schedules",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Meus agendamentos",
				"subtitle_page" => $website_data["name"],
				"description" => $website_data["description"],
				"author" => "@1Berto_Júnior",
				"previous" => true
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
					"user" => $user->get(),
					"next_schedules" => $nextSchedules,
					"latest_schedules" => $latestSchedules,
					"remove" => [
						"scheduling" => (isset($_GET['remove']) ? $_GET['remove'] : 0 )
					]
				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);

			// Rendering to screen
			$this->render($info);



		}else header('Location: /login?login=erro');
	}

	// Funcionário
	public function scheduling(){
		if( $this->checkAuth() ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			$scheduling = Container::getModel('scheduling');
			$scheduling->__set("fk_employee", $user->__get("id"));		

			$view = [
				"view" => "scheduling",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Agendamentos",
				"subtitle_page" => $website_data["name"],
				"description" => $website_data["description"],
				"author" => "@1Berto_Júnior",
				"previous" => true
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
					"user" => $user->get(),
					"scheduling_day" => $scheduling->getTodayEmployee(),
					"scheduling_7days" => $scheduling->getNext7DaysByEmployee(),
					"scheduling_month" => $scheduling->getMonthByEmployee(),
					"remove" => [
						"scheduling" => (isset($_GET['remove']) ? $_GET['remove'] : 0 )
					]
				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);

			// Rendering to screen
			$this->render($info);



		}else header('Location: /login?login=erro');
	}

	public function holiday(){
		if( $this->checkAuth() ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			$holiday = Container::getModel('holiday');
			$holiday->__set("fk_employee", $user->__get("id"));

			// echo "id ". $holiday->__get("fk_employee");


			// $scheduling = Container::getModel('scheduling');
			// $scheduling->__set("fk_client", $user->__get("id"));		

			$view = [
				"view" => "holiday",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Feriados",
				"subtitle_page" => $website_data["name"],
				"description" => $website_data["description"],
				"author" => "@1Berto_Júnior",
				"previous" => true
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
					"user" => $user->get(),
					"holiday_year" => $holiday->getAll(),
					"holiday_permanent" => $holiday->getPermanent(),
					"holiday_next" => $holiday->getNext(),
					"created" => [
						"holiday" => (isset($_GET['created']) ? $_GET['created'] : 0 )
					],
					"update" => [
						"holiday" => (isset($_GET['update']) ? $_GET['update'] : 0 )
					],
					"remove" => [
						"holiday" => (isset($_GET['remove']) ? $_GET['remove'] : 0 )
					]
				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);

			// Rendering to screen
			$this->render($info);



		}else header('Location: /login?login=erro');
	}

	public function service(){
		if( $this->checkAuth() ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			$service = Container::getModel('service');
			$service->__set("fk_employee", $user->__get("id"));

			$view = [
				"view" => "service",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Serviços",
				"subtitle_page" => $website_data["name"],
				"description" => $website_data["description"],
				"author" => "@1Berto_Júnior",
				"previous" => true
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
					"user" => $user->get(),
					"service_all" => $service->getAll(),
					"created" => [
						"service" => (isset($_GET['created']) ? $_GET['created'] : 0 )
					],
					"update" => [
						"service" => (isset($_GET['update']) ? $_GET['update'] : 0 )
					],
					"remove" => [
						"service" => (isset($_GET['remove']) ? $_GET['remove'] : 0 )
					]
				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);

			// Rendering to screen
			$this->render($info);



		}else header('Location: /login?login=erro');
	}

	public function dayActive(){
		if( $this->checkAuth() ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			$day_active = Container::getModel('DayActive');
			$day_active->__set("fk_employee", $user->__get("id"));


			$view = [
				"view" => "day_active",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Dias ativos",
				"subtitle_page" => $website_data["name"],
				"description" => $website_data["description"],
				"author" => "@1Berto_Júnior",
				"previous" => true
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
					"user" => $user->get(),
					"day_active" => $day_active->getAll(),
					"update" => [
						"dayActive" => (isset($_GET['update']) ? $_GET['update'] : 0 )
					]
				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);

			// Rendering to screen
			$this->render($info);
		}else header('Location: /login?login=erro');
	}

	public function timeActive(){
		if( $this->checkAuth() ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			$day = Container::getModel('day');


			// $time_active = Container::getModel('timeActive');
			// $time_active->__set("fk_employee", $user->__get("id"));

			$view = [
				"view" => "time_active",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Horários ativos",
				"subtitle_page" => $website_data["name"],
				"description" => $website_data["description"],
				"author" => "@1Berto_Júnior",
				"previous" => true
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
					"user" => $user->get(),
					"days" => $day->getAll(),
					"update" => [
						"timeActive" => (isset($_GET['update']) ? $_GET['update'] : 0 )
					]
					// "time_active" => $time_active->getAll(),
				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);

			// Rendering to screen
			$this->render($info);



		}else header('Location: /login?login=erro');
	}

	public function clients(){
		if( $this->checkAuth() ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			$clients = Container::getModel('user');
			$clients->__set("fk_level", 3);

			$view = [
				"view" => "clients",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Clientes",
				"subtitle_page" => $website_data["name"],
				"description" => $website_data["description"],
				"author" => "@1Berto_Júnior",
				"previous" => true
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
					"user" => $user->get(),
					"clients" => $clients->getAllClients(),
				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);

			// Rendering to screen
			$this->render($info);



		}else header('Location: /login?login=erro');
	}

	public function config(){
		if( $this->checkAuth() ){
			$website = $this->info['website'];
			$website_data =  $website->getData();

			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			// $website = Container::getModel('website');
			// $clients->__set("fk_level", 3);

			$view = [
				"view" => "config",
				"layout" => "layout_admin",
			];
	
			$header =  [
				"title_page" => "Configurações",
				"subtitle_page" => $website_data["name"],
				"description" => $website_data["description"],
				"author" => "@1Berto_Júnior",
				"previous" => true
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
					"user" => $user->get(),
					"website" => $website_data,
					"update" => [
						"config" => (isset($_GET['update']) ? $_GET['update'] : 0 )
					]
				],
	
				"footer" => $footer,
				
			];

			// echo "<pre>";
			// print_r( $info['website']['user']);

			// Rendering to screen
			$this->render($info);



		}else header('Location: /login?login=erro');
	}


	# GET (INFO)
	// INFO SCHEDULING
	public function infoOfScheduling(){
		
		if( $this->checkAuth() ){
			$user = Container::getModel('user');
			$user->init($_SESSION['user']);

			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$id = (is_numeric($id) && intval($id) > 0) ? $id : 0;
			// echo "ID: " . $id;
			$scheduling = Container::getModel('scheduling');
			$scheduling->__set("id", $id); // $user->__get("id")

			$result = $scheduling->get();
			$result = is_array($result) ? $result : [];

			echo json_encode($result);

		}else header ("Location: /admin");

	}

	// INFO HOLIDAY
	public function infoOfHoliday(){
		
		if( $this->checkAuth() == 1 ){
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$id = (is_numeric($id) && intval($id) > 0) ? $id : 0;
			// echo "ID: " . $id;

			$holiday = Container::getModel('holiday');
			$holiday->__set("id", $id);

			$result = $holiday->get();
			$result = is_array($result) ? $result : [];

			echo json_encode($result);

		}else header ("Location: /admin");

	}

	// INFO SERVICE
	public function infoOfService(){
		if( $this->checkAuth() == 1 ){
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$id = (is_numeric($id) && intval($id) > 0) ? $id : 0;
			// echo "ID: " . $id;

			$service = Container::getModel('service');
			$service->__set("id", $id);

			$result = $service->get();
			$result = is_array($result) ? $result : [];

			echo json_encode($result);

		}else header ("Location: /admin");
	}

	// DAYS ACTIVES
	public function infoOfDaysActive(){
		if( $this->checkAuth() == 1 ){
			$user = Container::getModel('user');
			$user->init($_SESSION['user']);
			// print_r($user->__get("id"));

			$fk_day = isset($_GET['fk_day']) ? $_GET['fk_day'] : 0;
			$fk_day = (is_numeric($fk_day) && intval($fk_day) > 0) ? $fk_day : 0;
			// echo "FK_DAY: " . $fk_day;

			$dayActive = Container::getModel('dayActive');
			$dayActive->__set("fk_day", $fk_day);
			$dayActive->__set("fk_employee", $user->__get("id"));

			$result = $dayActive->get();
			$result = is_array($result) ? $result : [];

			echo json_encode($result);

		}else header ("Location: /admin");
		
	}

	// DAYS ACTIVES
	public function infoOfTimeActive(){
		if( $this->checkAuth() == 1 ){
			
			$user = Container::getModel('user');
			$timeActive = Container::getModel('timeActive');

			$result = [];
			$user->init($_SESSION['user']);
			
			$fk_day = isset($_GET['fk_day']) ? $_GET['fk_day'] : 0;
			$fk_day = (is_numeric($fk_day) && intval($fk_day) > 0) ? $fk_day : 0;

			if($fk_day){
				$timeActive->__set("fk_employee", $user->__get("id"));
				$timeActive->__set("fk_day", $fk_day);

				$result = $timeActive->get();
				$result = is_array($result) ? $result : [];
			}

			echo json_encode($result);

		}else header ("Location: /admin");
		
	}

	# CREATE
	// CREATE HOLIDAY
	public function createHoliday(){
		if( $this->checkAuth() == 1 ){
			$data = $_POST;
			$result = 0;
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";

			if( isset($data['name']) || isset($data['date']) ){
				if(  !empty($data['name']) && !empty($data['date']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['date']) ){
					$holiday = Container::getModel("holiday");
					$holiday->__set("name",  $data['name']);
					$holiday->__set("date",  $data['date']);
					$holiday->__set("permanent",  isset($data['repeat']) ? 1 : 0 );
				
					$result = $holiday->create();					
				} 				
			}

			$url = "Location: /admin/holiday?created=";
			$par = $result ? "true" : "false";			
			header ($url . $par);
		}else header ("Location: /admin");		
	}

	// CREATE SERVICE
	public function createService(){
		if( $this->checkAuth() == 1 ){
			$data = $_POST;
			$result = 0;

			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";


			if( isset($data['name']) || isset($data['duration']) ){
				if(  !empty($data['name']) && preg_match("/^([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $data['duration'])){
					$service = Container::getModel("service");
					$service->__set("name",  $data['name']);
					$service->__set("duration",  $data['duration']);

					$result = $service->created();
				}
			}

			$url = "Location: /admin/service?created=";
			$par = $result ? "true" : "false";			
			header ($url . $par);
		}else header ("Location: /admin");

	}

	# UPDATE
	public function editInfoUser(){

		if( $this->checkAuth() ){

			if( !empty($_POST) ){
				$data  = $_POST;
				
				$dataUser = $_SESSION['user'];
				$user = Container::getModel('user');

				$user->__set("id", $dataUser['id']);
				$user->__set("email", ($data['email']) ? $data['email'] : "" );
				$user->__set("name", $data['name']);
				$user->__set("surname", $data['surname']);
				$user->__set("email", $data['email']);								
				$user->__set("cpf", preg_replace('/\D/', '', $data['cpf']));								
				$user->__set("fk_address", $dataUser['address']);								
				

				if( $data['street'] != "Rua" || $data['num'] != "0" || $data['neighborhood'] != "Bairro"){
					echo "Diferente";
					$address = Container::getModel('address');
					
					$address->__set("street",  $data['street'] != "Rua" ? $data['street'] : "");
					$address->__set("num",  $data['num'] != "0" ? $data['num'] : 0);
					$address->__set("neighborhood",  $data['neighborhood'] != "Bairro" ? $data['neighborhood'] : "");

					if( $user->__get("fk_address") == 1){
						$idAddress = $address->register();	
						$user->__set("fk_address", $idAddress);								
					} else {
						$address->__set("id",  $user->__get("fk_address"));
						$idAddress = $address->update();
					}

				}

				$result = $user->update();
				$user->getInfoUser();

				// if($result == 1) header ("Location: /admin/myprofile?update=true");
				// else header ("Location: /admin/myprofile?update=false");

				$url = "Location: /admin/myprofile?update=";

				$par = $result == 1 ? "true" : "false";			

				header ($url . $par);
				
			}else header ("Location: /admin/myprofile");

		
		}else header ("Location: /admin");

	} 

	public function editHoliday(){

		if( $this->checkAuth() == 1){

			if( !empty($_POST) ){
				$data  = $_POST;

				// echo "<pre>";
				// print_r($data);	
				// echo "</pre>";
				
				// echo isset($data['repeat']) ? "1" : "0" ;
				
				$holiday = Container::getModel('holiday');

				$holiday->__set("id", $data['id']);
				$holiday->__set("name", $data['name']);
				$holiday->__set("date", $data['date']);
				$holiday->__set("permanent", isset($data['repeat']) ? "1" : "0" );

				$result = $holiday->update();
				// echo "Resultado: " . $result;
				$url = "Location: /admin/holiday?update=";
				$par = $result == 1 ? "true" : "false";			
				header ($url . $par);
				
			}else header ("Location: /admin/myprofile");

		
		}else header ("Location: /admin");

	}
	// SERVICE
	public function editService(){

		if( $this->checkAuth() == 1){

			if( !empty($_POST) ){
				$data  = $_POST;

				// echo "<pre>";
				// print_r($data);	
				// echo "</pre>";
								
				$service = Container::getModel('service');

				$service->__set("id", $data['id']);
				$service->__set("name", $data['name']);
				$service->__set("duration", $data['duration']);
				
				$result = $service->update();
				// echo "Resultado: " . $result;
				$url = "Location: /admin/service?update=";
				$par = $result == 1 ? "true" : "false";			
				header ($url . $par);
				
			}else header ("Location: /admin/myprofile");

		
		}else header ("Location: /admin");

	}

	// DAY ACTIVE
	public function editDaysActive(){

		if( $this->checkAuth() == 1){
			
			$result = 0;

			if( !empty($_POST) ){
				$data  = $_POST;

				// echo "<pre>";
				// print_r($data);	
				// echo "</pre>";

				if( is_array($data) ){
					if( isset($data['id']) ){
						
						$dayActive = Container::getModel('dayActive');
						$dayActive->__set("id", $data['id']);
						$dayActive->__set("status", isset($data['status']) ? 1 : 0 );						

						$result = $dayActive->update();						

					}
				}

				// echo "Result: " . $result;

				$url = "Location: /admin/dayactive?update=";
				$par = $result ? "true" : "false";			
				header ($url . $par);
				
			}else header ("Location: /admin");

		
		}else header ("Location: /admin");

	}

	// TIME ACTIVE
	public function editTimeActive(){

		if( $this->checkAuth() == 1){
			
			$result = 0;

			if( !empty($_POST) ){
				$data  = $_POST;

				// echo "<pre>";
				// print_r($data);	
				// echo "</pre>";

				if( is_array($data) ){
					if( isset($data['fk_day']) ){
												
						$user = Container::getModel('user');
						$timeActive = Container::getModel('timeActive');
						
						$user->init($_SESSION['user']);
						$timeActive->__set("fk_day", isset($data['fk_day']) ? $data['fk_day'] : 0);
						$timeActive->__set("fk_employee", $user->__get('id'));
						
						$start_am = isset($data['start_am']) ? $data['start_am'] : 0 ;
						$start_pm = isset($data['start_pm']) ? $data['start_pm'] : 0 ;
						$end_am = isset($data['end_am']) ? $data['end_am'] : 0 ;
						$end_pm = isset($data['end_pm']) ? $data['end_pm'] : 0 ;

						// Firts and Last AM

						$amFirstAndLastTimeActive = $timeActive->getFirstAndLastTimeActiveAM();
						$pmFirstAndLastTimeActive = $timeActive->getFirstAndLastTimeActivePM();

						// echo "S POST (" . $start_am . ") API (" . $amFirstAndLastTimeActive['start']['fk_time'] . ") <br>";
						// echo "E POST (" . $end_am . ") API (" . $amFirstAndLastTimeActive['end']['fk_time'] . ") <br>";
						// echo "<br>";
						

						// START
						if( $start_am ){ // (ativou) se start for difernete de zero
							// echo "ativar<br>";

							if( $end_am ){
								
								// verificar se não são iguais
								if( $start_am == $end_am){
									// echo "<br> iguais" ;

									$timeActive->__set("status", 1);
									$timeActive->__set("fk_time", $start_am);
									$result = $timeActive->update();

									// echo  "<br>start: " . $start_am;
									// echo "<br>start: " . $start_am+1;
									// echo "<br>ends: " . $end_am-1;
									

									if( $start_am > 15 ){
										// desativando os horários até o inicio do atual
										$timeActive->__set("status", 0);
										$timeActive->__set("start_am", 15);
										$timeActive->__set("end_am", $start_am-1);
										$result = $timeActive->updateAllByDay();
									}

									if( $start_am < 25 ){
										// desativando os horários até o inicio do atual
										$timeActive->__set("status", 0);
										$timeActive->__set("start_am",  $start_am+1);
										$timeActive->__set("end_am", 25);
										$result = $timeActive->updateAllByDay();

										// echo "<br>Result: " . $result;
									}

								}else{
																
									$timeActive->__set("status", 1);
									$timeActive->__set("start_am", $start_am);
									$timeActive->__set("end_am", $end_am);
									$result = $timeActive->updateAllByDay();

									// echo "<br>Result: " . $result;

									if( $start_am > 15 ){
										// desativando os horários até o inicio do atual
										$timeActive->__set("status", 0);
										$timeActive->__set("start_am", 15);
										$timeActive->__set("end_am", $start_am-1);
										$result = $timeActive->updateAllByDay();
										
										// echo "<br>Result: " . $result;
									}

									if( $end_am < 45){
										if( $end_am < 25){
											// desativando os horários do ponto inicial até o inicio do atual
											$timeActive->__set("status", 0);
											$timeActive->__set("start_am", $end_am+1);
											$timeActive->__set("end_am", 25);
											$result = $timeActive->updateAllByDay();

											// echo "<br>Result: " . $result;
										}										
									}
									
									// if( $start_am < $end_am) $result = false;

								}

							}else{
								// echo "teste dia [". $data['fk_day'] . "] time " . $start_am ;
								$timeActive->__set("status", 1);
								$timeActive->__set("fk_time", $start_am);
								$result = $timeActive->update();

								// desativar todos os horários difernetes do ativado

								if( $start_am > 15 ){
									// desativando os horários até o inicio do atual
									$timeActive->__set("status", 0);
									$timeActive->__set("start_am", 15);
									$timeActive->__set("end_am", $start_am-1);
									$result = $timeActive->updateAllByDay();
									
									// echo "<br>Result: " . $result;
								}

								if( $start_am < 25 ){
									// desativando os horários até o inicio do atual
									$timeActive->__set("status", 0);
									$timeActive->__set("start_am",  $start_am+1);
									$timeActive->__set("end_am", 25);
									$result = $timeActive->updateAllByDay();
									
									// echo "<br>Result: " . $result;
								}
								
							}

						}else{ // (desativou) update em todo os os horários pela manhã
							$timeActive->__set("status", 0);
							$timeActive->__set("start_am", 10);
							$timeActive->__set("end_am", 25);
							$result = $timeActive->updateAllByDay();
							
							// echo "<br>Result: " . $result;
							// echo "Desativando todos os horários da manhã = ". $result;
						}


						


						// END
						if( $start_pm ){ // (ativou) se start for difernete de zero
							// echo "ativar<br>";

							if( $end_pm ){
								
								// verificar se não são iguais
								if( $start_pm == $end_pm){
									// echo "<br> iguais" ;

									$timeActive->__set("status", 1);
									$timeActive->__set("fk_time", $start_pm);
									$result = $timeActive->update();

									// echo  "<br>start: " . $start_pm;
									// echo "<br>start: " . $start_pm+1;
									// echo "<br>ends: " . $end_pm-1;
									

									if( $start_pm > 26 ){
										// desativando os horários até o inicio do atual
										$timeActive->__set("status", 0);
										$timeActive->__set("start_am", 26);
										$timeActive->__set("end_am", $start_pm-1);
										$result = $timeActive->updateAllByDay();
									}

									if( $start_pm < 45 ){
										// desativando os horários até o inicio do atual
										$timeActive->__set("status", 0);
										$timeActive->__set("start_am",  $start_pm+1);
										$timeActive->__set("end_am", 45);
										$result = $timeActive->updateAllByDay();

										// echo "<br>Result: " . $result;
									}

								}else{
									// echo "<br>Diferente";
																
									$timeActive->__set("status", 1);
									$timeActive->__set("start_am", $start_pm);
									$timeActive->__set("end_am", $end_pm);
									$result = $timeActive->updateAllByDay();

									// echo "Start: " . $start_pm . " End: " . $end_pm;

									// echo "<br>Result: " . $result;

									if( $start_pm > 26 ){
										// desativando os horários até o inicio do atual
										$timeActive->__set("status", 0);
										$timeActive->__set("start_am", 26);
										$timeActive->__set("end_am", $start_pm-1);
										// $result = $timeActive->updateAllByDay();
										// echo "<br>Start: " . 26 . " End: " . $start_pm-1;
										
										// echo "<br>Result: " . $result;
									}

									if( $end_pm < 45){
										if( $end_pm < 45){
											// desativando os horários do ponto inicial até o inicio do atual
											$timeActive->__set("status", 0);
											$timeActive->__set("start_am", $end_pm+1);
											$timeActive->__set("end_am", 45);
											$result = $timeActive->updateAllByDay();

											// echo "<br>Result: " . $result;
										}										
									}
									
									// if( $start_am < $end_am) $result = false;

								}

							}else{
								// echo "teste dia [". $data['fk_day'] . "] time " . $start_am ;
								$timeActive->__set("status", 1);
								$timeActive->__set("fk_time", $start_pm);
								$result = $timeActive->update();

								// desativar todos os horários difernetes do ativado

								if( $start_pm > 26 ){
									// desativando os horários até o inicio do atual
									$timeActive->__set("status", 0);
									$timeActive->__set("start_am", 26);
									$timeActive->__set("end_am", $start_pm-1);
									$result = $timeActive->updateAllByDay();
									
									// echo "<br>Result: " . $result;
								}

								if( $start_pm < 45 ){
									// desativando os horários até o inicio do atual
									$timeActive->__set("status", 0);
									$timeActive->__set("start_am",  $start_pm+1);
									$timeActive->__set("end_am", 45);
									$result = $timeActive->updateAllByDay();
									
									// echo "<br>Result: " . $result;
								}
								
							}

						}else{ // (desativou) update em todo os os horários pela manhã
							$timeActive->__set("status", 0);
							$timeActive->__set("start_am", 26);
							$timeActive->__set("end_am", 45);
							$result = $timeActive->updateAllByDay();
							
							// echo "<br>Result: " . $result;
							// echo "Desativando todos os horários da tarde = ". $result;
						}

												
					}
				}

				// echo "<br>Result: " . $result;

				$url = "Location: /admin/timeactive?update=";
				$par = $result ? "true" : "false";			
				header ($url . $par);
				
			}else header ("Location: /admin");

		
		}else header ("Location: /admin");

	}

	// DAY ACTIVE
	public function editConfig(){

		if( $this->checkAuth() == 1){
			
			$result = 0;

			if( !empty($_POST) ){
				$data  = $_POST;

				if( is_array($data) ){				
					// echo "<pre>";
					// print_r($data);
					// echo "</pre>";

					// $teste = "+55" . preg_replace("/[^0-9]/", "", $data['phone']);
					// '(##) #####-####', substr($result['phone'],3)
					// echo $teste;
					
					$webSite = Container::getModel('webSite');
					$webSite->__set("name", $data['name']);
					$webSite->__set("description", $data['description']);
					$webSite->__set("email", $data['email']);
					$webSite->__set("phone", ("+55" . preg_replace("/[^0-9]/", "", $data['phone'])) );

					$result = $webSite->update();

					// echo "result: " . $result;				
				}

				// echo "Result: " . $result;

				$url = "Location: /admin/config?update=";
				$par = $result ? "true" : "false";			
				header ($url . $par);
				
			}else header ("Location: /admin");

		
		}else header ("Location: /admin");

	}
	

	# DELETE
	// DELETE SCHEDULING
	public function deleteScheduling(){
		$auth = $this->checkAuth();
		if( $auth ){

			// echo "User: " . $auth;

			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$id = (is_numeric($id) && intval($id) > 0) ? $id : 0;

			$scheduling = Container::getModel('scheduling');
			$scheduling->__set("id", $id);
			// echo "ID: " . $id;
			$result = $scheduling->delete();

			// $url = "Location: /admin/" + ($auth == 1) ? "scheduling" :"myschedules"  +"?remove=";
			$url = "Location: /admin/myschedules?remove=";

			if($auth == 1) $url = "Location: /admin/scheduling?remove=";
			else if($auth == 3) $url = "Location: /admin/myschedules?remove=";

			$par = $result > 0 ? "true" : "false";			
			// echo "URL: " . ($url . $par);
			header ($url . $par);

		}else header ("Location: /admin");
	}
	// DELETE HOLIDAY
	# DELETE
	public function deleteHoliday(){
		$auth = $this->checkAuth();
		if( $auth == 1){
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$id = (is_numeric($id) && intval($id) > 0) ? $id : 0;

			$holiday = Container::getModel('holiday');
			$holiday->__set("id", $id);
			// echo "ID: " . $id;
			$result = $holiday->delete();

			$url = "Location: /admin/holiday?remove=";

			$par = $result > 0 ? "true" : "false";			
			// echo "Result: " . $par;
			header ($url . $par);

		}else header ("Location: /admin");
	}

	# DELETE
	public function deleteService(){
		$auth = $this->checkAuth();
		if( $auth == 1){
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$id = (is_numeric($id) && intval($id) > 0) ? $id : 0;

			$service = Container::getModel('service');
			$service->__set("id", $id);
			// echo "ID: " . $id;
			$result = $service->delete();

			$url = "Location: /admin/service?remove=";

			$par = $result > 0 ? "true" : "false";			
			header ($url . $par);

		}else header ("Location: /admin");
	}




}
