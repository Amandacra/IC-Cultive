<?php
    session_start();

    require_once "../classes/usuarios.php";
    $banco = new Usuario;

    require_once "../classes/Ambiente.php";
    $bancoAmbiente = new Ambiente;

    require_once "../classes/Item.php";
    $bancoItem = new Item;
    
    require_once "../classes/Material.php";
    $bancoMaterial = new Material;
    
    require_once "../classes/Cuidado.php";
    $bancoCuidado = new Cuidado;
    
    require_once "../classes/sensor.php";
    $bancoSensor = new Sensor;
    
    require_once "../classes/necessidade.php";
    $bancoNecessidade = new Necessidade;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cultive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/principal.css">
    <link rel="shortcut icon" type="image/x-icon" href="../Logo/FavIcon/ComFundo/favicon.ico"> <!--Utilizar o site http://tools.dynamicdrive.com/favicon/ para transformar o logo em favicon-->
</head>
<body background="../img/jardim_fundo.jpg">

    <?php
        $banco->conectar("mysql", "DBJardim", "root", "");
        $bancoAmbiente->conectar("mysql", "DBJardim", "root", "");
        $bancoItem->conectar("mysql", "DBJardim", "root", "");

        if(isset($_POST["codAmbiente"])){
            $_SESSION["codAmbiente"] = $_POST["codAmbiente"];
            include "../include/cardItem.inc";
            if(!isset($_SESSION['codigoUsuario']) && !isset($_SESSION['codigoAdmin'])){
                include "../include/cabecalhoUsuaNLogados1.inc";
                include "../include/modalCadastrarLogar1.inc";
            }else if(isset($_SESSION['codigoUsuario'])){
                include "../include/areaUsua/cabecalhoUsuaLogados1.inc";
                include "../include/modalDenunciaAmbiente2.inc";
                include "../include/modalDenunciaItem1.inc";
            }else{
                //cabecalho admin
                $bancoCuidado->conectar("mysql", "DBJardim", "root", "");
                $bancoSensor->conectar("mysql", "DBJardim", "root", "");
                include "../include/areaAdmin/cabecalhoAdministrador2.inc";
                include "../include/areaAdmin/modalCadastroAmbiente2.inc";
                include "../include/areaAdmin/modalCadastroCuidado2.inc";
                include "../include/areaAdmin/modalCadastroItem2.inc";
                include "../include/areaAdmin/modalCadastroMaterial2.inc";
                include "../include/areaAdmin/modalCadastroSensor2.inc";
                include "../include/areaAdmin/modalAcionaNecessidade1.inc";
            }
        }else{
            header ("Location: ../index.php");
        }
        include "../include/rodape.inc";
    ?>
    <!--Bibliotecas necessárias-->
    <script src = "../js/jquery-3.3.1.min.js"></script>
    <script src = "../js/popper.min.js"></script>
    <script src = "../js/bootstrap.min.js"></script>
</body>
</html>