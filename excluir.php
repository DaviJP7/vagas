<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Vaga;

//ID VALIDATION
if (!$_GET['id'] || !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

$objVaga = Vaga::getVaga($_GET['id']);

//VALIDAÇÃO DA VAGA
if (!$objVaga instanceof Vaga) {
    header('location: index.php?status=error');
    exit;
}

$objVaga->excluir();
header('location: index.php?status=success');
