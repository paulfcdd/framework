<?php


namespace App;

use Symfony\Component\HttpFoundation as Http;
use Symfony\Component\Routing as SfRouting;
use Symfony\Component\Config as SfConfig;

class Router
{
    /** @var null  */
    private $controller = null;
    /** @var array  */
    private $parameters = [];
    /** @var null  */
    private $matcher = null;

    /**
     * @return mixed
     */
    final public function match() {
        $context = new SfRouting\RequestContext();
        $request = Http\Request::createFromGlobals();
        $context->fromRequest($request);
        $urlMatcher = new SfRouting\Matcher\UrlMatcher($this->getRoutes(), $context);
        $this->matcher = $urlMatcher->matchRequest($request);
        $this->controller = $this->matcher['_controller'];
        return $this->userFuncParameters()->callUserFunc();
    }

    /**
     * @return mixed
     */
    private function callUserFunc() {
        $controllerToArray = explode('::', $this->controller);
        $className = new $controllerToArray[0]();
        $actionName = $controllerToArray[1];
        return call_user_func_array([$className, $actionName], $this->parameters);
    }

    /**
     * @return SfRouting\RouteCollection
     */
    private function getRoutes() {
        $fileLocator = new SfConfig\FileLocator([__DIR__ . '/../config']);
        $loader = new SfRouting\Loader\YamlFileLoader($fileLocator);
        $routes = $loader->load('routes.yml');
        return $routes;
    }

    /**
     * @return $this
     */
    private function userFuncParameters() {
        foreach ($this->matcher as $key=>$val) {
            if (!strstr($key, '_')) {
                $this->parameters[$key] = $val;
            }
        }
        return $this;
    }
}