<?php
    session_start();
    require_once '../../classes/Ambiente.php';
    $bancoAmbiente = new Ambiente;

    require_once "../../classes/item.php";
    $bancoItem = new Item;

    require_once "../../classes/material.php";
    $bancoMaterial = new Material;

    require_once "../../classes/cuidado.php";
    $bancoCuidado = new Cuidado;
    
    require_once "../../classes/sensor.php";
    $bancoSensor = new Sensor;
?>

<!DOCTYPE html>
<html lang="pt-br">
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

        $bancoAmbiente->conectar("mysql", "DBJardim", "root", "");
        $bancoItem->conectar("mysql", "DBJardim", "root", "");
        $bancoCuidado->conectar("mysql", "DBJardim", "root", "");
        $bancoSensor->conectar("mysql", "DBJardim", "root", "");

        if(isset($_SESSION['codigoAdmin'])){
            include "../../include/areaAdmin/cabecalhoAdministrador.inc";
            include "../../include/areaAdmin/modalCadastroAmbiente.inc";
            include "../../include/areaAdmin/modalCadastroMaterial.inc";
            include "../../include/areaAdmin/modalCadastroSensor.inc";
            include "../../include/areaAdmin/modalCadastroCuidado.inc";
            include "../../include/areaAdmin/modalCadastroItem.inc";
            include "../../include/modalDenunciaAmbiente1.inc";
            include "../../include/modalCadastrarLogar2.inc";     
            include "../../include/areaAdmin/modalAcionaNecessidade2.inc";
        }else{
            header('Location: ../../index.php');
        }
        include "../../include/cardAmbiente2.inc";
        include "../../include/rodape.inc";
    ?>
    <!--Bibliotecas necessárias-->
    <script src = "../../js/jquery-3.3.1.min.js"></script>
    <script src = "../../js/popper.min.js"></script>
    <script src = "../../js/bootstrap.min.js"></script>
</body>
</html>