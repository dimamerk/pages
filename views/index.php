<?php
use pagescms\widget\Widget;
use pagescms\widget\Helper;

$this->setField('pagetitle','Каталог документов');
$model = $fieldsArray['model'];

?>
<div class="inner">
	
	<h1>Каталог документов</h1>
	<a href="?q=site/add" class="but add">Добавить документ</a>

	<?php if (!empty($model->message)){ ?>
	<div class="message"><?=$model->message?></div>
	<?php } ?>

	<?php foreach ($model->pages as $value) { ?>
	<div class="item">
		<a href="?q=site/view&id=<?=$value->pageId?>" class="title"><?=$value->title?>
			<span class="date">Последнее изменение: <?=Helper::convertDate($value->modified)?></span>
		</a>
		<div class="manage">
			<a href="?q=site/edit&id=<?=$value->pageId?>" class="but edit" title="Редактировать"></a>
			<a href="?q=site/delete&id=<?=$value->pageId?>" class="but delete" title="Удалить"></a>
		</div>
	</div>
	<?php } ?>

</div>

<?=Widget::start('Paginate',$fieldsArray['paginate'])?>