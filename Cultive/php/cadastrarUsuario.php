<?php
    require_once '../classes/usuarios.php';
    $banco = new Usuario;
    
    require_once "../classes/Cuidado.php";
    $bancoCuidado = new Cuidado;
    
    require_once "../classes/sensor.php";
    $bancoSensor = new Sensor;
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
</head>
<body background="../img/jardim_fundo.jpg">
    <?php

        include "../include/cabecalhoUsuaNLogados1.inc";
        include "../include/modalCadastrarLogar1.inc";

        if(isset($_POST['nomeUsuario'])){
            $nomeUsuario = addslashes($_POST["nomeUsuario"]);
            $prontuarioUsuario = addslashes($_POST["prontuarioUsuario"]);
            $emailUsuario = addslashes($_POST["emailUsuario"]);
            $senhaUsuario = addslashes($_POST["senhaUsuario"]);
            $confirmSenha = addslashes($_POST["confirmSenha"]);

            $banco->conectar("mysql", "DBJardim", "root", "");

            if($banco->msgErro == ""){
                if($senhaUsuario == $confirmSenha){ 
                    if($banco->cadastrar($nomeUsuario, $prontuarioUsuario, $emailUsuario, $senhaUsuario)){
                        echo "<div class='container1'>
                            <div class='alert alert-success' role='alert'>
                                Usuário cadastrado com sucesso. Faça o login para entrar.
                            </div>
                        </div>";
                    }else{
                        echo "<div class='container1'>
                                <div class='alert alert-danger' role='alert'>
                                    já há alguém cadastrado com esses dados.
                                </div>
                            </div>";
                    }
                }else{
                    echo "<div class='container1'>
                            <div class='alert alert-danger' role='alert'>
                                Senha e confirmar senha não correspondem.
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
            header('Location: ../index.php');
        }

        
        if(isset($_SESSION["codigoAdmin"])){
            $bancoCuidado->conectar("mysql", "DBJardim", "root", "");
            $bancoSensor->conectar("mysql", "DBJardim", "root", "");

            include "../include/areaAdmin/modalAcionaNecessidade1.inc";
        }

        include "../include/rodape.inc";
    ?>

    <!--Bibliotecas necessárias-->
    <script src = "../js/jquery-3.3.1.min.js"></script>
    <script src = "../js/popper.min.js"></script>
    <script src = "../js/bootstrap.min.js"></script>
</html>