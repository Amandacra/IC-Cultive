<!-- Modal de Cadastro Ambiente-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalCadastrarJardim" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="php/areaAdmin/cadastrarAmbientes.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Cadastro de Ambientes
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Nome:
                        <input type="text" name="nomeAmbiente" id="nomeAmbiente" class="form-control" placeholder="Cultive..."  maxlength="30" required="required"/>
                    </p>
                    <p>
                        Descrição:
                        <input type="text" name="descricaoAmbiente" id="descricaoAmbiente" class="form-control" maxlength="500" required="required"/>
                    </p>
                    <p>
                        Localização:
                        <input type="text" name="LocalizacaoAmbiente" id="LocalizacaoAmbiente" class="form-control" maxlength="100" required="required"/>
                    </p>
                    <p>
                        Dimensões:
                        <input type="text" name="dimensoes" class="form-control" maxlength="100" required="required"/>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-primary custom-btn">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>