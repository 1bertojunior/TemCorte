<?php
    //Config infos
	$info  =  $this->view->info;
	$header = $info ["header"];
	
	$website = $info ["website"];
	$website_info = $website["info"];

	$footer = $info ["footer"];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $header["title_page"] ?> - <?= $header["subtitle_page"] ?></title>
    <meta name="description" content="<?= $header["description"] ?>">
    <meta name="author" content="<?= $header["author"] ?>">
    <link rel="icon" type="img/x-icon" href="/img/icon_barbearia.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/admin/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/admin/login.css" rel="stylesheet">

</head>

<body class="bg-gradient-secondary">

    <!-- MAIN -->
    <?= $this->content($info) ?>
	<!-- // MAIN -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/admin/sb-admin-2.min.js"></script>

</body>

</html>