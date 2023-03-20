<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap
{

	protected function initRoutes()
	{
		// index
		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['scheduling'] = array(
			'route' => '/scheduling/',
			'controller' => 'indexController',
			'action' => 'scheduling'
		);

		$routes['pageNotFound'] = array(
			'route' => '/pageNotFound/',
			'controller' => 'indexController',
			'action' => 'pageNotFound'
		);

		$routes['/scheduling/service'] = array(
			'route' => '/scheduling/service/',
			'controller' => 'schedulingController',
			'action' => 'service'
		);

		$routes['/scheduling/day_active'] = array(
			'route' => '/scheduling/day_active/',
			'controller' => 'schedulingController',
			'action' => 'dayActive'
		);

		$routes['/scheduling/data_off'] = array(
			'route' => '/scheduling/data_off/',
			'controller' => 'schedulingController',
			'action' => 'dataOff'
		);

		$routes['/scheduling/time'] = array(
			'route' => '/scheduling/time/',
			'controller' => 'schedulingController',
			'action' => 'time'
		);

		$routes['/scheduling/create_scheduling/'] = array(
			'route' => '/scheduling/create_scheduling/',
			'controller' => 'schedulingController',
			'action' => 'createScheduling'
		);

		// Admin

		$routes['login'] = array(
			'route' => '/login/',
			'controller' => 'adminController',
			'action' => 'login'
		);

		$routes['authenticate'] = array(
			'route' => '/auth/',
			'controller' => 'authController',
			'action' => 'authenticate',
		);

		$routes['register'] = array(
			'route' => '/register/',
			'controller' => 'adminController',
			'action' => 'register'
		);

		$routes['checkRegister'] = array(
			'route' => '/checkRegister/',
			'controller' => 'authController',
			'action' => 'checkRegister',
		);

		$routes['admin'] = array(
			'route' => '/admin/',
			'controller' => 'adminController',
			'action' => 'index'
		);

		$routes['admin/myprofile'] = array(
			'route' => '/admin/myprofile/',
			'controller' => 'adminController',
			'action' => 'myProfile'
		);

		$routes['logout'] = array(
			'route' => '/logout/',
			'controller' => 'adminController',
			'action' => 'logout',
		);

		// Funcionário

		$routes['admin/scheduling'] = array(
			'route' => '/admin/scheduling/',
			'controller' => 'adminController',
			'action' => 'scheduling'
		);


		$routes['admin/holiday'] = array(
			'route' => '/admin/holiday/',
			'controller' => 'adminController',
			'action' => 'holiday'
		);

		$routes['admin/service'] = array(
			'route' => '/admin/service/',
			'controller' => 'adminController',
			'action' => 'service'
		);

		$routes['admin/dayactive'] = array(
			'route' => '/admin/dayactive/',
			'controller' => 'adminController',
			'action' => 'dayActive'
		);

		$routes['admin/timeactive'] = array(
			'route' => '/admin/timeactive/',
			'controller' => 'adminController',
			'action' => 'timeActive'
		);

		$routes['admin/clients'] = array(
			'route' => '/admin/clients/',
			'controller' => 'adminController',
			'action' => 'clients'
		);

		$routes['admin/config'] = array(
			'route' => '/admin/config/',
			'controller' => 'adminController',
			'action' => 'config'
		);

		// Cliente

		$routes['admin/myschedules'] = array(
			'route' => '/admin/myschedules/',
			'controller' => 'adminController',
			'action' => 'mySchedules'
		);



		# GETs JSON INFO
		// SCHEDULING
		$routes['admin/infoOfScheduling'] = array(
			'route' => '/admin/infoOfScheduling/',
			'controller' => 'adminController',
			'action' => 'infoOfScheduling'
		);
		// HOLIDAY
		$routes['admin/infoOfHoliday'] = array(
			'route' => '/admin/infoOfHoliday/',
			'controller' => 'adminController',
			'action' => 'infoOfHoliday'
		);
		// SERVICE
		$routes['admin/infoOfService'] = array(
			'route' => '/admin/infoOfService/',
			'controller' => 'adminController',
			'action' => 'infoOfService'
		);
		// DAY ACTIVE
		$routes['admin/infoOfDaysActive'] = array(
			'route' => '/admin/infoOfDaysActive/',
			'controller' => 'adminController',
			'action' => 'infoOfDaysActive'
		);

		// TIME ACTIVE
		$routes['admin/infoOfTimeActive'] = array(
			'route' => '/admin/infoOfTimeActive/',
			'controller' => 'adminController',
			'action' => 'infoOfTimeActive'
		);

		# CREATE
		// ADD SCHEDULING
		$routes['admin/createHoliday'] = array(
			'route' => '/admin/createHoliday/',
			'controller' => 'adminController',
			'action' => 'createHoliday'
		);
		// ADD SERVICE
		$routes['admin/createService'] = array(
			'route' => '/admin/createService/',
			'controller' => 'adminController',
			'action' => 'createService'
		);


		# Edit
		// Edit info of user
		$routes['admin/editInfoUser'] = array(
			'route' => '/admin/editInfoUser/',
			'controller' => 'adminController',
			'action' => 'editInfoUser'
		);
		// Edit info of user
		$routes['admin/editHoliday'] = array(
			'route' => '/admin/editHoliday/',
			'controller' => 'adminController',
			'action' => 'editHoliday'
		);
		// Edit info of SERVICE
		$routes['admin/editService'] = array(
			'route' => '/admin/editService/',
			'controller' => 'adminController',
			'action' => 'editService'
		);

		// Edit info of DAY ACTIVE
		$routes['admin/editDaysActive'] = array(
			'route' => '/admin/editDaysActive/',
			'controller' => 'adminController',
			'action' => 'editDaysActive'
		);

		// Edit info of TIME Active
		$routes['admin/editTimeActive'] = array(
			'route' => '/admin/editTimeActive/',
			'controller' => 'adminController',
			'action' => 'editTimeActive'
		);

		// Edit info of TIME Active
		$routes['admin/editConfig'] = array(
			'route' => '/admin/editConfig/',
			'controller' => 'adminController',
			'action' => 'editConfig'
		);

		# DELETES
		// DELETE SCHEDULING
		$routes['admin/deleteScheduling'] = array(
			'route' => '/admin/deleteScheduling/',
			'controller' => 'adminController',
			'action' => 'deleteScheduling'
		);

		// DELETE HOLIDAY
		$routes['admin/deleteHoliday'] = array(
			'route' => '/admin/deleteHoliday/',
			'controller' => 'adminController',
			'action' => 'deleteHoliday'
		);

		// DELETE SERVICE
		$routes['admin/deleteService'] = array(
			'route' => '/admin/deleteService/',
			'controller' => 'adminController',
			'action' => 'deleteService'
		);


		$this->setRoutes($routes);
	}
}
