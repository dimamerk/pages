<?php

use pagescms\widget\Helper;

$model = $fieldsArray['model'];

$this->setField('pagetitle',$model->title);
$this->setField('keywords',$model->keywords);

?>

<div class="inner">
	<?php if (!empty($model->message)){ ?>
	<div class="message"><?=$model->message?></div>
	<?php } ?>

	<?php if (!empty($model->pageId)){ ?>
	<div class="content">
		<h1><?=$model->title?>
			<span class="date">Последнее изменение: <?=Helper::convertDate($model->modified)?></span>
		</h1>
		
		<div class="manage">
			<a href="?q=site/edit&id=<?=$model->pageId?>" class="but edit" title="Редактировать"></a>
			<a href="?q=site/delete&id=<?=$model->pageId?>" class="but delete" title="Удалить"></a>
		</div>

		<div class="keywords">Ключевые слова: <?=$model->keywords?></div>
		<div class="body"><?=$model->body?></div>
	</div>
	<?php } ?>
	<div class="btnWrapper"><a href="?q=site" class="but back" title="В каталог">В каталог</a></div>

</div>