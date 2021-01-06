<?php
    class Ambiente{

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

        public function cadastrarAmbiente($nomeAmbiente, $descricaoAmbiente, $localizacaoAmbiente, $dimensoes){

            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("SELECT codigoAmbiente FROM ambiente WHERE nomeAmbiente = :n OR localizacaoAmbiente = :l");
            $sql->bindValue(":n", $nomeAmbiente);
            $sql->bindvalue(":l", $localizacaoAmbiente);
            $sql->execute();

            if($sql->rowCount()>0){
                return false;
            }else{
                $sql=$pdo->prepare("INSERT INTO ambiente (nomeAmbiente, descricaoAmbiente, localizacaoAmbiente, dimensaoAmbiente) 
                    VALUES (:n, :d, :l, :di)");
                $sql->bindValue(":n", $nomeAmbiente);
                $sql->bindValue(":d", $descricaoAmbiente);
                $sql->bindValue(":l", $localizacaoAmbiente);
                $sql->bindValue(":di", $dimensoes);
                $sql->execute();
                return true;
            }
        }

        public function recuperaAmbiente(){
            global $pdo;
            global $msgErro;

            $dadosAmbiente=array();
            $sql = $pdo->prepare("SELECT * FROM ambiente ORDER BY codigoAmbiente ASC");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $dadosAmbiente=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dadosAmbiente;
            }else{
                return $dadosAmbiente;
            }
        }

        public function excluir($codigo){
            global $pdo;
            global $msgErro;

            //Deletando o relacionamento entre o item que pertence ao ambiente a ser excluido e o cuidado
            $sql = $pdo->prepare("SELECT codigoAmbiente FROM ItemAmbientePrecisaCuidado WHERE codigoAmbiente = $codigo");
            $sql->execute();
            if($sql->rowCount()>0){
                $relacionamentoExcluir=$sql->fetch(PDO::FETCH_ASSOC);
                for($i=0;$i<sizeof($relacionamentoExcluir);$i++){
                    $sql = $pdo->prepare("DELETE FROM ItemAmbientePrecisaCuidado WHERE codigoAmbiente = $relacionamentoExcluir[$i]");
                    $sql->execute();
                }
            }

            //Deletando as denuncias referentes ao item que pertence ao ambiente a ser excluido
            $sql = $pdo->prepare("SELECT codigoItem FROM item WHERE codigoAmbiente = $codigo");
            $sql->execute();
            if($sql->rowCount()>0){
                $recuperaItem=$sql->fetch(PDO::FETCH_ASSOC);
                for($i=0;$i<sizeof($recuperaItem);$i++){
                    $sql1 = $pdo->prepare("SELECT codigoDenunciaItem FROM denunciaItem WHERE codigoItem = $recuperaItem[$i]");
                    $sql1->execute();
                    if($sql1->rowCount()>0){
                        $sql1 = $pdo->prepare("DELETE FROM denunciaItem WHERE codigoDenunciaItem = $recuperaItem[$i]");
                        $sql1->execute();
                    }
                    //Deletando as necessidades deste item
                    $sql2 = $pdo->prepare("SELECT codigoNecessidade FROM necessidade WHERE codigoItem = $recuperaItem[$i]");
                    $sql2->execute();
                    if($sql2->rowCount()>0){
                        $sql2 = $pdo->prepare("DELETE FROM necessidade WHERE codigoItem = $recuperaItem[$i]");
                        $sql2->execute();
                    }
                    //Deletando cada item do ambiente
                    $sql3 = $pdo->prepare("DELETE FROM item WHERE codigoItem = $recuperaItem[$i]");
                    $sql3->execute();
                }
            }
            
            //Deletando cada denuncia do ambiente
            $sql = $pdo->prepare("SELECT codigoDenunciaAmbiente FROM denunciaAmbiente WHERE codigoAmbiente = $codigo");
            $sql->execute();
            if($sql->rowCount()>0){
                $denunciaExcluir=$sql->fetch(PDO::FETCH_ASSOC);
                for($i=0;$i<sizeof($denunciaExcluir);$i++){
                    $sql = $pdo->prepare("DELETE FROM denunciaAmbiente WHERE codigoDenunciaAmbiente = $denunciaExcluir[$i]");
                    $sql->execute();
                }
            }

            $sql = $pdo->prepare("DELETE FROM ambiente WHERE codigoAmbiente = :c");
            $sql->bindValue(":c", $codigo);
            $sql->execute();
        }
    }
?>