<?php
header("Content-Type: text/html; charset=UTF-8");
define( 'WP_INSTALLING', false );

$lang = '';
if(isset($_GET['lang'])){
	$lang = $_GET['lang'];
}
if($lang != 'en'){
	$lang = 'ru';	
}

if($lang == 'ru'){
	$title = 'Установка завершена';
} else {
	$title = 'Installation complete';
}
?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' href='style.css?vers=<?php echo time(); ?>' type='text/css' media='all' />
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui/script.min.js" type="text/javascript"></script>
	<script src="js/jquery.form.js" type="text/javascript"></script>
	<script src="js/jcook.js" type="text/javascript"></script>
	<script src="js/config.js?vers=<?php echo time(); ?>" type="text/javascript"></script>
	
</head>
<body>
<div id="container">
	<div class="wrap">
		<div class="header">
			<?php echo $title; ?>
		</div>
		
		<div class="content">
			
			<div class="perfectly"></div>
			<div class="perfectly_text">
				<?php
				if($lang == 'ru'){
				?>
					<p>Установка и настройка завершена!</p>
					<p>Удалите installer</p>
				<?php } else { ?>
					<p>Installation and setup is complete!</p>
					<p>Remove the installer</p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>