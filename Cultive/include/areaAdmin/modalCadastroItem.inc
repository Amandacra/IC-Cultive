<!-- Modal de Cadastro Item-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalCadastrarItem" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
                $dadosAmbiente = $bancoAmbiente->recuperaAmbiente();
                if(count($dadosAmbiente)>0){
                    echo '
                        <form action="cadastrarItens.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Cadastro de Itens
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Nome:
                                    <input type="text" name="nomeItem" id="nomeItem" class="form-control"  maxlength="30" required="required"/>
                                </p>
                                <p>
                                    Descrição:
                                    <input type="text" name="descricaoItem" id="descricaoItem" class="form-control" maxlength="500" required="required"/>
                                </p>
                                <label for="ambienteItem">
                                    Ambiente:
                                    <select name="ambienteItem" id="ambienteItem">
                                        <option value="">Selecione um ambiente</option>
                    ';
                    for($i=0;$i<sizeof($dadosAmbiente);$i++){
                        foreach($dadosAmbiente[$i] as $key => $value){
                            if($key == "codigoAmbiente"){
                                echo "<option value=". $value .">";
                            }else if($key == "nomeAmbiente"){
                                echo $value ."</option>";                                        
                            }
                        }
                    }
                    echo '
                                    </select>
                                </label>
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
                    ';
                }else{
                    echo '
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Alerta!
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Cadastre primeiro um ambiente.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Fechar
                            </button>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
</div>