<?php

namespace MF\Model;

use App\Connection;

class Container {

	public static function getModel($model) {
		$pathPrivate = "../";

		$class = "\\App\\Models\\".ucfirst($model);
		$conn = Connection::getDb();

		// $teste = new $class($conn);

		return new $class($conn);
	}
}


?>