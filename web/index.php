<?php

use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require __DIR__ . '/../vendor/autoload.php';


$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();

$router = new League\Route\Router;

$handler=function (ServerRequestInterface $req): ResponseInterface
{
    $response = new Laminas\Diactoros\Response;
    $response->getBody()->write('<h1>Hello, World!</h1>');
    return $response;
};
$router->map('GET', '/',$handler);

$emitter = new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter();

try{
    $response = $router->dispatch($request);
} catch (\League\Route\Http\Exception\NotFoundException $e) {
    $response=new \Laminas\Diactoros\Response("Not found", 404);
} catch(Exception $e){
    $response=new \Laminas\Diactoros\Response("Server error", 500);
    // $response->getBody()->write('<h1>Path doesnt exist!</h1>');
}

$emitter->emit($response);






