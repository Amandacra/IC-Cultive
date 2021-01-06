<?php
    class DenunciaA{

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

        public function cadastrarDenunciaA($codAmbiente, $descricaoDenunciaA, $dataDenunciaA, $descricaoAcaoDenunciaA, $situacaoDenunciaA){

            global $pdo;
            global $msgErro;
            
            if(isset($_SESSION['codigoUsuario'])){
                $codigoUsuario = $_SESSION["codigoUsuario"];
            }else{
                $codigoUsuario = 1;
            }

            $sql1=$pdo->prepare("SELECT * FROM denunciaambiente WHERE descricaoDenunciaAmbiente = :d");
            $sql1->bindValue(":d", $descricaoDenunciaA);
            $sql1->execute();

            if($sql1->rowCount()>0){
                return false;
            }else{
                $sql=$pdo->prepare("INSERT INTO denunciaAmbiente (codigoAmbiente, codigoUsuario, dataDenunciaAmbiente, descricaoDenunciaAmbiente, 
                descricaoAcaoDenunciaAmbiente, situacaoDenunciaAmbiente) VALUES (:ca, :c, :d, :de, :da, :s)");
                $sql->bindValue(":ca", $codAmbiente);
                $sql->bindValue(":c", $codigoUsuario);
                $sql->bindValue(":d", $dataDenunciaA);
                $sql->bindValue(":de", $descricaoDenunciaA);
                $sql->bindValue(":da", $descricaoAcaoDenunciaA);
                $sql->bindValue(":s", $situacaoDenunciaA);
                $sql->execute();
                return true;
            }
        }

        public function recuperaDenunciaA(){
            global $pdo;
            global $msgErro;

            $dadosDenunciaA=array();
            $sql = $pdo->prepare("SELECT * FROM denunciaambiente ORDER BY dataDenunciaAmbiente DESC");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $dadosDenunciaA=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dadosDenunciaA;
            }else{
                return $dadosDenunciaA;
            }
        }

        public function excluir($codigo){
            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("DELETE FROM denunciaambiente WHERE codigoDenunciaAmbiente = :c");
            $sql->bindValue(":c", $codigo);
            $sql->execute();
        }
    }
?>