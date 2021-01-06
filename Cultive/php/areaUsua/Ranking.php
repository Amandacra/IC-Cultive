<?php
    session_start();

    require_once "../../classes/usuarios.php";
    $banco = new Usuario;

    require_once "../../classes/denunciaA.php";
    $bancoDenunciaA = new DenunciaA;

    require_once "../../classes/denunciaI.php";
    $bancoDenunciaI = new DenunciaI;

    require_once "../../classes/Ambiente.php";
    $bancoAmbiente = new Ambiente;

    require_once "../../classes/item.php";
    $bancoItem = new Item;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cultive - Ranking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/principal.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../Logo/FavIcon/ComFundo/favicon.ico">
</head>
<body background="../../img/jardim_fundo.jpg">
    <?php
        if(isset($_SESSION["codigoUsuario"])){
                
            $banco->conectar("mysql", "DBJardim", "root", "");
            include "../../include/areaUsua/cabecalhoUsuaLogados2.inc";
            include "../../include/modalDenunciaAmbiente1.inc";
            include "../../include/modalDenunciaItem1.inc";
            include "../../include/modalDenunciaAmbiente1.inc";
            ?>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Classificação</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Pontuação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $rankeados = $banco->recuperaRanking();
                                $cont=1;
                                if(count($rankeados)>0){
                                    for($i=0;$i<sizeof($rankeados);$i++){
                                        echo "<tr>";
                                        echo "<td>".$cont."</td>";
                                        foreach ($rankeados[$i] as $key => $value){
                                            $cont++;
                                            if($key == "nomeUsuario"){
                                                echo "<td>".$value."</td>";
                                            }else{
                                                echo "<td>".$value."</td>";
                                            }
                                        }
                                        echo "</tr>";
                                    }

                                }
                            ?>
                        </tbody>
                    </table>
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