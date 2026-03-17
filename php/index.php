<?php
use Slim\Factory\AppFactory;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/MovimentiController.php';


$app = AppFactory::create();


//gestione movimenti
$app->get('/accounts/{idAccount}/transactions', "MovimentiController:elencoMovimenti");
$app->get('/accounts/{idAccount}/transactions/{idTransazione}', "MovimentiController:dettaglioMovimento");
$app->post('/accounts/{idAccount}/deposits', "MovimentiController:deposito");
$app->post('/accounts/{idAccount}/withdrawals', "MovimentiController:prelievo");
$app->put('/accounts/{idAccount}/transactions/{idTransazione}', "MovimentiController:descrizioneMovimento");
$app->delete('/accounts/{idAccount}/transactions/{idTransazione}', "MovimentiController:eliminaMovimento");

//gestione saldo


$app->run();
