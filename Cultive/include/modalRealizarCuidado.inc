<!-- Modal de Informações sobre o cuidado--><div class="modal fade" tabindex="-1" role="dialog" id="modalCadastrarMaterial1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Cuidado Necessário
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<?php
    $dadosCuidado = $bancoCuidado->recuperaCuidadoNecessidade();
    if(count($dadosItem)>0){
        for($i = 0; $i < sizeof($dadosCuidado); $i++){
            foreach($dadosCuidado[$i] as $key=>$value){
                if($key == "")
                echo "
                    <p>
                        Cuidado:
                    </p>
                ";
            }
        }
    }
?>
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