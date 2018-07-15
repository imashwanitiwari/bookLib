<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Dashboard|DCN </title>
	<meta name="description" content="Cable billing Software." />
	<meta name="keywords" content="Cable, Billing, Dish, TV, Technopits, DCN, Hand-Held, Billing Machine, Online Billing, Offline Billing" />
	<meta name="author" content="Microelectronix"/>
	
	<!-- Favicon -->
	<?php $link=array(
        'href'  => 'favicon.ico',
        'rel'   => 'shortcut icon',
        'type'  => 'image/png');
		echo link_tag($link);
		$css_path = "assets/css/";
		
	//Bootstrap CSS 	
	echo link_tag('assets/css/custom.min.css');
	
	//Sweetalert CSS 	
	echo link_tag($css_path.'sweetalert.css');
		
	
	//Data table CSS 
	echo link_tag($css_path.'datatables.min.css');
	echo link_tag($css_path.'style.css');
	echo link_tag($css_path.'font-awesome-4.7.0\css\font-awesome.min.css');
	?>
</head>
<script src="<?=base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>