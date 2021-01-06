<?php
    session_start();

    require_once "classes/usuarios.php";
    $banco = new Usuario;

    require_once "classes/Ambiente.php";
    $bancoAmbiente = new Ambiente;

    require_once "classes/item.php";
    $bancoItem = new Item;

    require_once "classes/material.php";
    $bancoMaterial = new Material;

    require_once "classes/cuidado.php";
    $bancoCuidado = new Cuidado;
    
    require_once "classes/sensor.php";
    $bancoSensor = new Sensor;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cultive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/principal.css">
    <link rel="shortcut icon" type="image/x-icon" href="Logo/FavIcon/ComFundo/favicon.ico"> 
</head>
<body background="img/jardim_fundo.jpg">

    <?php
        $banco->conectar("mysql", "DBJardim", "root", "");
        $bancoAmbiente->conectar("mysql", "DBJardim", "root", "");
        $bancoItem->conectar("mysql", "DBJardim", "root", "");
        $bancoMaterial->conectar("mysql", "DBJardim", "root", "");
        $bancoSensor->conectar("mysql", "DBJardim", "root", "");
        
        if(!isset($_SESSION['codigoUsuario']) && !isset($_SESSION['codigoAdmin'])){
            include "include/cabecalhoUsuaNLogados.inc";
            include "include/modalCadastrarLogar.inc";
            include "include/cardAmbiente1.inc";
        }else if(isset($_SESSION['codigoUsuario'])){
            $_SESSION['usuarioLogin']=$banco->recuperaUsuario();
            include "include/modalDenunciaAmbiente.inc";
            include "include/modalDenunciaItem.inc";
            include "include/cardAmbiente1.inc";
            echo '<nav class="navbar fixed-top mb-10 h1" id="corCabecalho">
                <span class="navbar-brand">
                    <img id="imagem" src="Logo/Colorido/Sem_Fundo/Logo_Cultive_Pequeno_407px_407px.png"/>
                </span>
                <p class="titulo">
                    Cultive - Jardim Colaborativo
                </p>
                <div class="float-right">
                    <p class="cabecalhoUsuaLogados">
                        Seja bem vindo(a) ';

                        if(count($_SESSION["usuarioLogin"])>0){
                            for($i = 0; $i < sizeof($_SESSION["usuarioLogin"]); $i++){
                                foreach ($_SESSION["usuarioLogin"][$i] as $key => $value){
                                    if($key == "nomeUsuario"){
                                        echo $value;
                                    }
                                }
                            }
                        }
                        
                echo '</p>
                <div class="btn-group" role="group" aria-label="Grupo de botões com dropdown aninhado">
                    <a role="button" class="btn btn-primary custom-btn" href="index.php">
                        Jardins
                    </a>
                    <a role="button" class="btn btn-primary custom-btn" href="php/areaUsua/Perfil.php">
                        Perfil
                    </a>
                    <a role="button" class="btn btn-primary custom-btn" href="php/areaUsua/Ranking.php">
                        Ranking
                    </a>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-primary custom-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Denunciar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDenunciaAmbiente">
                            Ambiente    /
                          </button>
                          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDenunciaItem">
                            Item
                          </button>
                        </div>
                    </div>
                    <a role="button" class="btn btn-primary custom-btn" href="php/sair.php">
                        Sair
                    </a>
                </div>
                </div>
            </nav>';
        }else{
            include "include/areaAdmin/cabecalhoAdministrador1.inc";
            include "include/areaAdmin/modalCadastroAmbiente1.inc";
            include "include/areaAdmin/modalCadastroMaterial1.inc";
            include "include/areaAdmin/modalCadastroSensor1.inc";
            include "include/areaAdmin/modalCadastroCuidado1.inc";
            include "include/areaAdmin/modalCadastroItem1.inc";
            include "include/modalDenunciaAmbiente.inc";
            include "include/modalCadastrarLogar.inc";
            include "include/cardAmbiente1.inc";
            include "include/areaAdmin/modalAcionaNecessidade.inc";
        }
    
        include "include/rodape.inc";
    ?>

    <!--Bibliotecas necessárias-->
    <script src = "js/jquery-3.3.1.min.js"></script>
    <script src = "js/popper.min.js"></script>
    <script src = "js/bootstrap.min.js"></script>
</body>
</html>