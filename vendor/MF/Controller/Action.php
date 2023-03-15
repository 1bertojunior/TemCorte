<?php

namespace MF\Controller;

abstract class Action {

	protected $info;
	protected $view;
    protected $pathPrivate;
	
	public function __construct() {
		$this->info = [];
		$this->view = new \stdClass();
		$this->pathPrivate = "../";
	}

	protected function render( $info = []) {
		$view = $info['view'];

		if(is_array($view)){ // checking if array view is empty!
			if(array_key_exists("view", $view)){
				if(!empty($view['view'])){
					$this->view->page = $view["view"];
					
					// Config infos
					$this->view->info = $info;
					// $header = $info['header'];

					// set level user if is logged
					if(array_key_exists('user',$this->view->info['website'] )) $this->view->info['website']['menu']['level'] = $this->view->info['website']['user']['level'];
					
					// Config path 
					$layout = $view['layout'] ?? "layout_default";
					$path = $this->pathPrivate . "App/Views/" . $layout .".php";

					if(file_exists($path)) {
						require_once $path;
					} else {
						echo "[!] Erro ao carregar o layout! <br>";
						// $this->content();
					}
					
				} else echo "[!] - View não encontrada! <br>";
			} else echo "[!] - Index view não existe no array view! <br>";
		} else echo "[!] - Erro ao tentar carregar view! <br>";	
	}

	// protected function render($view, $layout = 'layout1', $title = 'Title', $previous = false) {
	// 	$this->view->page = $view;
	// 	$this->view->title = $title;
		
	// 	$path = $this->pathPrivate . "App/Views/".$layout.".php";

	// 	if(file_exists($path)) {
	// 		$this->view->previous = $previous ? '../' : '';
	// 		require_once $path;
	// 	} else {
	// 	    echo "[!] Erro ao carregar o layout! <br>";
	// 		// $this->content();
	// 	}
	// }

	protected function content($info = []) {
		$classAtual = get_class($this);
		$classAtual = str_replace('App\\Controllers\\', '', $classAtual);
		$classAtual = strtolower(str_replace('Controller', '', $classAtual));
		
		$path =  $this->pathPrivate . "App/Views/".$classAtual."/".$this->view->page.".php";
	
		if(file_exists(	$path)) {
		    require_once $path;
		}else{
		    echo "[!] Erro ao carregar view do miniframework! <br>";
		}

	}
}

?>