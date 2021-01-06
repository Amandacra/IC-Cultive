<!-- Modal de Denuncia de item-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalDenunciaItem" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
                $bancoItem->conectar("mysql", "DBJardim", "root", "");
                $bancoItem->recuperaTodosItens();
                if(count($_SESSION["dadosTodosItens"])>0){
                    echo '
                        <form action="cadastrarDenunciasItem.php" method="POST"> 
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Denunciar mau uso do item
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Nome do Item:
                                <select name="codItem" id="codItem">
                                        <option value="">Selecione um item</option>
                    ';
                    for($i = 0; $i < sizeof($_SESSION["dadosTodosItens"]); $i++){ 
                        foreach ($_SESSION["dadosTodosItens"][$i] as $key => $value){
                            if($key == "codigoItem"){
                                echo "<option value=". $value .">";
                            }else if($key == "codigoAmbiente"){
                                $nomeAmbiente = $bancoItem->recuperaNome($value);
                                if(count($nomeAmbiente)>0){
                                    foreach($nomeAmbiente as $nome){
                                        echo $nome ." - ";
                                    }
                                }
                            }else if($key == "nomeItem"){
                                echo $value ."</option>";
                            }
                        }
                    }
                    echo '
                                </select>
                            </p>
                            <p>
                                Descrição:
                                <input type="text" name="descricaoDenunciaI" class="form-control" maxlength="500" required="required"/>
                            </p>
                            <p>
                                Data:
                                <input type="date" name="dataDenunciaI" class="form-control" required="required"/>
                            </p> 
                            <p>
                                Algo foi feito para reparar?
                                <input type="text" name="descricaoAcaoDenunciaI" class="form-control" required="required"/>
                            </p> 
                            <p>
                                Situação atual do item:
                                <input type="text" name="situacaoDenunciaI" class="form-control" required="required"/>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Fechar
                            </button>
                            <button type="submit" class="btn btn-primary custom-btn">
                                Denunciar
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
                                Ainda não há nenhum item cadastrado.
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