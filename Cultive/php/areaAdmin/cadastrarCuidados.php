<?php

    require_once "../../classes/cuidado.php";
    $bancoCuidado = new Cuidado;

    require_once '../../classes/Ambiente.php';
    $bancoAmbiente = new Ambiente;

    require_once '../../classes/item.php';
    $bancoItem = new Item;

    require_once '../../classes/material.php';
    $bancoMaterial = new Material;
    
    require_once "../../classes/sensor.php";
    $bancoSensor = new Sensor;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Jardim Colaborativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/principal.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../Logo/FavIcon/ComFundo/favicon.ico">
</head>
<body background="../../img/jardim_fundo.jpg">
    <?php

        if(isset($_POST['descricaoCuidado'])){ 
            $descricaoCuidado = addslashes($_POST["descricaoCuidado"]);
            $pontuacaoCuidado = addslashes($_POST["pontuacaoCuidado"]);
            $cuidadoItem = addslashes($_POST["codigoItem"]); 
            $cuidadoMaterial = addslashes($_POST["codigoMaterial"]);

            $bancoCuidado->conectar("mysql", "DBJardim", "root", "");
            $bancoAmbiente->conectar("mysql", "DBJardim", "root", "");
            $bancoItem->conectar("mysql", "DBJardim", "root", "");
            $bancoMaterial->conectar("mysql", "DBJardim", "root", "");
            $bancoSensor->conectar("mysql", "DBJardim", "root", "");

            if($bancoCuidado->msgErro == ""){
                if($bancoCuidado->cadastrarCuidado($descricaoCuidado, $pontuacaoCuidado, $cuidadoItem)){
                    if($bancoCuidado->relacionamentoCuidadoItem($descricaoCuidado, $cuidadoItem)){
                        if($bancoCuidado->relacionamentoCuidadoMaterial($descricaoCuidado, $cuidadoMaterial)){
                            echo "
                                <div class='container1'>
                                    <div class='alert alert-success' role='alert'>
                                        Cuidado cadastrado com sucesso.
                                    </div>
                                </div>
                            ";
                        }else{
                            echo "<div class='container1'>
                                    <div class='alert alert-success' role='alert'>
                                        relacionamento não deu
                                    </div>
                                </div>";
    
                        }
                    }else{
                        
                        echo "<div class='container1'>
                        <div class='alert alert-success' role='alert'>
                            relacionamento  item não deu
                        </div>
                    </div>";
                    }
                }else{
                    echo "<div class='container1'>
                            <div class='alert alert-danger' role='alert'>
                                Cuidado já cadastrado.
                            </div>
                        </div>";
                }
            }else{
                echo "<div class='container1'>
                        <div class='alert alert-danger' role='alert'>
                            Erro: ".$banco->msgErro."
                        </div>
                    </div>";
            }
        }else{
            header('Location: ../../index.php');
        }
        include "../../include/areaAdmin/cabecalhoAdministrador.inc";
        include "../../include/areaAdmin/modalCadastroAmbiente.inc";
        include "../../include/areaAdmin/modalCadastroMaterial.inc";
        include "../../include/areaAdmin/modalCadastroSensor.inc";
        include "../../include/areaAdmin/modalCadastroCuidado.inc";
        include "../../include/areaAdmin/modalCadastroItem.inc";     
        include "../../include/areaAdmin/modalAcionaNecessidade2.inc";
        include "../../include/rodape.inc";
    ?>
    <!--Bibliotecas necessárias-->
    <script src = "../../js/jquery-3.3.1.min.js"></script>
    <script src = "../../js/popper.min.js"></script>
    <script src = "../../js/bootstrap.min.js"></script>
</html>