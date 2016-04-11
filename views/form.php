<?php

$model = $fieldsArray['model'];
$this->setField('pagetitle',$model->pagetitle);

?>

<div class="inner">

	<h1><?=$model->pagetitle?></h1>

	<?php if (!empty($model->message)){ ?>
	<div class="message"><?=$model->message?></div>
	<?php } ?>
	<?php if (!empty($model->errorMessage)){ ?>
	<div class="errorMessage"><?=$model->errorMessage?></div>
	<?php } ?>

	<form action="?q=site/save" method="post" class="saveForm">
		<input type="hidden" name="pageId" value="<?=$model->pageId?>">
		<div class="placeholder validate<?php if(!empty($model->title)) echo ' focused'; ?>">
			<input id="titleField" type="text" name="title" value="<?=$model->title?>">
			<label for="titleField">Название*</label>
		</div>
		<div class="placeholder<?php if(!empty($model->keywords)) echo ' focused'; ?>">
			<input id="keyField" type="text" name="keywords" value="<?=$model->keywords?>">
			<label for="keyField">Ключевые слова</label>
		</div>
		<div class="placeholder<?php if(!empty($model->body)) echo ' focused'; ?>">
			<textarea id="bodyField" name="body"><?=$model->body?></textarea>
			<label for="bodyField">Контент</label>
		</div>
		<button type="submit" class="but save">Сохранить</button>
		<a href="?q=site" class="but undo">Отмена</a>
	</form>

</div>