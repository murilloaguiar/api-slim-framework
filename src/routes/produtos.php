<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Routes
$app->group('/api/v1', function(){
    
    // adicionar um produto
    $this->post('/produtos/adiciona', function(Request $request, Response $response){
        $dados = $request->getParsedBody(); //recupera o corpo da requisição
        $produto = Produto::create($dados);
        return $response->withJson($produto);
    });

    //listar produtos
    $this->get('/produtos/lista', function(Request $request, Response $response){

        $produtos = Produto::get();

        return $response->withJson($produtos);
    });
    
    //recuperando um produto por id
    $this->get('/produtos/lista/{id}', function(Request $request, Response $response, array $args){

        $produto = Produto::findOrFail($args['id']);
        return $response->withJson($produto);
    });

    //atualizando um produto por id
    $this->put('/produtos/atualiza/{id}', function(Request $request, Response $response, array $args){

        $dados = $request->getParsedBody(); //recupera o corpo da requisição
    
        $produto = Produto::findOrFail($args['id']);
        $produto->update($dados);
        return $response->withJson($produto);
    });

    //removendo um produto por id
    $this->put('/produtos/remove/{id}', function(Request $request, Response $response, array $args){

        $produto = Produto::findOrFail($args['id']);

        $produto->delete();
        return $response->withJson($produto);
    });

});