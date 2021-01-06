<?php
    session_start();
    require_once '../classes/usuarios.php';
    $banco = new Usuario;

    require_once '../classes/Ambiente.php';
    $bancoAmbiente = new Ambiente;

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
    <link rel="shortcut icon" type="image/x-icon" href="../Logo/FavIcon/ComFundo/favicon.ico"> <!--Utilizar o site http://tools.dynamicdrive.com/favicon/ para transformar o logo em favicon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body background="../img/jardim_fundo.jpg">
    <?php

        if(isset($_POST['emailUsuario'])){

            $emailUsuarioLogin = addslashes($_POST['emailUsuario']);
            $senhaUsuarioLogin = addslashes($_POST['senhaUsuario']);
            
            //se é admin
            if($emailUsuarioLogin == 'admin@admin.com' && $senhaUsuarioLogin == 'admin123'){
                $_SESSION['codigoAdmin']='admin';
                header('Location: areaAdmin/areaAdmin.php');
            }else{
                $banco->conectar("mysql", "DBJardim", "root", "");
                if($banco->msgErro == ""){

                    if($banco->logar($emailUsuarioLogin, $senhaUsuarioLogin)){
                        
                    }else{
                        echo "<div class='container1'>
                                <div class='alert alert-danger' role='alert'>
                                    E-mail e/ou senha estão incorretos.
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
            }
        }else{
            header('Location: ../index.php');
        }
        
        if(!isset($_SESSION['codigoUsuario'])){
            include "../include/cabecalhoUsuaNLogados1.inc";
            include "../include/modalCadastrarLogar1.inc";
        }else{
            include "../include/areaUsua/cabecalhoUsuaLogados1.inc";
            include "../include/modalDenunciaAmbiente2.inc";
            include "../include/modalDenunciaItem1.inc";
            include "../include/cardAmbiente.inc";
        }

        include "../include/rodape.inc";
    ?>

    <!--Bibliotecas necessárias-->
    <script src = "../js/jquery-3.3.1.min.js"></script>
    <script src = "../js/popper.min.js"></script>
    <script src = "../js/bootstrap.min.js"></script>
</body>
</html>