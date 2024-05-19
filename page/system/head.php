<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo $site['title'];?></title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="rating" content="general" />
	<meta name="language" content="es" />

	<meta name="description" content="">
  	<meta name="keywords" content="">

	<meta property="og:locale" content="es_ES">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo $site['title'];?>">
	<meta property="og:description" content="">
	<meta property="og:url" content="<?php echo $site['url'];?>">
	<meta property="og:site_name" content="<?php echo $site['title'];?>">

	<link rel="icon" href="<?php echo $site['url'];?>/assets/img/favicon.png" type="image/png" sizes="16x16">
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/css/fontawesome.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/vendors/datatables/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/vendors/datatables/responsive.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/vendors/datatables/buttons.dataTables.min.css">
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/vendors/modalopen/modalOpen.css">
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/vendors/bselect/bselect.css"/>
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/vendors/fullCalendary/main.min.css"/>
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/css/checkbox.css"/>
	<link rel="stylesheet" href="<?php echo $site['url'];?>/assets/css/styles.css">
	
	<script>var site = {title: '<?php echo $site['title'];?>', url: '<?php echo $site['url'];?>', pload: {page: '<?php if($page){echo $page;}else{echo 'home';}?>'<?php if($page2){?>, data: {<?php if($page2){echo "q: '".$page2."'";}if($page3){echo ", d: '".$page3."'";}if($page4){echo ", u: '".$page4."'";}?>}<?php }?>}}</script>
	<script src="<?php echo $site['url'];?>/assets/js/jquery.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/js/jquery.form.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/js/md5.js"></script>
	<script src="<?php echo $site['url'];?>/assets/vendors/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/vendors/datatables/dataTables.responsive.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/vendors/datatables/dataTables.buttons.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/vendors/datatables/buttons.html5.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/vendors/datatables/jszip.min.js"></script>
	
	<script src="<?php echo $site['url'];?>/assets/vendors/modalopen/jquery.modalOpen.js"></script>
	<script src="<?php echo $site['url'];?>/assets/vendors/bselect/jquery.bselect.js"></script>
	<script src="<?php echo $site['url'];?>/assets/vendors/fullCalendary/main.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/vendors/jspdf/jspdf.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/vendors/jspdf/jspdf.plugin.autotable.min.js"></script>
	<script src="<?php echo $site['url'];?>/assets/js/site.js"></script>
	<script src="<?php echo $site['url'];?>/assets/js/xlsx.full.min.js"></script>
	<!--[if lt IE 9]>
        <script src="<?php echo $site['url'];?>/assets/js/html5shiv.js"></script>
    <![endif]-->
    
</head>
<body>