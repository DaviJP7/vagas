<?php

require __DIR__.'/vendor/autoload.php';

define('TITLE','Editar vaga');

use \App\Entity\Vaga;

//ID VALIDATION
if(!$_GET['id'] || !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

$objVaga = Vaga::getVaga($_GET['id']);

//VALIDAÇÃO DA VAGA
if(!$objVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}

//VALIDACAO DO POST
if(isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])){

    $objVaga->titulo = $_POST['titulo'];
    $objVaga->descricao = $_POST['descricao'];
    $objVaga->ativo = $_POST['ativo'];

    $objVaga->atualizar();

    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';