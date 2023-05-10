<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">

    <meta http-equiv=”X-UA-Compatible” content=”IE=EmulateIE9”>
    <meta http-equiv=”X-UA-Compatible” content=”IE=9”>

    <link rel="shortcut icon" href="<?php echo base_url() ?>static/images/favicon.ico">
    <title>Anbruch CRM <?php echo strpos($_SERVER['SERVER_NAME'], "localhost"); ?></title>
    <?php
        if (strpos($_SERVER['SERVER_NAME'], "localhost") === false) {
            $links = "static/bs3/css/bootstrap.min.css";
            $links .= ",static/js/jquery-ui/jquery-ui-1.10.1.custom.min.css";
            $links .= ",static/css/bootstrap-reset.css";
            $links .= ",static/font-awesome/css/font-awesome.css";
            $links .= ",static/css/clndr.css";
            $links .= ",static/css/style.css";
            $links .= ",static/css/style-responsive.css";
            $js = "static/js/jquery.js";
            $js .= ",static/js/jquery-ui/jquery-ui-1.10.1.custom.min.js";
            $js .= ",static/bs3/js/bootstrap.min.js";
            $js .= ",static/js/jquery.dcjqaccordion.2.7.js";
            $js .= ",static/js/jquery.easing.min.js";
            $js .= ",static/js/skycons/skycons.js";
            $js .= ",static/js/underscore-min.js";
    ?>
<!--
    <link rel="stylesheet" href="<?php /*echo base_url() */?>min/?f=<?php /*echo $links; */?>&12"/>
    <script type="text/javascript" src="<?php /*echo base_url() */?>min/?f=<?php /*echo $js; */?>&12"></script>

    // Current Version 12
-->
        <link rel="stylesheet" href="<?php echo base_url() ?>static/minified_master/mVersion12.css"/>
        <script type="text/javascript" src="<?php echo base_url() ?>static/minified_master/mVersion12.js"></script>       

        <?php } else { ?>
        <!--Core CSS -->
        <link href="<?php echo base_url() ?>static/bs3/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/css/bootstrap-reset.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/css/clndr.css" rel="stylesheet">
				
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url() ?>static/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>static/css/style-responsive.css" rel="stylesheet"/>
   
        <!--Core js-->
        <script src="<?php echo base_url() ?>static/js/jquery.js"></script>
        <script src="<?php echo base_url() ?>static/js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="<?php echo base_url() ?>static/bs3/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>static/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="<?php echo base_url() ?>static/js/jquery.easing.min.js"></script>
        <script src="<?php echo base_url() ?>static/js/skycons/skycons.js"></script>
        <script src="<?php echo base_url() ?>static/js/underscore-min.js"></script>
    <?php } ?>
    
    

    <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet"/>
    <link href="<?php echo base_url() ?>static/css/icon-anbruch.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/sweetalert2.css" rel="stylesheet">
     <script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>          
    	
    <!-- Custom styles for this template -->
		<link href="<?php echo base_url() ?>static/css/my.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>static/js/jquery.nicescroll.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo base_url() ?>static/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        @media (max-width: 480px)
        {
            .login-body {
                margin-top: 0px !important; 
            }
        }
    </style>
</head>
<body class="<?php echo (isset($body_class)) ? $body_class : ""; ?>">
<section id="container">
