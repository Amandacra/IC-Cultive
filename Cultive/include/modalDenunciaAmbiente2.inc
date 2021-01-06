<!-- Modal de Denuncia de ambiente-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalDenunciaAmbiente" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
                $bancoAmbiente->conectar("mysql", "DBJardim", "root", "");
                $dadosAmbiente = $bancoAmbiente->recuperaAmbiente();
                    if(count($dadosAmbiente)>0){
                        echo '
                            <form action="cadastrarDenunciasAmbiente.php" method="POST"> 
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Denunciar mau uso do ambiente
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Nome do Ambiente:
                                    <select name="codAmbiente" id="codAmbiente">
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
                                </p>
                                <p>
                                    Tipo de mau uso:
                                    <input type="text" name="descricaoDenunciaA" class="form-control" maxlength="500" required="required"/>
                                </p>
                                <p>
                                    Data:
                                    <input type="date" name="dataDenunciaA" class="form-control" required="required"/>
                                </p> 
                                <p>
                                    Foi feito algo para reparar o mau uso?
                                    <input type="text" name="descricaoAcaoDenunciaA" class="form-control"/>
                                </p>
                                <p>
                                    Situação atual do ambiente:
                                    <input type="text" name="situacaoDenunciaA" class="form-control" required="required"/>
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
                                    Ainda não há nenhum ambiente cadastrado.
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
            </form>
        </div>
    </div>
</div>