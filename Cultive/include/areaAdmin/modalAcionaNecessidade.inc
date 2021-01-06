<!-- Modal de Cadastro Necessidade-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAcionaNecessidade" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
                $dadosItem = $bancoItem->recuperaTodosItens();
                $dadosCuidado = $bancoCuidado->recuperaCuidado();
                $dadosSensor = $bancoSensor->recuperaSensor();
                if(count($_SESSION["dadosTodosItens"])>0){
                    if(count($dadosCuidado)>0){
                        if(count($dadosSensor)>0){
                            echo '
                                <form action="php/areaAdmin/acionaNecessidade.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Acionar Necessidade
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Nome do Item:
                                            <select name="codItem" id="codItem" required>
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
                            ';
                            if(count($dadosCuidado)>1){
                                echo '
                                    <p>
                                        Cuidado:
                                        <select name="codCuidado" id="codCuidado" required>
                                            <option value="">Selecione um cuidado</option>
                                ';
                                for($i = 0; $i < sizeof($dadosCuidado); $i++){ 
                                    foreach ($dadosCuidado[$i] as $key => $value){
                                        if($key == "codigoCuidado"){
                                            echo "<option value=". $value .">";
                                        }else if($key == "descricaoCuidado"){
                                            echo $value ."</option>";
                                        }
                                    }
                                }
                                echo '
                                        </select>
                                    </p>
                                ';
                            }else{
                                for($i = 0; $i < sizeof($dadosCuidado); $i++){ 
                                    foreach ($dadosCuidado[$i] as $key => $value){
                                        if($key == "codigoCuidado"){
                                            echo '<input type="hidden" name="codCuidado" value="$value"/>';
                                        }
                                    }
                                }
                            }
                            if(count($dadosSensor)>1){
                                echo '
                                    <p>
                                        Sensor:
                                        <select name="codSensor" id="codSensor" required>
                                            <option value="">Selecione um sensor</option>
                                ';
                                for($i = 0; $i < sizeof($dadosSensor); $i++){ 
                                    foreach ($dadosSensor[$i] as $key => $value){
                                        if($key == "codigoSensor"){
                                            echo "<option value=". $value .">";
                                        }else if($key == "descricaoSensor"){
                                            echo $value ."</option>";
                                        }
                                    }
                                }
                                echo '
                                        </select>
                                    </p>
                                ';
                            }else{
                                for($i = 0; $i < sizeof($dadosSensor); $i++){ 
                                    foreach ($dadosSensor[$i] as $key => $value){
                                        if($key == "codigoSensor"){
                                            echo '<input type="hidden" name="codSensor" value="$value"/>';
                                        }
                                    }
                                }
                            }
                            echo '
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Fechar
                                        </button>
                                        <button type="submit" class="btn btn-primary custom-btn">
                                            Acionar
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
                                        Cadastre primeiro um sensor.
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
                                    Cadastre primeiro um cuidado.
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