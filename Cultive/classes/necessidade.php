<?php
    class Necessidade{

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

        public function cadastrarNecessidade($codItem, $codSensor, $codCuidado, $status, $data, $horario){

            global $pdo;
            global $msgErro;

            //Verifica se a necessidade já foi acionada
            $sql=$pdo->prepare("SELECT codigoNecessidade FROM necessidade WHERE codigoItem = $codItem AND statusNecessidade = $status AND codigoCuidado = $codCuidado");
            $sql->execute();
            
            if($sql->rowCount()>0){
                return false;
            }else{
                //Se não há necessidade igual insere
                $sql=$pdo->prepare("INSERT INTO necessidade (codigoItem, codigoSensor, codigoCuidado, statusNecessidade, dataNecessidade, horarioNecessidade) VALUES ('$codItem', '$codSensor', '$codCuidado', '$status', '$data', '$horario')");
                $sql->execute();

                return true;
            }
        }

        public function cadastrarAlerta($codItem, $codSensor, $codCuidado, $status){

            global $pdo;
            global $msgErro;

            //recupera o codigo da necessidade
            $sql=$pdo->prepare("SELECT codigoNecessidade FROM necessidade WHERE codigoItem = $codItem AND statusNecessidade = $status AND codigoCuidado = $codCuidado");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $codNecessidade = array();
                $codNecessidade = $sql->fetchAll(PDO::FETCH_ASSOC);

                for($i=0;$i<sizeof($codNecessidade);$i++){
                    //Aciona o alerta
                    foreach ($codNecessidade[$i] as $key => $value){
                        $sql=$pdo->prepare("INSERT INTO sensoremitealertanecessidade (codigoSensor, codigoNecessidade) VALUES ($codSensor, $value)");
                        $sql->execute();
                    }
                }

                return true;
            }else{
                return false;
            }
        }

        public function selecionaItem($codItem, $codSensor, $codCuidado, $status){

            global $pdo;
            global $msgErro;

            //recupera o codigo da necessidade
            $sql=$pdo->prepare("SELECT nomeItem, nomeAmbiente, descricaoCuidado, pontuacaoCuidado, n.codigoNecessidade FROM necessidade as n INNER JOIN item as i ON n.codigoItem = i.codigoItem INNER JOIN ambiente as a ON i.codigoAmbiente = a.codigoAmbiente INNER JOIN cuidado as c ON n.codigoCuidado = c.codigoCuidado WHERE statusNecessidade ='0'");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $_SESSION['dadosNecessidade'] = array();
                $_SESSION['dadosNecessidade'] = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                return $_SESSION['dadosNecessidade'];
            }else{
                return false;
            }
        }

        public function atendeNecessidade($codigoN, $data, $horario, $status, $codigoUsuario, $pontuacaoC){

            global $pdo;
            global $msgErro;

            $sql=$pdo->prepare("INSERT INTO atendenecessidade VALUES ('$codigoN', '$codigoUsuario', '$data', '$horario')");
            $sql->execute();
            
            $sql=$pdo->prepare("UPDATE necessidade SET statusNecessidade = '$status' WHERE codigoNecessidade = '$codigoN'");
            $sql->execute();
            
            $sql=$pdo->prepare("SELECT pontuacao FROM usuario WHERE codigoUsuario = $codigoUsuario");
            $sql->execute();

            $pontuacao = $sql->fetchAll(PDO::FETCH_ASSOC);
            $pontuacaoOficial=0;
            for($i=0;$i<sizeof($pontuacao);$i++){
                foreach ($pontuacao[$i] as $key => $value){
                    if($key == "pontuacao"){
                        $pontuacaoOficial = $value;
                    }
                }
            }

            $pontuacaoOficial+=$pontuacaoC;

            $sql=$pdo->prepare("UPDATE usuario SET pontuacao = '$pontuacaoOficial' WHERE codigoUsuario = $codigoUsuario");
            $sql->execute();

            $pontuacaoOficial=0;

            return true;
        }

        public function selecionaItemNecessidade($codigo){

            global $pdo;
            global $msgErro;

            //recupera o codigo da necessidade
            $sql=$pdo->prepare("SELECT nomeItem, descricaoCuidado, pontuacaoCuidado, codigoNecessidade FROM necessidade as n INNER JOIN cuidado as c ON n.codigoCuidado = c.codigoCuidado INNER JOIN item as i ON n.codigoItem = i.codigoItem WHERE statusNecessidade ='0'");
            $sql->execute();
            $botao = array();
            
            if($sql->rowCount()>0){
                $botao = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                return $botao;
            }
        }
    }
?>