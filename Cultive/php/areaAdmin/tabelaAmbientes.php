<?php
    session_start();

    require_once '../../classes/Material.php';
    $bancoMaterial = new Material;

    require_once "../../classes/Ambiente.php";
    $bancoAmbiente = new Ambiente;
    
    require_once "../../classes/item.php";
    $bancoItem = new Item;

    require_once "../../classes/cuidado.php";
    $bancoCuidado = new Cuidado;
    
    require_once "../../classes/sensor.php";
    $bancoSensor = new Sensor;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cultive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/principal.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../Logo/FavIcon/ComFundo/favicon.ico">
</head>
<body background="../../img/jardim_fundo.jpg">
    <?php
        if(isset($_SESSION["codigoAdmin"])){
                
            $bancoAmbiente->conectar("mysql", "DBJardim", "root", "");
            $bancoCuidado->conectar("mysql", "DBJardim", "root", "");
            $bancoSensor->conectar("mysql", "DBJardim", "root", "");

            include "../../include/areaAdmin/cabecalhoAdministrador.inc";
            include "../../include/areaAdmin/modalCadastroAmbiente.inc";
            include "../../include/areaAdmin/modalCadastroMaterial.inc";
            include "../../include/areaAdmin/modalCadastroSensor.inc";
            include "../../include/areaAdmin/modalCadastroCuidado.inc";
            include "../../include/areaAdmin/modalCadastroItem.inc";            
            include "../../include/areaAdmin/modalAcionaNecessidade2.inc";
    ?>
        <div class="tabela col-xs-10 offset-xs-1 col-sm-10 offset-sm-10 col-md-15 offset-md-1" id="tabela">
	        <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Localização</th>
                            <th scope="col">Dimensão</th>
                            <th scope="col">Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $ambientes = $bancoAmbiente->recuperaAmbiente();
                            if(count($ambientes)>0){
                                for($i=0;$i<sizeof($ambientes);$i++){
                                    echo '<tr>';
                                    foreach ($ambientes[$i] as $key => $value){
                                        if($key == "codigoAmbiente"){
                                            echo "<td>".$value."</td>";
                                        }else if($key == "nomeAmbiente"){
                                            echo "<td>".$value."</td>";
                                        }else if($key == "descricaoAmbiente"){
                                            echo "<td>". $value ."</td>";
                                        }else if($key == "localizacaoAmbiente"){
                                            echo "<td>". $value ."</td>";
                                        }else if($key == "dimensaoAmbiente"){
                                            echo "<td>". $value ."</td>";
                                        }
                                    }
                                    
                                    echo '
                                        <td> 
                                            <a role="button" class="btn btn-primary custom-btn" href="excluir.php?codigoAmbiente='.$ambientes[$i]['codigoAmbiente'].'"> Excluir </a>
                                        </td>
                                    </tr>
                                    ';
                                }
                            }else{
                                echo '<td colspan="5" align="center">Não há ambientes cadastrados ainda</td>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
            include "../../include/rodape.inc";
        }else{
            header('Location: ../../index.php');
        }
    ?>
    <!--Bibliotecas necessárias-->
    <script src = "../../js/jquery-3.3.1.min.js"></script>
    <script src = "../../js/popper.min.js"></script>
    <script src = "../../js/bootstrap.min.js"></script>
</body>
</html>