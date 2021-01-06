<!-- Modal de Cadastro Material-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalCadastrarMaterial1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="areaAdmin/cadastrarMateriais.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Cadastro de Materiais
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Nome:
                        <input type="text" name="nomeMaterial" id="nomeMaterial" class="form-control" maxlength="30" required="required"/>
                    </p>
                    <p>
                        Descrição:
                        <input type="text" name="descricaoMaterial" id="descricaoMaterial" maxlength="500" class="form-control" required="required"/>
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