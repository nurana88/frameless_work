<?php

use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require __DIR__ . '/../vendor/autoload.php';


$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();

$router = new League\Route\Router;

$router->map('GET', '/', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Laminas\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
});

// $response = $router->dispatch($request);

//function checkRoute(string $route ){
//    if ($route!="/"){
//        throw new \Exception("Route doesn't have controller");
//    }
//    echo "success";
//}

try{
    $response = $router->dispatch($request);
    $emitter = new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter();
    $emitter->emit($response);
} catch(Exception $e){
    echo "Exception was caught" .$e->getMessage();
    // $response->getBody()->write('<h1>Path doesnt exist!</h1>');
}







