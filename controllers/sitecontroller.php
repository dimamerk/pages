<?php

namespace pagescms\controller;

use pagescms\factory\Factory;

class SiteController extends Controller{

	private $model = null;

	public function __construct(){
		$this->model = Factory::getModel('page');
	}

	public function actionIndex(){
		$display = 10;
		$total = $this->model->getCount();
		$current = $this->request->getValue('page');
		$this->model->findAll($display,$current);
		$this->render('index',	['model'	=>	$this->model,
								 'paginate' =>	[
													'current'	=>	$current,
													'display'	=>	$display,
													'total'		=>	$total
												]
								]);
	}

	public function actionView(){
		$this->model->find($this->request->getValue('id'));
		$this->render('view',['model' => $this->model]);
	}

	public function actionAdd(){
		$this->model->pagetitle = 'Добавление документа';
		$this->render('form',['model' => $this->model]);
	}

	public function actionEdit(){
		$this->model->pagetitle = 'Редактирование документа';
		$this->model->find($this->request->getValue('id'));
		$this->render('form',['model' => $this->model]);
	}

	public function actionSave(){
		if ($this->model->load($this->request->post()) && $this->model->validate() && $this->model->save()){
			$this->redirect('?q=site/view&id='.$this->model->pageId);
		} else {
			$this->model->pagetitle = 'Редактирование документа';
			$this->render('form',['model' => $this->model]);
		}
	}

	public function actionDelete(){
		$res = $this->model->delete($this->request->getValue('id'));
		$this->redirect('?q=site');
	}

}

?>