<?php //index.php

require_once("./databases/MariaDb.php");
require_once("./models/Usuario.php");

$mariaDb = new MariaDb();
$conexao = $mariaDb->dbConnection();

// $usuario = new Usuario($conexao);
// $usuario->nome = "Gabriel";
// $usuario->login = "gabriel@teste.com.br";
// $usuario->senha = "123";
// $usuario->create();

// $usuario2 = new Usuario($conexao );
// $usuario2->nome = "Ana";
// $usuario2->login = "ana@teste.com.br";
// $usuario2->senha = "12345";
// $usuario2->create();

// $usuario = new Usuario($conexao);
// $usuario->id = 1;
// $usuario->remove();

$usuario = new Usuario($conexao);
$usuario->id = 2;
$usuario->nome = "Maria Clementina";
$usuario->login = "maria@adrubal.org";
$usuario->senha = "789456";
$usuario->update();

$lista_de_usuarios = $usuario->getAll();

foreach($lista_de_usuarios as $item){
    echo "nome: {$item['nome']}";
    echo PHP_EOL;
}

$usuario->getUserById(1);

if($usuario->id > 0){
    echo "Usuário: {$usuario->nome} encontrado";
} else{
    echo "Usuário não encontrado";
}