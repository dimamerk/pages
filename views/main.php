<html lang="ru">
	<head>
		<title><?=$this->getField('pagetitle')?></title>
		<meta charset="utf-8" />
		<meta name="description" content="<?=$this->getField('pagetitle')?>">
		<meta name="keywords" content="<?=$this->getField('keywords')?>" />
		<link rel="stylesheet" href="/css/style.css" />
	</head>
	<body>
		<div class="wrapper">
			<?=$content?>
		</div>
	</body>
	
	<div id="popup" class="popups">
		<div class="message">
			Вы уверены, что хотите удалить этот документ?
		</div>
		<div class="buttons">
			<a href="#" class="but save">Удалить</a>
			<a href="#" class="but undo">Отмена</a>			
		</div>
	</div>

	<script src="/js/jquery.min.js"></script>
	<script src="/js/script.js"></script>

</html>