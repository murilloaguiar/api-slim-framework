<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as Capsule;

require 'vendor/autoload.php';

$app = new \Slim\App;

$container = $app->getContainer();
$container['db'] = function(){
    $capsule = new Capsule;

    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'slim',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$app->get('/usuarios', function(Request $request, Response $response){
    $db = $this->get('db');

    /*$db->schema()->dropIfExists('usuarios');

    //criando tabela
    $db->schema()->create('usuarios', function($table){
        $table->increments('id');
        $table->string('nome');
        $table->string('email');
        $table->timestamps();
    });*/

    //inserindo

    /*$db->table('usuarios')->insert([
        'nome'=>'Murillo',
        'email'=>'teste@teste.com'
    ]);*/

    //atualizando
    /*$db->table('usuarios')
        ->where('id',1)
        ->update([
            'nome'=>'Murillo Aguiar',
        ]);
    */

    //deletando
    /*$db->table('usuarios')
        ->where('id',1)
        ->delete();
    */

    //listar
    $usuarios = $db->table('usuarios')->get();
    foreach($usuarios as $usuario){
        echo $usuario->nome.'<br>';    
    }

});


$app->run();


/* Tipos de respostas 
cabeçalho, texto, Json, XML

$app->get('/header', function(Request $request, Response $response){
    
    $response->write('Esse é um retorno header');
    return $response->withHeader('allow', 'PUT') //permite apenas requisições do tipo PUT
        ->withAddedHeader('Content-length', 10); //define o tamanho do conteúdo

});

$app->get('/json', function(Request $request, Response $response){
    
    //$response->write('{"nome": "Murillo Aguiar}'); //conteúdo entendido como um texto html

    return $response->withJson([
        "nome"=>"Murillo Aguiar",
        "endereco"=>"endereço rua bairro"
    ]); //converte dados de um array para um json

});

$app->get('/xml', function(Request $request, Response $response){
    
    $xml = file_get_contents('arquivo');
    $response->write($xml);

    return $reponse->withHeader('Content-Type', 'application/xml');
});


/*middleware
$app->add(function($request, $response, $next){
    $response->write('Inicio camada 1 + ');
    //return $next($request, $response);
    $response = $next($request, $response);
    $response->write(' + fim camada 1');
    return $response;
});

$app->add(function($request, $response, $next){
    $response->write('Inicio camada 2 + ');
    //return $next($request, $response);
    $response = $next($request, $response);
    $response->write(' + fim camada 2');
    return $response;
});



$app->get('/middleware', function(Request $request, Response $response){
    $response->write(' + Ação principal 1');

});

$app->run();*/

/*class Servico{

}

$servico = new Servico;

/*Container dependency injection

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


$app->run();*/

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

