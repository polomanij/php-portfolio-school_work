<?php

class Router {
    private $routes;
    
    public function __construct()
    {
        //Path for routes
        $path = ROOT.'/config/routes.php';
        
        //Include fn returns array of routes
        $this->routes = include $path;
    }
    
    /**
     * Returns request string
     * @return string
     */
    private function getURI()
    {
        $uri = $_SERVER['REQUEST_URI'];
        
        if (!empty($uri)) {
            return trim($uri, '/');
        }
    }

    /**
     * Main Router function for starting site
     */
        public function run()
    {
        $uri = $this->getURI();
        
        foreach ($this->routes as $uriPattern => $path) {
            //Comparing uri by uriPattern
            if (preg_match("~$uriPattern~", $uri)) {
                echo $uri."<br>";
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                echo $internalRoute." <br>";
                $segments = explode("/", $internalRoute);
                
                //Getting controller name and action name
                $controllerName = ucfirst(array_shift($segments)).'Controller';
                echo "$controllerName";
                $actionName = 'action'.ucfirst(array_shift($segments));
                
                //Including controller file
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                }
                
                //Creating controller object and calling of It.
                //Result of controller calling writes in $result
                //Variable $segments stores parameters
                $controllerObject = new $controllerName();
                $result = call_user_func_array(array($controllerObject, $actionName), $segments);
                
                //If controller calling is succesfull exit from foreach
                if ($result != NULL) {
                    break;
                }
            }
        }
    }
}
