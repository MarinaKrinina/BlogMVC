<?php
class Controller_Article extends Controller {
	function __construct() {
	  require_once('src/Entity/Model_Article.php');
	  $this->model = new Model_Article();
	  $this->view = new View();
	}
	
	function showAll() {
	  $sortBy = 'rate';
	  if ($_GET['sortBy']) {
		  $sortBy = $_GET['sortBy'];
	  }
	  $this->view->generate('main.php', 'template_view.php');
	}
	
	function showAllAjax() {
	  $sortBy = 'rate';
	  if ($_GET['sortBy']) {
		  $sortBy = $_GET['sortBy'];
	  }
	  $data = $this->model->get_data($sortBy);
	  echo $data;
	}
	
	function showOne() {
	  $id = $_GET['id'];
	  $data = $this->model->get_one_article($id);
	  $this->view->generate('showOneArticle.php', 'template_view.php', $data);
	}
}