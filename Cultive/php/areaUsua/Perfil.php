<?php
    session_start();

    require_once "../../classes/usuarios.php";
    $banco = new Usuario;

    require_once "../../classes/Ambiente.php";
    $bancoAmbiente = new Ambiente;

    require_once "../../classes/Item.php";
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
            ?>
            <div class="tabela col-xs-10 offset-xs-1 col-sm-10 offset-sm-10 col-md-15 offset-md-1" id="tabela">
                <div class="table-responsive">

                    <div class="perfil">
                        
                    </div>

                    <!--Dados pessoais-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="row">Nome</th>
                                <td>
                                    <?php
                                        if(count($_SESSION["usuarioLogin"])>0){
                                            for($i = 0; $i < sizeof($_SESSION["usuarioLogin"]); $i++){
                                                foreach ($_SESSION["usuarioLogin"][$i] as $key => $value){
                                                    if($key == "nomeUsuario"){
                                                        echo $value;
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Prontuário</th>
                                <td>
                                    <?php
                                        if(count($_SESSION["usuarioLogin"])>0){
                                            for($i = 0; $i < sizeof($_SESSION["usuarioLogin"]); $i++){
                                                foreach ($_SESSION["usuarioLogin"][$i] as $key => $value){
                                                    if($key == "prontuarioUsuario"){
                                                        echo $value;
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">E-mail</th>
                                <td>
                                    <?php
                                        if(count($_SESSION["usuarioLogin"])>0){
                                            for($i = 0; $i < sizeof($_SESSION["usuarioLogin"]); $i++){
                                                foreach ($_SESSION["usuarioLogin"][$i] as $key => $value){
                                                    if($key == "emailUsuario"){
                                                        echo $value;
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Pontuação</th>
                                <td>
                                    <?php
                                        if(count($_SESSION["usuarioLogin"])>0){
                                            for($i = 0; $i < sizeof($_SESSION["usuarioLogin"]); $i++){
                                                foreach ($_SESSION["usuarioLogin"][$i] as $key => $value){
                                                    if($key == "pontuacao"){
                                                        echo $value;
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Ação</td>
                                <td id="excluir"><a role="button" class="btn btn-primary custom-btn" onclick="excluir()"> Excluir Perfil</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            include "../../include/rodape.inc";
        }else{
            header('Location:../../index.php');
        }
    ?>
    <!--Bibliotecas necessárias-->
    <script src = "../../js/jquery-3.3.1.min.js"></script>
    <script src = "../../js/popper.min.js"></script>
    <script src = "../../js/bootstrap.min.js"></script>
</body>
</html>

<script>
    function excluir(){
        var resposta=confirm("Tem certeza que deseja excluir seu perfil? Todos seus dados incluindo sua pontuação serão apagados definitivamente.");
        if (resposta==true){
            window.location.href = "../areaAdmin/excluir.php?codigoUsuario=<?php echo $_SESSION["codigoUsuario"];?>";
        }
    }
</script>