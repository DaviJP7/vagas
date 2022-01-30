<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Cadastrar vaga');

use \App\Entity\Vaga;
$objVaga = new Vaga;

//VALIDACAO DO POST
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){
    $objVaga->titulo = $_POST['titulo'];
    $objVaga->descricao = $_POST['descricao'];
    $objVaga->ativo = $_POST['ativo'];

    $objVaga->cadastrar();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';