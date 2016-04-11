<?php

namespace pagescms\model;

use pagescms\db\DB;
use \PDO;

class PageModel extends Model{

	private $DBH;
	private $tableName = 'pet__page';

	public $pageId;
	public $title;
	public $keywords;
	public $body;
	public $modified;

	public $message = '';
	public $errorMessage = '';
	public $pagetitle = '';

	public $pages = [];

	public function __construct(){
		$this->DBH = DB::getInstance();
	}

	public function find($pageId){

		$STH = $this->DBH->prepare("SELECT pageId,title,body,keywords,modified FROM {$this->tableName} WHERE pageId = :pageId");
		$STH->execute(['pageId' => $pageId]);
		if ($data = $STH->fetch(PDO::FETCH_ASSOC)){
			$this->pageId = $data['pageId'];
			$this->title = $data['title'];
			$this->keywords = $data['keywords'];
			$this->body = $data['body'];
			$this->modified = $data['modified'];
			return true;
		} else {
			$this->message = 'Документ не найден';
		}
		return false;
	}

	public function save(){

		$bindArray = [];
		$this->modified = date('Y-m-d H:i:s');
		if (!empty($this->pageId)){
			$STH = $this->DBH->prepare("UPDATE {$this->tableName} SET title = :title, body = :body, keywords = :keywords, modified = :modified WHERE pageId = :pageId");
			$bindArray = ['pageId' => $this->pageId];
			$action = 'update';
		} else {
			$STH = $this->DBH->prepare("INSERT INTO {$this->tableName} (title,body,keywords,modified) VALUES (:title, :body, :keywords, :modified)");
			$action = 'insert';
		}
		$bindArray = $bindArray + ['title' => $this->title, 'body' => $this->body, 'keywords' => $this->keywords, 'modified' => $this->modified];
		
		$res = $STH->execute($bindArray);
		if (!$res){
			$this->errorMessage .= 'Произошла ошибка при сохранении данных'.PHP_EOL;
		} else {
			if ($action == 'insert'){
				$this->pageId = $this->DBH->lastInsertId();
			}
		}

		return $res;
	}

	public function delete($pageId){
		$STH = $this->DBH->prepare("DELETE FROM {$this->tableName} WHERE pageId = :pageId");
		return $STH->execute(['pageId' => $pageId]);
	}

	public function load(array $fields){
		if (count($fields) > 0){
			if (isset($fields['pageId']) && !empty($fields['pageId'])) {
				$this->pageId = $fields['pageId'];
			}
			$this->title = $fields['title'];			
			$this->body = $fields['body'];			
			$this->keywords = $fields['keywords'];
			$this->modified = $fields['modified'];
			return true;
		}
		$this->errorMessage .= 'Отсутствуют данные'.PHP_EOL;
		return false;
	}

	public function validate(){
		$valid = true;
		if ($this->title == ''){
			$valid = false;
			$this->errorMessage .= 'Необходимо заполнить поле название'.PHP_EOL;
		}		
		return $valid;
	}

	public function getCount(){
		$STH = $this->DBH->prepare("SELECT count(pageId) as cnt FROM {$this->tableName}");
		$STH->execute();
		if ($data = $STH->fetch(PDO::FETCH_ASSOC)){
			return $data['cnt'];
		}
		return false;
	}

	public function findAll($limit = 10,$page = 1){
		$sql = "SELECT pageId,title,modified FROM {$this->tableName} ORDER BY pageId DESC";
		if (!empty($limit) && is_int($limit) && $limit > 0){
			$sql .= " LIMIT {$limit}";
			$page = (int)$page;
			if (!empty($page) && $page > 1){
				$offset = ($page-1)*$limit;
				$sql .= " OFFSET {$offset}";
			}
		}

		$STH = $this->DBH->prepare($sql);
		$res = $STH->execute();
		if ($res){
			while ($data = $STH->fetch(PDO::FETCH_ASSOC)){
				$page = new PageModel;
				$page->load(['pageId' => $data['pageId'], 'title' => $data['title'], 'modified' => $data['modified']]);
				$this->pages[] = $page;
			}
			if (count($this->pages) == 0){
				$this->message = 'Записей не найдено';
			}

			return true;
		}

		return false;
	}
	
}

?>