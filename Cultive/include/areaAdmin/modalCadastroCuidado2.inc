<!-- Modal de Cadastro Cuidado-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalCadastrarCuidado" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
                $bancoItem->conectar("mysql", "DBJardim", "root", "");
                $bancoMaterial->conectar("mysql", "DBJardim", "root", "");
                if($bancoItem->recuperaTodosItens()){
                    if($bancoMaterial->recuperaTodosMateriais()){
                        echo '
                            <form action="areaAdmin/cadastrarCuidados.php" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Cadastro de Cuidados
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Descrição:
                                        <input type="text" name="descricaoCuidado" id="descricaoCuidado" class="form-control" maxlength="500" required="required"/>
                                    </p>
                                    <p>
                                        Pontuação:
                                        <input type="number" name="pontuacaoCuidado" id="pontuacaoCuidado" class="form-control" required="required"/>
                                    </p>
                                    <p>
                                        Item do ambiente:
                                        <select name="cuidadoItem">
                                        <option value="">Selecione um Item</option>
                        ';
                        for($i=0; $i<sizeof($_SESSION["dadosTodosItens"]); $i++){
                            foreach($_SESSION["dadosTodosItens"][$i] as $key => $value){
                                if($key == "nomeItem"){
                                    echo "
                                        <option value=".$value.">
                                            ".$value."
                                        </option>
                                    ";
                                }
                            }
                        }
                        echo '
                                        </select>
                                    </p>
                                    <p>
                                        Material necessário:
                                        <select name="cuidadoMaterial">
                                        <option value="">Selecione um material</option>
                        ';
                        for($i=0; $i<sizeof($_SESSION["dadosTodosMateriais"]); $i++){
                            foreach($_SESSION["dadosTodosMateriais"][$i] as $key => $value){
                                if($key == "nomeMaterial"){
                                    echo "
                                        <option value=".$value.">
                                            ".$value."
                                        </option>
                                    ";
                                }
                            }
                        }
                        echo '
                                        </select>
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
                                    Cadastre primeiro um material.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Fechar
                                </button>
                            </div>
                        ';
                    }
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
                                Cadastre primeiro um item.
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