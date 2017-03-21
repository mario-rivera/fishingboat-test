<?php 
namespace app\Http\Routing;

use DI\Container;
use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

use Exception;

class RouteDispatcher{
    
    protected $container;
    
    public function __construct( Container $container ){
        $this->container = $container;
    }
    
    public function dispatch( $verb, $uri ){
        $dispatcher = simpleDispatcher(function (RouteCollector $router) {
            require_once(  __DIR__ . '/routes.php' );
        });
        
        return $this->dispatchRequest($verb, $uri, $dispatcher);
    }
    
    protected function dispatchRequest( $verb, $uri, Dispatcher $dispatcher ){
        $route = $dispatcher->dispatch($verb, $uri);
        
        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                $response = '404 Not Found';
                break;

            case Dispatcher::METHOD_NOT_ALLOWED:
                $response = '405 Method Not Allowed';
                break;

            case Dispatcher::FOUND:
                $controller = $route[1];
                $parameters = $route[2];
                
                // We could do $container->get($controller) but $container->call()
                // does that automatically
                $response = $this->container->call($controller, $parameters);
                break;
        }
        
        return $response;
    }
}