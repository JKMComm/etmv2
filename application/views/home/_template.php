<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>Rinjani - Multi-Purpose One Page Theme</title>
    <meta name="description" content="">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Google Font -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="<?=base_url('dist/home/styles/css/styles.css')?>?HASH_CACHE=<?=HASH_CACHE?>"/>
    
    <!-- Color CSS -->
    <!--<link href="assets/css/colors/blue.css" rel="stylesheet" type="text/css">-->
    <!--<link href="../assets/css/component/colors/blue.css" rel="stylesheet" type="text/css">-->
    
    <!-- Modernizr JS for IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../assets/plugins/modernizr.min.js"></script>
    <![endif]-->
</head>
<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" data-offset="51">

<?php $this->load->view('home/home_v'); ?>

    <script src="<?=base_url('dist/home/js/apps.js')?>?HASH_CACHE=<?=HASH_CACHE?>"></script>
</body>
</html>