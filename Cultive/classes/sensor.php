<?php
    class Sensor{

        private $pdo;
        public $msgErro = "";

        //função para conectar a aplicação ao banco
        public function conectar($drive, $nomeBanco, $user, $pass){

            global $pdo;

            try {
                $pdo = new PDO($drive.":host=localhost;dbname=".$nomeBanco,$user,$pass);
            } catch (PDOException $e) {
                global $msgErro;
                $msgErro = "Erro com o banco: ".$e->getMessage();
            }catch (Exception $e){
                $msgErro = "Erro na aplicação: ".$e->getMessage();
            }
        }

        public function cadastrarSensor($URLSensor, $descricaoSensor){

            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("SELECT codigoSensor FROM sensor WHERE urlSensor = :u");
            $sql->bindValue(":u", $URLSensor);
            $sql->execute();

            if($sql->rowCount()>0){
                return false;
            }else{
                $sql=$pdo->prepare("INSERT INTO sensor (urlSensor, descricaoSensor) VALUES (:u, :d)");
                $sql->bindValue(":u", $URLSensor);
                $sql->bindValue(":d", $descricaoSensor);
                $sql->execute();
                return true;
            }
        }

        public function recuperaSensor(){
            global $pdo;
            global $msgErro;

            $dadosSensor=array();
            $sql = $pdo->prepare("SELECT * FROM sensor ORDER BY codigoSensor ASC");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $dadosSensor=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dadosSensor;
            }else{
                return $dadosSensor;
            }
        }

        public function excluir($codigo){
            global $pdo;
            global $msgErro;

            //Deletando o relacionamento entre a necessidade e o sensor
            $sql = $pdo->prepare("SELECT codigoSensor FROM sensorEmiteAlertaNecessidade WHERE codigoSensor = $codigo");
            $sql->execute();
            if($sql->rowCount()>0){
                $relacionamentoExcluir=$sql->fetch(PDO::FETCH_ASSOC);
                for($i=0;$i<sizeof($relacionamentoExcluir);$i++){
                    $sql = $pdo->prepare("DELETE FROM sensorEmiteAlertaNecessidade WHERE codigoSensor = $relacionamentoExcluir[$i]");
                    $sql->execute();
                }
            }

            //Deletando o relacionamento entre a necessidade e o sensor
            $sql = $pdo->prepare("DELETE FROM sensor WHERE codigoSensor = :c");
            $sql->bindValue(":c", $codigo);
            $sql->execute();
        }
    }
?>