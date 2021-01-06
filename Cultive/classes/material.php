<?php
    class Material{

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

        public function cadastrarMaterial($nomeMaterial, $descricaoMaterial){

            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("SELECT codigoMaterial FROM material WHERE nomeMaterial = :n");
            $sql->bindValue(":n", $nomeMaterial);
            $sql->execute();

            if($sql->rowCount()>0){
                return false;
            }else{
                $sql=$pdo->prepare("INSERT INTO material (nomeMaterial, descricaoMaterial) VALUES (:n, :d)");
                $sql->bindValue(":n", $nomeMaterial);
                $sql->bindValue(":d", $descricaoMaterial);
                $sql->execute();
                return true;
            }
        }

        public function recuperaTodosMateriais(){ 
            global $pdo;
            global $msgErro;

            $_SESSION["dadosTodosMateriais"]=array();
            $sql = $pdo->prepare("SELECT * FROM material ORDER BY nomeMaterial DESC");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $_SESSION["dadosTodosMateriais"]=$sql->fetchAll(PDO::FETCH_ASSOC);
                return true;
            }else{
                return false;
            }
        }
        
        public function recuperaMateriais(){
            global $pdo;
            global $msgErro;

            $dadosTodosMateriais=array();
            $sql = $pdo->prepare("SELECT * FROM material ORDER BY nomeMaterial DESC");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $dadosTodosMateriais=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dadosTodosMateriais;
            }else{
                return $dadosTodosMateriais;
            }
        }

        public function excluir($codigo){
            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("DELETE FROM material WHERE codigoMaterial = :c");
            $sql->bindValue(":c", $codigo);
            $sql->execute();
        }
    }
?>