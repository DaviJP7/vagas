<?php
$msg = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $msg = '<div class="alert alert-success text-center">Ação executada com sucesso!</div>';
            break;

        case 'error':
            $msg = '<div class="alert alert-danger text-center">Ação não executada!</div>';
            break;
    }
}
$resultados = '';
foreach ($vagas as $vaga) {
    $resultados .= '<tr>
                            <td>' . $vaga->id . '</td>
                            <td>' . $vaga->titulo . '</td>
                            <td>' . $vaga->descricao . '</td>
                            <td>' . ($vaga->ativo == 's' ? 'ATIVO' : 'INATIVO') . '</td>
                            <td>' . date('d/m/Y à\s H:i:s', strtotime($vaga->data)) . '</td>
                            <td>
                                <a href="editar.php?id=' . $vaga->id . '">
                                    <button class="btn btn-primary btn-sm">Editar</button>
                                </a>
                                <a href="javascript:void(0)" onclick="deleteVaga(' . $vaga->id . ')">
                                    <button class="btn btn-danger btn-sm">Deletar</button>
                                </a>
                            </td>
                        </tr>';
}

$resultados= strlen($resultados) ? $resultados : '<tr>
                                                    <td colspan="6" class="text-center">
                                                        Nenhuma vaga encontrada
                                                    </td>
                                                  </tr>';

?>
<main>

<?=$msg?>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova vaga</button>
        </a>
    </section>

    <section>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Título</td>
                    <td>Descrição</td>
                    <td>Status</td>
                    <td>Data</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?= $resultados ?>
                </tr>
            </tbody>
        </table>
    </section>

</main>

<script>
    function deleteVaga(id) {
        if (window.confirm("Tem certeza?")) {
            location.href = "excluir.php?id=" + id;
        }
    }
</script>