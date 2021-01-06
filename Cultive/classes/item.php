<?php
    class Item{

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

        public function cadastrarItem($nomeItem, $descricaoItem, $ambienteItem){

            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("SELECT codigoItem FROM item WHERE nomeItem = :n AND descricaoItem = :d AND codigoAmbiente = :c");
            $sql->bindValue(":n", $nomeItem);
            $sql->bindValue(":d", $descricaoItem);
            $sql->bindValue(":c", $ambienteItem);
            $sql->execute();

            if($sql->rowCount()>0){
                return false;
            }else{
                $sql=$pdo->prepare("INSERT INTO item (nomeItem, descricaoItem, codigoAmbiente) VALUES (:n, :d, :a)");
                $sql->bindValue(":n", $nomeItem);
                $sql->bindValue(":d", $descricaoItem);
                $sql->bindValue(":a", $ambienteItem);
                $sql->execute();
                return true;
            }
        }

        public function recuperaItem($codAmbiente){
            global $pdo;
            global $msgErro;

            $dadosItem=array();
            $sql = $pdo->prepare("SELECT * FROM item WHERE codigoAmbiente = :c"); 
            $sql->bindValue(":c", $codAmbiente);
            $sql->execute();
            
            if($sql->rowCount()>0){
                $dadosItem=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dadosItem;
            }else{
                return $dadosItem;
            }
        }

        public function recuperaNomeAmbienteItem($cod){
            global $pdo;
            global $msgErro;

            $noAmbiente=array();
            $sql = $pdo->prepare("SELECT nomeAmbiente FROM ambiente INNER JOIN item ON codigoItem = :c");
            $sql->bindValue(":c", $cod);
            $sql->execute();
            
            if($sql->rowCount()>0){
                $noAmbiente=$sql->fetch(PDO::FETCH_ASSOC);
                return $noAmbiente;
            }
            return $noAmbiente;
        }

        public function recuperaNome($cod){
            global $pdo;
            global $msgErro;

            $noAmbiente=array();
            $sql = $pdo->prepare("SELECT nomeAmbiente FROM ambiente WHERE codigoAmbiente = :c");
            $sql->bindValue(":c", $cod);
            $sql->execute();
            
            if($sql->rowCount()>0){
                $noAmbiente=$sql->fetch(PDO::FETCH_ASSOC);
                return $noAmbiente;
            }
            return $noAmbiente;
        }

        public function recuperaNomeItem($cod){
            global $pdo;
            global $msgErro;

            $dadosItem=array();
            $sql = $pdo->prepare("SELECT nomeItem FROM item WHERE codigoItem = :c"); 
            $sql->bindValue(":c", $cod);
            $sql->execute();
            
            if($sql->rowCount()>0){
                $dadosItem=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dadosItem;
            }else{
                return $dadosItem;
            }
        }

        public function recuperaTodosItens(){
            global $pdo;
            global $msgErro;

            $_SESSION["dadosTodosItens"]=array();
            $sql = $pdo->prepare("SELECT * FROM item ORDER BY nomeItem ASC");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $_SESSION["dadosTodosItens"]=$sql->fetchAll(PDO::FETCH_ASSOC);
                return true;
            }else{
                return false;
            }
        }

        public function excluir($codigo){
            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("DELETE FROM item WHERE codigoItem = :c");
            $sql->bindValue(":c", $codigo);
            $sql->execute();
        }
    }
?>