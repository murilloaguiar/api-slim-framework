<?php
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');

$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists($tabela);

//criando tabela
$schema->create($tabela, function($table){
    $table->increments('id');
    $table->string('titulo',100);
    $table->text('descricao');
    $table->decimal('preco',11,2);
    $table->string('fabricante',60);
    $table->timestamps();
});

$db->table($tabela)->insert([
    'titulo' => 'Smartphone Motorola Moto G6 32GB Dual Chip',
    'descricao' => 'Android Oreo - 8.0 Tela 5.7" Octa-core 1.8ghz Câmera 12 + 5mp (dual traseira) - índigo',
    'preco'=>899.00,
    'fabricante'=>'Motorola',
    'created_at'=>'2022-01-17',
    'updated_at' => '2022-01-17'
]);

$db->table($tabela)->insert([
    'titulo' => 'Iphone X cinza espacial 64gb',
    'descricao' => 'Tela 5.8" IOS 12 4G WI-FI Câmera 12 - Apple',
    'preco'=>4899.00,
    'fabricante'=>'Apple',
    'created_at'=>'2022-01-17',
    'updated_at' => '2022-01-17'
]);