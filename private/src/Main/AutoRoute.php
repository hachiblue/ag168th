<?php
/**
 * Created by PhpStorm.
 * User: p2
 * Date: 7/15/14
 * Time: 11:32 AM
 */

namespace Main;


use DocBlock\Parser;
use Main\Event\Event;
use Main\Http\RequestInfo;
use Main\View\BaseView;


class AutoRoute {

    private static $route = null;

    public static function dispatch($uri = null, $method = null){
        $route = self::mapAllCTL();
        $match = $route->match($uri, $method);

        if($match['target']){
            $reqInfo = RequestInfo::loadFromGlobal(array("url_params"=> $match['params']));
            $ctl = new $match['target']['c']($reqInfo);
            $response = $ctl->{$match['target']['a']}();
            if($response instanceof ControllerFollow) {
              return self::dispatch(AppConfig::get("route.base_path").$response->getUri(), $response->getMethod());
            }

            if($response instanceof BaseView){
                $response->render();
            }
            else if(is_array($response) || is_object($response)) {
                header("Content-type: application/json");
                echo json_encode($response);
            }
            else {
                echo $response;
            }
        }
        else {
            header("HTTP/1.0 404 Not Found");
        }

        // fire event after_response
        Event::trigger('after_response');

        exit();
    }

    public static function mapAllCTL(){
        if(!is_null(self::$route)) {
          return self::$route;
        }

        self::$route = new \AltoRouter();

        $basePath = AppConfig::get("route.base_path");
        if(!is_null($basePath) && trim($basePath) != ""){
            self::$route->setBasePath($basePath);
        }

        $ctls = self::readCTL();
        foreach($ctls as $ctl){
            self::$route->map(implode('|', $ctl['methods']), $ctl['uri'], array(
                'c'=> $ctl['controller'],
                'a'=> $ctl['action']
            ));
        }

        return self::$route;
    }

    public static function readCTL(){
        $routes = array();

        $parse = new Parser();
        foreach(self::allCTL() as $className){
            $parse->analyze($className);
        }

        $parse->setAllowInherited(true);
        //$parse->setMethodFilter(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED);
        $classes = $parse->getClasses();
        foreach($classes as $class)
        {
            // is web restful
            if(!$class->hasAnnotation("Restful"))
                continue;

            // is has uri annotation
            $classUriAnns = $class->getAnnotations("uri");
            if (empty($classUriAnns)){
                $classUri = "";
            }
            else {
                $classUri = $classUriAnns[0]->getValue();
            }

            $className = $class->getName();

            $methods = $class->getMethods();
            foreach ($methods as $method)
            {
                $HttpMethods = array();
                if($method->hasAnnotation('GET')){
                    $HttpMethods[] = 'GET';
                }
                if($method->hasAnnotation('POST')){
                    $HttpMethods[] = 'POST';
                }
                if($method->hasAnnotation('PUT')){
                    $HttpMethods[] = 'PUT';
                }
                if($method->hasAnnotation('DELETE')){
                    $HttpMethods[] = 'DELETE';
                }

                $uriParamAnns = $method->getAnnotations("uri");

                if (count($uriParamAnns) == 0) {
                    $uri = $classUri;
                }
                else {
                    $uri = $classUri.$uriParamAnns[0]->getValue();
                }

                $route = array('controller'=> $className, 'action'=> $method->getName(),'methods'=> $HttpMethods, 'uri'=> $uri);
                $routes[] = $route;
            }
        }

        return $routes;
    }

    public static function allCTL(){
        $names = array();
        foreach (self::glob_recursive(dirname(__FILE__).'/CTL/*.php') as $filename)
        {
            $name = "Main\\".str_replace(dirname(__FILE__).'/', "", $filename);
            $name = str_replace("/", "\\", $name);
            $name = str_replace(".php", "", $name);
            $names[] = $name;
        }

        return $names;
    }

    public static function glob_recursive($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);

        foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir)
        {
            $files = array_merge($files, self::glob_recursive($dir.'/'.basename($pattern), $flags));
        }

        return $files;
    }

    public function actionCTL($c, $a)
    {

    }
}
