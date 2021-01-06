<?php
    session_start();

    require_once "../../classes/DenunciaI.php";
    $bancoDenunciaI = new DenunciaI;

    require_once "../../classes/Item.php";
    $bancoItem = new Item;

    require_once "../../classes/Usuarios.php";
    $banco = new Usuario;

    require_once '../../classes/Material.php';
    $bancoMaterial = new Material;

    require_once "../../classes/Ambiente.php";
    $bancoAmbiente = new Ambiente;

    require_once "../../classes/cuidado.php";
    $bancoCuidado = new Cuidado;
    
    require_once "../../classes/sensor.php";
    $bancoSensor = new Sensor;
?>

<!DOCTYPE html>
<html>
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
        if(isset($_SESSION["codigoAdmin"])){
                
            $bancoDenunciaI->conectar("mysql", "DBJardim", "root", "");
            $bancoItem->conectar("mysql", "DBJardim", "root", "");
            $banco->conectar("mysql", "DBJardim", "root", "");
            $bancoCuidado->conectar("mysql", "DBJardim", "root", "");
            $bancoSensor->conectar("mysql", "DBJardim", "root", "");

            include "../../include/areaAdmin/cabecalhoAdministrador.inc";
            include "../../include/areaAdmin/modalCadastroAmbiente.inc";
            include "../../include/areaAdmin/modalCadastroMaterial.inc";
            include "../../include/areaAdmin/modalCadastroSensor.inc";
            include "../../include/areaAdmin/modalCadastroCuidado.inc";
            include "../../include/areaAdmin/modalCadastroItem.inc";            
            include "../../include/areaAdmin/modalAcionaNecessidade2.inc";

    ?>
    <div class="tabela col-xs-10 offset-xs-1 col-sm-10 offset-sm-10 col-md-15 offset-md-1" id="tabela">
        <div class="table-responsive">
            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Item</th>
                            <th scope="col">Ambiente</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Data</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Reparo</th>
                            <th scope="col">Situação</th>
                            <th scope="col">Remover</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $denuncias = $bancoDenunciaI->recuperaDenunciaI();
                            if(count($denuncias)>0){
                                for($i=0;$i<sizeof($denuncias);$i++){
                                    echo '<tr>';
                                    foreach ($denuncias[$i] as $key => $value){
                                        if($key == "codigoDenunciaItem"){
                                            echo "<td>".$value."</td>";
                                        }else if($key == "codigoItem"){
                                            $nomeItem = $bancoItem->recuperaNomeItem($value);
                                            if(count($nomeItem)>0){
                                                for($j=0;$j<sizeof($nomeItem);$j++){
                                                    foreach($nomeItem[$j] as $nomedoitem => $chave){
                                                        if($nomedoitem == "nomeItem"){
                                                            echo "<td>". $chave ."</td>";
                                                        }
                                                    }
                                                }
                                            }
                                            $nomeAmbiente = $bancoItem->recuperaNomeAmbienteItem($value);
                                            if(count($nomeAmbiente)>0){
                                                foreach($nomeAmbiente as $nome){
                                                    echo "<td>". $nome ."</td>";
                                                }
                                            }
                                        }else if($key == "codigoUsuario"){
                                            $nomeUsuario = $banco->recuperaNomeUsuario($value);
                                            if(count($nomeUsuario)>0){
                                                foreach($nomeUsuario as $nome){
                                                    echo "<td>". $nome ."</td>";
                                                }
                                            }
                                        }else if($key == "dataDenunciaItem"){
                                            echo "<td>". date("d/m/Y", strtotime($value)) ."</td>";
                                        }else if($key == "descricaoDenunciaItem"){
                                            echo "<td>". $value ."</td>";
                                        }else if($key == "descricaoAcaoDenunciaItem"){
                                            echo "<td>". $value ."</td>";
                                        }else if($key == "situacaoDenunciaItem"){
                                            echo "<td>". $value ."</td>";
                                        }
                                    }
                                    ?>
                                        <td> 
                                            <a role="button" class="btn btn-primary custom-btn" href="excluir.php?codigoDenunciaI=<?php echo $denuncias[$i]['codigoDenunciaItem'];?>"> Excluir </a>
                                        </td>
                                    <?php
                                    echo '</tr>';
                                }
                            }else{
                                echo '<td colspan="10" align="center">Não há denúncias cadastradas ainda</td>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
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