<?php
    class DenunciaI{

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

        public function cadastrarDenunciaI($codItem, $descricaoDenunciaI, $dataDenunciaI, $descricaoAcaoDenunciaI, $situacaoDenunciaI){

            global $pdo;
            global $msgErro;
            
            if(isset($_SESSION["codigoUsuario"])){
                $codigoUsuario = $_SESSION["codigoUsuario"];
            }else{
                $codigoUsuario = 1;
            }

            $sql=$pdo->prepare("INSERT INTO denunciaItem (codigoItem, codigoUsuario, dataDenunciaItem, descricaoDenunciaItem, 
                descricaoAcaoDenunciaItem, situacaoDenunciaItem) VALUES (:ca, :c, :d, :de, :da, :s)");
            $sql->bindValue(":ca", $codItem);
            $sql->bindValue(":c", $codigoUsuario);
            $sql->bindValue(":d", $dataDenunciaI);
            $sql->bindValue(":de", $descricaoDenunciaI);
            $sql->bindValue(":da", $descricaoAcaoDenunciaI);
            $sql->bindValue(":s", $situacaoDenunciaI);
            $sql->execute();
            return true;
        }

        public function recuperaDenunciaI(){
            global $pdo;
            global $msgErro;

            $dadosDenunciaI=array();
            $sql = $pdo->prepare("SELECT * FROM denunciaitem ORDER BY dataDenunciaItem DESC");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $dadosDenunciaI=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dadosDenunciaI;
            }else{
                return $dadosDenunciaI;
            }
        }

        public function excluir($codigo){
            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("DELETE FROM denunciaitem WHERE codigoDenunciaItem = :c");
            $sql->bindValue(":c", $codigo);
            $sql->execute();
        }
    }
?>