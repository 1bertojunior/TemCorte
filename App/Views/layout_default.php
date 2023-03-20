<?php
	//Config infos
	$info  =  $this->view->info;
	$header = $info ["header"];
	
	$website = $info ["website"];
	$website_info = $website["info"];
	$website_address = $website["address"];
	$website_social = $website["social"];

	$footer = $info ["footer"];


	// echo "<pre>";
	// print_r($website_address);

	
?>

<head>
	<meta charset="utf-8" />
	<title><?= $header["title_page"] ?> - <?= $header["subtitle_page"] ?></title>
	<meta name="description" content="<?= $header["description"] ?>">
    <meta name="author" content="<?= $header["author"] ?>">
	<link rel="icon" type="img/x-icon" href="/img/icon_barbearia.png">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
		crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/normalize-8.0.1.css" />
	<link rel="stylesheet" type="text/css" href="/css/main-style.css">
	<link rel="stylesheet" type="text/css" href="/css/header-style.css">
	<link rel="stylesheet" type="text/css" href="/css/index-style.css">
	<link rel="stylesheet" type="text/css" href="/css/scheduling-style.css">
	<!-- CSS -->
	
	<!-- Font Awesome -->
	<script src="https://use.fontawesome.com/14e793ff45.js"></script>

</head>

<!-- BODY -->
<body>
	<!-- HEADER -->
	<header>
		<div class="logo">
			<a href="/">
				<img src="/img/barberpole.png">
				<h2><?= $website_info['name'] ?><h2>
			</a>
		</div>

		<nav>
			<ul>
				<li>
					<a href="/">Home</a>
				</li>
				<li>
					<a href="/scheduling">Agendamento</a>
				</li>
				<li>
					<a href="#contact">Contato</a>
				</li>
				
				<li class="login">
					<!-- <a href="/login"><i class="fa fa-user"></i></a> -->
					<a href="/login"><i class="fa fa-user-circle-o fa-lg"></i></a>
					<!-- <a href="/login"><i class="fa fa-user-circle"></i></a> -->					
				</li>
			</ul>
		</nav>
	</header>
	<!-- // HEADER -->


	<!-- MAIN -->
	<?= $this->content($info) ?>
	<!-- // MAIN -->

	<footer>
		<p>&copy; <?= $footer['year'] ?> <a href="/"><?= $footer['name'] ?></a> - <?= $footer['rights'] ?></p>
	</footer>

</body>

</html>