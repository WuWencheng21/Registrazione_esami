<?php
use DI\Container as Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Util\Connection;
use League\Plates\Engine;


require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
//da inserire prima della create di AppFactory
AppFactory::setContainer($container);

$container->set('template', function (){
    return new League\Plates\Engine('../templates', 'phtml');
});



$app = AppFactory::create();

//Serve per gestire l'errore, viene genereato un testo html con un codice (404 not found)
$errorMiddleware = $app->addErrorMiddleware(false, true, true);



//Questa parte deve essere sostituita con il nome della propria
//sottocartella dove si trova l'applicazione
$app->setBasePath("/projects/Registrazione_esami");//da cambiare OGNI VOLTA

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/altra_pagina', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Questa è un'altra pagina");
    return $response;
});

$app->get('/esempio/{name}', function (Request $request, Response $response, $args) {
    $template  = $this->get('template');
    //Recupero l'oggetto che gestisce i template dal container
    //usando il metodo get e passando la stringa identificato nel metodo set
    $name = $args['name'];
    //Recupero dall'URL il nome che si trova dopo esempio_template/nome
    //$variabile = [ 'name' => $args['name']];
    $response->getBody()->write($template->render('esempio', [
        'name' => $name
    ]));
    return $response;
});

$app->run();