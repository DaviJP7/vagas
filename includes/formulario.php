<main>

    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="POST">

        <div class="form-group">
            <label for="" class="form-label">Título</label>
            <input type="text" class="form-control" value="<?=$objVaga->titulo?>" name="titulo">
        </div>

        <div class="form-group">
            <label for="" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" rows="5"><?=$objVaga->descricao?></textarea>
        </div>

        <div class="form-group">
            <label for="" class="form-label">Status</label>
            
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="s" checked id="">Ativo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="n" <?=$objVaga->ativo == 'n' ? 'checked' : ''?> id="">Inativo
                    </label>
                </div>
            </div>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>
</main>