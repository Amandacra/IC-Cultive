<!--Cards dos Jardins-->
<?php
    if(!isset($_SESSION['codigoUsuario']) && !isset($_SESSION['codigoAdmin'])){
        $dadosAmbiente = $bancoAmbiente->recuperaAmbiente();
        if(count($dadosAmbiente)>0){
            echo '
                <div class="tabela col-xs-10 offset-xs-1 col-sm-10 offset-sm-10 col-md-15 offset-md-1" id="tabela">
                    <div class="table-responsive">
            ';
            for($i = 0; $i < sizeof($dadosAmbiente); $i++){
                echo '
                    <form action="areaItem.php" method="POST">
                        <table class="table1" align="center">
                ';
                foreach ($dadosAmbiente[$i] as $key => $value){
                    if($key == "codigoAmbiente"){
                        echo '
                            <tr>
                                <th>
                                    <input type="hidden" name="codAmbiente" value="'.$value.'"/>
                        ';
                    }else if($key == "nomeAmbiente"){
                        echo 
                                    $value.'
                                </th>
                            </tr>
                        ';
                    }else if($key == "descricaoAmbiente"){
                        echo '<tr>
                                <td>
                                    <div class="bd-example">
                                        <details>
                                            <summary>'.$value.'</summary>
                        ';
                    }else if($key == "localizacaoAmbiente"){
                        echo '
                                            '
                                                .$value.
                                            '<br>
                        ';
                    }else if($key == "dimensaoAmbiente"){
                        echo '
                                            '
                                                .$value.
                                            '<br>
                        ';
                    }
                }
                echo '
                                        </details>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-primary custom-btn" type="submit">
                                        Visitar
                                    </button>
                                </td>
                            </tr>
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
                        Não há Ambientes cadastrados no momento.
                    </div>
                </div>
            ';
        }
    }else{
        $dadosAmbiente = $bancoAmbiente->recuperaAmbiente();
        if(count($dadosAmbiente)>0){
            echo '
                <div class="tabela col-xs-10 offset-xs-1 col-sm-10 offset-sm-10 col-md-15 offset-md-1" id="tabela">
                    <div class="table-responsive">
            ';
            for($i = 0; $i < sizeof($dadosAmbiente); $i++){
                echo '
                    <form action="areaItem.php" method="POST">
                        <table class="table1" align="center">
                ';
                foreach ($dadosAmbiente[$i] as $key => $value){
                    if($key == "codigoAmbiente"){
                        echo '
                            <tr>
                                <th>
                                    <input type="hidden" name="codAmbiente" value="'.$value.'"/>
                        ';
                    }else if($key == "nomeAmbiente"){
                        echo 
                                    $value.'
                                </th>
                            </tr>
                        ';
                    }else if($key == "descricaoAmbiente"){
                        echo '<tr>
                                <td>
                                    <div class="bd-example">
                                        <details>
                                            <summary>'.$value.'</summary>
                        ';
                    }else if($key == "localizacaoAmbiente"){
                        echo '
                                            '
                                                .$value.
                                            '<br>
                        ';
                    }else if($key == "dimensaoAmbiente"){
                        echo '
                                            '
                                                .$value.
                                            '<br>
                        ';
                    }
                }
                echo '
                                        </details>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="btn btn-primary custom-btn" type="submit">
                                        Visitar
                                    </button>
                                </td>
                            </tr>
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
                        Não há Ambientes cadastrados no momento.
                    </div>
                </div>
            ';
        }
    }
?>