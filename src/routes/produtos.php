<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->group('/api/v1', function(){
    
    $this->get('/produtos', function(Request $request, Response $response){

        return $response->withJson(['nome'=>'moto g']);


    });
});