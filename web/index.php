<?php

use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require __DIR__ . '/../vendor/autoload.php';


$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();

$router = new League\Route\Router;

//function getHandler (ServerRequestInterface $req): ResponseInterface
//{
//    $response = new Laminas\Diactoros\Response;
//    $response->getBody()->write('<h1>Hello, World!</h1>');
//    return $response;
//};

$router->map('GET', '/', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Laminas\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
});

//$response = $router->dispatch($request);
//$emitter = new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter();
//$emitter->emit($response);

try{
    $response = $router->dispatch($request);
    $requestUri=parse_url($_SERVER['REQUEST_URI']);
    $requestPath=$requestUri['path'];
    if ($requestPath!="/"){
        throw new \InvalidArgumentException("Route doesn't exist");
    }
    $emitter = new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter();
    $emitter->emit($response);
} catch (InvalidArgumentException $inv){
    echo "Invalid argument" .$inv->getMessage();
} catch(Exception $e){
    echo "Exception was caught" .$e->getMessage();
    // $response->getBody()->write('<h1>Path doesnt exist!</h1>');
}







