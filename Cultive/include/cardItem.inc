<!--Cards dos Jardins-->
<?php
    $dadosItem = $bancoItem->recuperaItem($_SESSION["codAmbiente"]);
    $nomAmbiente = $bancoItem->recuperaNome($_SESSION["codAmbiente"]);
    if(!isset($_SESSION['codigoUsuario']) && !isset($_SESSION['codigoAdmin'])){
        if(count($dadosItem)>0){
            echo '
                <div class="tabela col-xs-10 offset-xs-1 col-sm-10 offset-sm-10 col-md-15 offset-md-1" id="tabela">
                    <div class="table-responsive">
            ';
            for($i = 0; $i < sizeof($dadosItem); $i++){
                echo '
                    <form>
                        <table class="table1" align="center">
                ';
                foreach ($dadosItem[$i] as $key => $value){
                    if($key == "codigoItem"){
                        echo '
                            <tr>
                                <th>
                                    <input type="hidden" name="codItem" value="'.$value.'"/>
                        ';
                    }else if($key == "codigoAmbiente"){
                        echo '
                                    '.$nomAmbiente["nomeAmbiente"].'
                                </th>
                            </tr>
                        ';
                    }
                    else if($key == "nomeItem"){
                        echo '
                            <tr>
                                <td>
                                    Item: '.$value.'
                                </td>
                            </tr>
                        ';
                    }else if($key == "descricao"){
                        echo '
                            <tr>
                                <td>
                                    Descrição: '.$value.'
                                </td>
                            </tr>
                        ';
                    }
                }

                echo '
                        </table>
                    </form>
                ';
            }
            echo '
                    </div>
                </div>
            ';
        }else{
            echo '
                <div class="container1">
                    <div class="alert alert-success" role="alert">
                        Não há Itens cadastrados nesse ambiente.
                    </div>
                </div>
            ';
        }
    }else{
        if(count($dadosItem)>0){
            $item = "a";
            echo '
                <div class="tabela col-xs-10 offset-xs-1 col-sm-10 offset-sm-10 col-md-15 offset-md-1" id="tabela">
                    <div class="table-responsive">
            ';
            $item=array();
            $necessidade = array();
            for($i = 0; $i < sizeof($dadosItem); $i++){
                echo '
                    <form action="atendeNecessidade.php" method="POST">
                        <table class="table1" align="center">
                ';
                foreach ($dadosItem[$i] as $key => $value){
                    if($key == "codigoItem"){
                        echo '
                            <tr>
                                <th>
                                    <input type="hidden" name="codI" value="'.$value.'"/>
                        ';
                        $necessidade = $bancoNecessidade->selecionaItemNecessidade($value);
                    }else if($key == "codigoAmbiente"){
                        echo '
                                    '.$nomAmbiente["nomeAmbiente"].'
                                </th>
                            </tr>
                        ';
                    }
                    else if($key == "nomeItem"){
                        echo '
                            <tr>
                                <td>
                                    Item: '.$value.'
                                </td>
                            </tr>
                        ';
                        $item[$i] = $value;
                    }else if($key == "descricaotem"){
                        echo '
                            <tr>
                                <td>
                                    Descrição: '.$value.'
                                </td>
                            </tr>
                        ';
                    }
                }

                if(isset($necessidade)){
                    
                    if(count($necessidade)>0){
                        $entrou=0;
                        for($j = 0; $j < sizeof($item); $j++){
                            foreach($necessidade[$j] as $chave => $valor){
                                $fechadura = $chave;
                                if($fechadura == 'nomeItem'){
                                    if($valor == $item[$j]){
                                        $entrou=1;
                                        echo '
                                            <input type="hidden" name="nomeI" value="'.$valor.'"/>
                                            <tr>
                                                <td>
                                                    <div class="bd-example">
                                                        <details>
                                                            <summary>Cuidado necessário</summary>
                                        ';
                                    }
                                }
                                if($entrou == 1){
                                    if($chave == "descricaoCuidado"){
                                        echo "
                                                                $valor
                                                                <br>
                                        ";
                                    }else if($chave == "pontuacaoCuidado"){
                                        echo "
                                                                <input type='hidden' name='pontuacaoC' value='$valor'/>
                                                                $valor
                                                                <br>
                                                            </details>
                                                        </div>
                                                    </td>
                                                </tr>
                                        ";
                                    }else if($chave == "codigoNecessidade"){
                                        echo "
                                                <tr>
                                                    <td>
                                                        <input type='hidden' name='codigoN' value='$valor'/>
                                                        <button type='submit' class='btn btn-primary custom-btn necessidade'>
                                                            <img class='img' src='../img/alerta_mensagem.png'/>Realizar cuidado
                                                        </button>
                                                    </td>
                                                </tr>
                                        ";
                                    }
                                }
                            }
                        }
                    }
                }
                
                echo '
                        </table>
                    </form>
                ';
            }
            echo '
                    </div>
                </div>
            ';

        }else{
            echo '
                <div class="container1">
                    <div class="alert alert-success" role="alert">
                        Não há Itens cadastrados nesse ambiente.
                    </div>
                </div>
            ';
        }
    }
?>