<?
class Route
{
	static function start() {
		$controller_name = 'article';
		$action_name = 'showAll';
		$url = explode('?', $_SERVER['REQUEST_URI']);
		$url = $url[0];
		$url = explode('/', $url);
		if (!empty($url[1])) {
		    $controller_name = $url[1];
		}
		if (!empty($url[2])) {
			$action_name = $url[2];
		}
		$controller_name = 'Controller_'.$controller_name;
		require_once('Controller/'.$controller_name.'.php');
		$controller = new $controller_name();
		if(method_exists($controller, $action_name))
		{
		  $controller->$action_name();
		}
	}
}