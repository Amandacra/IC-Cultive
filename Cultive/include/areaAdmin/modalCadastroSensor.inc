<!-- Modal de Cadastro Sensor-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalCadastrarSensor" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="cadastrarSensores.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Cadastro de Sensor
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        URL:
                        <input type="text" name="URLSensor" id="URLSensor" class="form-control" maxlength="100" required="required"/>
                    </p>
                    <p>
                        Descrição:
                        <input type="text" name="descricaoSensor" id="descricaoSensor" maxlength="500" class="form-control" required="required"/>
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