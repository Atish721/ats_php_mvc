<?php

/**
 * @package		ATS PHP MVC
 * @author		Atish Chandole
 * @since       31 May 2021
 */

class rout
{

    public $controller  =   "";
    public $method      =   "index";
    public $params      =   [];
    public $routes      =   array();

    public function __construct()
    {
        $this->directory = '';
        $url = $this->url();
        $url = $this->_validate_request($url);
        
        if (!empty($url)) {
            if (file_exists("application/controllers/".$this->directory . $url[0] . ".php")) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry  " . $url[0] . ".php not found</div>";
            }
        } else {
            $this->parse_routes();
        }

        require_once "application/controllers/".$this->directory . $this->controller . ".php";

        $c_array = explode('/', $this->controller);
        $this->controller = end($c_array);

        $this->controller = new $this->controller;

        if (isset($url[1]) && !empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry  method " . $url[1] . " not found</div>";
            }
        }

        if (isset($url)) {
            $this->params = $url;
        } else {
            $this->params = [];
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function _validate_request($segments)
	{
		$c = count($segments);
		while ($c-- > 0)
		{
			if ( ! file_exists('application/controllers/'.$this->directory.'.php')
				&& is_dir('application/controllers/'.$this->directory.$segments[0])
			)
			{
				$this->set_directory(array_shift($segments), TRUE);
				continue;
			}

			return $segments;
		}

		return $segments;
	}

    public function set_directory($dir, $append = FALSE)
	{
		if ($append !== TRUE OR empty($this->directory))
		{
			$this->directory = str_replace('.', '', trim($dir, '/')).'/';
		}
		else
		{
			$this->directory .= str_replace('.', '', trim($dir, '/')).'/';
		}
	}

    public function parse_routes()
    {
        $val = '';

        if (file_exists('application/config/routes.php')) {
            include('application/config/routes.php');
        }

        if (isset($route) && is_array($route)) {

            isset($route['default_controller']) && $this->controller = $route['default_controller'];

            $this->routes = $route;

            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = $this->removeControllerAndMethod($uri);

            foreach ($this->routes as $key => $value) {

                if (strpos($_SERVER['REQUEST_URI'], $key) !== false) {
                    $val = $value;
                }

                $key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);

                if (preg_match('#^' . $key . '$#', $uri, $matches)) {

                    if (!is_string($value) && is_callable($value)) {

                        array_shift($matches);

                        $val = call_user_func_array($val, $matches);

                    } elseif (strpos($value, '$') !== FALSE && strpos($key, '(') !== FALSE) {
                        $val = preg_replace('#^' . $key . '$#', $value, $uri);
                    }
                }
            }
        }

        if (empty($val)) {
            $val = $_SERVER['REQUEST_URI'];
            $val = $this->removeControllerAndMethod($val);
        }
        
        return $val;
    }

    function removeControllerAndMethod($val)
    {
        $path = dirname($_SERVER['PHP_SELF']);
        $position = strrpos($path, '/') + 1;
        $directoryName = substr($path, $position); //get dir name i.e ats_php_mvc
        $val = str_replace($directoryName . '/', "", $val); // remove base directory i.e ats_php_mvc
        $val = ltrim($val, '/'); //remove first character i.e /
        return $val;
    }

    public function url()
    {
        if (isset($_GET['url'])) {
            $url = $this->parse_routes();
            $url = rtrim($url);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }
}
