<?php

use Slim\Http\Request;
use Slim\Http\Response;

//options - permite que um site consiga enviar uma requisição do tipo options e saiba quais recursos estão disponíveis 
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});


// Routes
require __DIR__ . '/routes/autenticacao.php';

// Routes
require __DIR__ . '/routes/produtos.php';

//multiplos tratamentos de rotas. Trata e mostra um mensagem para página não encontrada caso seja feita um requisição para uma rota inválida
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});