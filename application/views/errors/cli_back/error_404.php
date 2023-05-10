<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once BASEPATH . "../../../application/config/config.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="<?php echo $config['base_url'] ?>static/img/favicon.png">

    <title>Anbruch CRM - 404</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $config['base_url'] ?>static/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $config['base_url'] ?>static/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo $config['base_url'] ?>static/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo $config['base_url'] ?>static/css/style.css" rel="stylesheet">
    <link href="<?php echo $config['base_url'] ?>static/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo $config['base_url'] ?>static/js/html5shiv.js"></script>
    <script src="<?php echo $config['base_url'] ?>static/js/respond.min.js"></script>
    <![endif]-->
</head>




<body class="body-404">

<div class="error-head"> </div>

<div class="container ">

    <section class="error-wrapper text-center">
        <h1><img src="<?php echo $config['base_url'] ?>static/images/404.png" alt=""></h1>
        <div class="error-desk">
            <h2>page not found</h2>
            <p class="nrml-txt">We Couldn’t Find This Page</p>
        </div>
        <a href="<?php echo $config['base_url'] ?>" class="back-btn"><i class="fa fa-home"></i> Back To Home</a>
    </section>

</div>


</body>
</html>