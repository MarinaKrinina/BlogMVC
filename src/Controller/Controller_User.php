<?
class Controller_User extends Controller {
	function __construct() {
	  require_once('src/Entity/Model_User.php');
	  $this->model = new Model_User();
	  $this->view = new View();
	}
	function login() {
		$this->view->generate('login.php', 'template_view.php');
	}
	function registration() {
		$this->view->generate('registration.php', 'template_view.php');
	}
	function exitUser() {
		session_start();
		unset($_SESSION['user']);
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	function getUser() {
	  $login=$_POST['login'];
		$password=$_POST['password'];
		if ($login!='' && $password!='') {
			$user_id = $this->model->checkUser($login, $password);
		    $this->view->generate('login.php', 'template_view.php');
			if ($user_id) {
				session_start();
				$_SESSION["user"]=$user_id;
				echo "Вы успешно зашли";
			} else {
				echo "Неверный логин или пароль";
			}
		}
	}
	function createUser() {
		$login=$_POST['login'];
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		$avatar = $_FILES['avatar'];
		$this->view->generate('registration.php', 'template_view.php');
		if ($password1!=$password2) {
			echo "Введенные пароли не совпадают";
		} elseif ($password1=='' || $login=='') {
			echo "Логин и пароль - обязательные для заполнения поля";
		} else {
			$success = $this->model->saveUser($login, $password1, $avatar);
			if ($success) {
			  session_start();
			  $_SESSION["user"]=1;
			  echo "Вы успешно зарегистировались";
		   }
		}
	}
}