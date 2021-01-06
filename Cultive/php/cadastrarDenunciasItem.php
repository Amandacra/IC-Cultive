<?php
    session_start();
    
    require_once "../classes/denunciaI.php";
    $bancoDenunciaI = new DenunciaI;
    
    require_once "../classes/denunciaA.php";
    $bancoDenunciaA = new DenunciaA;

    require_once "../classes/Ambiente.php";
    $bancoAmbiente = new Ambiente;

    require_once "../classes/usuarios.php";
    $banco = new Usuario;

    require_once "../classes/item.php";
    $bancoItem = new Item;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Jardim Colaborativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/principal.css">
    <link rel="shortcut icon" type="image/x-icon" href="../Logo/FavIcon/ComFundo/favicon.ico">
</head>
<body background="../img/jardim_fundo.jpg">
    <?php
    
        if(isset($_POST['descricaoDenunciaI'])){
            
            $codItem = addslashes($_POST["codItem"]);
            $descricaoDenunciaI = addslashes($_POST["descricaoDenunciaI"]);
            $dataDenunciaI = addslashes($_POST["dataDenunciaI"]);
            $descricaoAcaoDenunciaI = addslashes($_POST["descricaoAcaoDenunciaI"]);
            $situacaoDenunciaI = addslashes($_POST["situacaoDenunciaI"]);

            $bancoDenunciaA->conectar("mysql", "DBJardim", "root", "");
            $bancoDenunciaI->conectar("mysql", "DBJardim", "root", "");
            $bancoAmbiente->conectar("mysql", "DBJardim", "root", "");
            $banco->conectar("mysql", "DBJardim", "root", "");
            $bancoItem->conectar("mysql", "DBJardim", "root", "");

            if(isset($_SESSION["codigoUsuario"])){
                include "../include/areaUsua/cabecalhoUsuaLogados1.inc";
                include "../include/modalDenunciaAmbiente2.inc";
                include "../include/modalDenunciaItem1.inc";
            }else{
                include "../include/areaAdmin/cabecalhoAdministrador2.inc";
            }

            if($bancoDenunciaI->msgErro == ""){
                $bancoDenunciaI->cadastrarDenunciaI($codItem, $descricaoDenunciaI, $dataDenunciaI, $descricaoAcaoDenunciaI, 
                    $situacaoDenunciaI);
                echo "<div class='container1'>
                        <div class='alert alert-success' role='alert'>
                            Denúncia cadastrada com sucesso.
                        </div>
                    </div>";
            }else{
                echo "<div class='container1'>
                        <div class='alert alert-danger' role='alert'>
                            Erro: ".$bancoDenunciaI->msgErro."
                        </div>
                    </div>";
            }
        }else{
            header('Location: ../index.php');
        }
        include "../include/rodape.inc";
    ?>

    <!--Bibliotecas necessárias-->
    <script src = "../js/jquery-3.3.1.min.js"></script>
    <script src = "../js/popper.min.js"></script>
    <script src = "../js/bootstrap.min.js"></script>
</html>