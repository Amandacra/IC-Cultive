<?php

    require_once "../../classes/Ambiente.php";
    $bancoAmbiente = new Ambiente;
    
    require_once "../../classes/sensor.php";
    $bancoSensor = new Sensor;

    require_once "../../classes/cuidado.php";
    $bancoCuidado = new Cuidado;

    /*require_once "../classes/denunciaA.php";
    $bancoDenunciaA = new DenunciaA;*/

    require_once '../../classes/Material.php';
    $bancoMaterial = new Material;
    
    require_once "../../classes/item.php";
    $bancoItem = new Item;

    require_once "../../classes/usuarios.php";
    $banco = new Usuario;

    require_once "../../classes/DenunciaI.php";
    $bancoDenunciaI = new DenunciaI;

    $bancoAmbiente->conectar("mysql", "DBJardim", "root", "");
    $bancoSensor->conectar("mysql", "DBJardim", "root", "");
    $bancoCuidado->conectar("mysql", "DBJardim", "root", "");
    //$bancoDenunciaA->conectar("mysql", "DBJardim", "root", "");
    $bancoMaterial->conectar("mysql", "DBJardim", "root", "");
    $bancoItem->conectar("mysql", "DBJardim", "root", "");
    $banco->conectar("mysql", "DBJardim", "root", "");
    $bancoDenunciaI->conectar("mysql", "DBJardim", "root", "");

    if(isset($_GET['codigoAmbiente'])){
        
        $codigoAmbiente = addslashes($_GET['codigoAmbiente']);
        $bancoAmbiente->excluir($codigoAmbiente);
        header("Location: tabelaAmbientes.php"); 

    }else if(isset($_GET['codigoSensor'])){
        
        $codigoSensor = addslashes($_GET['codigoSensor']);
        $bancoSensor->excluir($codigoSensor);
        header("Location: tabelaSensores.php");

    }else if(isset($_GET['codigoCuidado'])){   
        
        $codigoCuidado = addslashes($_GET['codigoCuidado']);
        $bancoCuidado->excluir($codigoCuidado);
        header("Location: tabelaCuidados.php");

    }else if(isset($_GET['codigoDenunciaAmbiente'])){   
        
        $codigoDenunciaAmbiente = addslashes($_GET['codigoDenunciaAmbiente']);
        $bancoDenunciaA->excluir($codigoDenunciaAmbiente);
        header("Location: tabelaDenunciaA.php");

    }else if(isset($_GET['codigoDenunciaItem'])){   
        
        $codigoDenunciaItem = addslashes($_GET['codigoDenunciaItem']);
        $bancoDenunciaI->excluir($codigoDenunciaItem);
        header("Location: tabelaDenunciaI.php");

    }else if(isset($_GET['codigoMaterial'])){

        $codigoMaterial = addslashes($_GET['codigoMaterial']);
        $bancoMaterial->excluir($codigoMaterial);
        header("Location: tabelaMateriais.php");

    }else if(isset($_GET['codigoItem'])){

        $codigoItem = addslashes($_GET['codigoItem']);
        $bancoItem->excluir($codigoItem);
        header("Location: tabelaItens.php");

    }else if(isset($_GET['codigoUsuarios'])){

        $codigoUsuario = addslashes($_GET['codigoUsuarios']);
        $banco->excluir($codigoUsuario);
        header("Location: tabelaUsuarios.php");

    }else if(isset($_GET['codigoUsuario'])){

        $codigoUsuario = addslashes($_GET['codigoUsuario']);
        $banco->excluir($codigoUsuario);
        header("Location: ../sair.php");

    }else if(isset($_GET['codigoDenunciaI'])){

        $codigoDenunciaI = addslashes($_GET['codigoDenunciaI']);
        $bancoDenunciaI->excluir($codigoDenunciaI);
        header("Location: ../areaAdmin/tabelaDenunciaI.php");

    }

?>