<?php
    session_start();

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
    
        if(isset($_POST['codAmbiente'])){
            
            $codAmbiente = addslashes($_POST["codAmbiente"]);
            $descricaoDenunciaA = addslashes($_POST["descricaoDenunciaA"]);
            $dataDenunciaA = addslashes($_POST["dataDenunciaA"]);
            $descricaoAcaoDenunciaA = addslashes($_POST["descricaoAcaoDenunciaA"]);
            $situacaoDenunciaA = addslashes($_POST["situacaoDenunciaA"]);

            $bancoDenunciaA->conectar("mysql", "DBJardim", "root", "");
            $bancoAmbiente->conectar("mysql", "DBJardim", "root", "");
            $banco->conectar("mysql", "DBJardim", "root", "");
            
            if(isset($_SESSION["codigoAdmin"])){
                include "../include/areaAdmin/cabecalhoAdministrador2.inc";
            }else{
                include "../include/areaUsua/cabecalhoUsuaLogados1.inc";
                include "../include/modalDenunciaAmbiente2.inc";
                include "../include/modalDenunciaItem1.inc";
            }

            if($bancoDenunciaA->msgErro == ""){
                if($bancoDenunciaA->cadastrarDenunciaA($codAmbiente, $descricaoDenunciaA, $dataDenunciaA, $descricaoAcaoDenunciaA, 
                    $situacaoDenunciaA)){
                    echo "<div class='container1'>
                            <div class='alert alert-success' role='alert'>
                                Denúncia cadastrada com sucesso.
                            </div>
                        </div>";
                }else{
                    echo "<div class='container1'>
                            <div class='alert alert-danger' role='alert'>
                                Denúncia já cadastrada.
                            </div>
                        </div>";
                }
            }else{
                echo "<div class='container1'>
                        <div class='alert alert-danger' role='alert'>
                            Erro: ".$bancoDenunciaA->msgErro."
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