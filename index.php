<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

class Servico{

}

$servico = new Servico;

/*Container dependency injection*/

// Container pimple
$container = $app->getContainer();
$container['servico'] = function(){
    return new Servico; //injetando a dependência dentro do container do slim
};

$app->get('/servico', function(Request $request, Response $response){
    
    $servico = $this->get('servico'); //recuperando a dependência
});

//controllers como serviço
//slim já procura a classe de acordo com o namespace informado e instância o objeto para nós, passando o container como parâmetro do construtor

$container = $app->getContainer();
$container['Home'] = function(){
    return new MyApp\controllers\Home( new MyApp\View ); //injetando a dependência dentro do container do slim
};
$app->get('/usuario', 'Home:index');


$app->run();

/* padrao psr-7
$app->get('/postagens', function(Request $request, Response $response){
    
    //escrevendo no corpo da resposta. Mais indicado
    $response->getBody()->write("Listagem de postagens");
    return $response;
});

$app->post('/usuarios/adiciona', function(Request $request, Response $response){
    //recuperando as informações ($_POST)
    $post = $request->getParsedBody();
    $nome = $post['nome'];
    $email = $post['email'];

    //salvando no banco de dados. INSERT INTO

    return $response->getBody()->write("Sucesso ao cadastrar");
 
});

$app->put('/usuarios/atualiza', function(Request $request, Response $response){
    //recuperando as informações ($_POST)
    $post = $request->getParsedBody();
    $id = $post['id'];
    $nome = $post['nome'];
    $email = $post['email'];

    //atualizando no banco de dados. UPDATE

    return $response->getBody()->write("Sucesso ao atualizar");
 
});

$app->delete('/usuarios/remove/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    //removendo no banco de dados. DELETE

    return $response->getBody()->write("Sucesso ao deletar: $id");
 
});

$app->run();
*/

/*
$app->get('/postagem', function(){
    echo 'Lista de postagens';
});

$app->get('/postagens[/{ano}[/{mes}]]', function($request, $response){
    $ano = $request->getAttribute('ano');
    $mes = $request->getAttribute('mes');
    echo "Listagem de postagens ano: $ano, mês: $mes";
});

$app->get('/lista/{itens:.*}', function($request, $response){
    //aceitando qualquer coisa depois de lista/
    $itens = $request->getAttribute('itens');

    var_dump(explode("/", $itens));
    
});

$app->get('/usuarios[/{id}]', function($request, $response){
    //id opcional
    $id = $request->getAttribute('id');
    echo 'Lista de usuários ou id: '.$id;
});

// Nomeando rotas
$app->get('/blog/postagens/{id}', function($request, $response){
    echo "Listar postagem para um id";
})->setName("blog");

$app->get('/meusite', function($request, $response){
    $retorno = $this->get("router")->pathFor("blog", ["id"=> "5"]);
});


//agrupando rotas
$app->group('/v1', function(){

    $this->get('/usuarios', function(){
        echo 'Lista de usuários';
    });

    $this->get('/postagens', function(){
        echo 'Lista de postagens';
    });

});

$app->run();*/

