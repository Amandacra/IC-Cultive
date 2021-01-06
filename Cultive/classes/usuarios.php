<?php
    class Usuario{

        private $pdo;
        public $msgErro = "";
        
        //função para conectar a aplicação ao banco
        public function conectar($drive, $nomeBanco, $user, $pass){

            global $pdo;
            global $msgErro;

            try {
                $pdo = new PDO($drive.":host=localhost;dbname=".$nomeBanco,$user,$pass);
            } catch (PDOException $e) {
                $msgErro = "Erro com o banco de dados: ".$e->getMessage();
            } catch (Exception $e){
                $msgErro = "Erro na aplicação: ".$e->getMessage();
            }
        }

        public function cadastrar($nomeUsuario, $prontuarioUsuario, $emailUsuario, $senhaUsuario){

            global $pdo;
            global $msgErro; 

            $sql = $pdo->prepare("SELECT codigoUsuario FROM usuario WHERE emailUsuario = :e");
            $sql->bindValue(":e", $emailUsuario);
            $sql->execute();

            if($sql->rowCount()>0){
                return false;
            }else{
                $sql=$pdo->prepare("INSERT INTO usuario (nomeUsuario, prontuarioUsuario, emailUsuario, senhaUsuario, pontuacao) VALUES (:n, :p, :e, :s, :po)");
                $sql->bindValue(":n", $nomeUsuario);
                $sql->bindValue(":p", $prontuarioUsuario);
                $sql->bindValue(":e", $emailUsuario);
                $sql->bindValue(":s", md5($senhaUsuario));
                $sql->bindValue(":po", "0");
                $sql->execute();
                return true;
            }
        }

        public function logar($emailUsuario, $senhaUsuario){

            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("SELECT codigoUsuario FROM usuario WHERE emailUsuario = :e AND senhaUsuario = :s");
            $sql->bindValue(":e", $emailUsuario);
            $sql->bindValue(":s", md5($senhaUsuario));
            $sql->execute();

            if($sql->rowCount()>0){
                $codigoUsuario = $sql->fetch();
                $_SESSION["codigoUsuario"] = $codigoUsuario["codigoUsuario"];
                return true;
            }else{
                return false; 
            }
        }

        public function recuperaUsuario(){
            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("SELECT nomeUsuario, prontuarioUsuario, emailUsuario, pontuacao FROM usuario WHERE codigoUsuario = :c");
            $sql->bindValue(":c", $_SESSION["codigoUsuario"]);
            $sql->execute();

            if($sql->rowCount()>0){
                $usuarioLogin = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $usuarioLogin;
            }else{
                return false;
            }
        }

        public function recuperaRanking(){
            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("SELECT nomeUsuario, pontuacao FROM usuario WHERE codigoUsuario > 1 ORDER BY pontuacao DESC");
            $sql->execute();

            if($sql->rowCount()>0){
                $rankeados = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $rankeados;
            }else{
                return false;
            }
        }

        public function recuperaUsuarios(){
            global $pdo;
            global $msgErro;

            $dadosUsuario=array();
            $sql = $pdo->prepare("SELECT * FROM usuario ORDER BY codigoUsuario ASC");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $dadosUsuario=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dadosUsuario;
            }else{
                return $dadosUsuario;
            }
        }

        public function recuperaNomeUsuario($nome){
            global $pdo;
            global $msgErro;

            $noUsuario=array();
            $sql = $pdo->prepare("SELECT nomeUsuario FROM usuario WHERE codigoUsuario = :c");
            $sql->bindValue(":c", $nome);
            $sql->execute();
            
            if($sql->rowCount()>0){
                $noUsuario=$sql->fetch(PDO::FETCH_ASSOC);
                return $noUsuario;
            }
            return $noUsuario;
        }

        public function excluir($codigo){
            global $pdo;
            global $msgErro;

            //Deletando relacionamento atende necessidade
            $sql = $pdo->prepare("SELECT codigoNecessidade, codigoUsuario FROM atendenecessidade WHERE codigoUsuario = $codigo");
            $sql->execute();
            if($sql->rowCount()>0){
                $atendenecessidade=$sql->fetch(PDO::FETCH_ASSOC);
                for($i=0;$i<sizeof($atendenecessidade);$i++){
                    $sql = $pdo->prepare("DELETE FROM atendenecessidade WHERE codigoNecessidade = $atendenecessidade[$i] AND codigoUsuario = $codigo");
                    $sql->execute();
                }
            }

            //Deletando denuncias feitas ao ambiente por aquele usuário
            $sql = $pdo->prepare("SELECT codigoDenunciaAmbiente FROM denunciaambiente WHERE codigoUsuario = $codigo");
            $sql->execute();
            if($sql->rowCount()>0){
                $denunciaAmbienteExcluir=$sql->fetch(PDO::FETCH_ASSOC);
                for($i=0;$i<sizeof($denunciaAmbienteExcluir);$i++){
                    $sql = $pdo->prepare("DELETE FROM denunciaambiente WHERE codigoDenunciaAmbiente = $denunciaAmbienteExcluir[$i]");
                    $sql->execute();
                }
            }

            //Deletando denuncias feitas ao item por aquele usuário
            $sql = $pdo->prepare("SELECT codigoDenunciaItem FROM denunciaitem WHERE codigoUsuario = $codigo");
            $sql->execute();
            if($sql->rowCount()>0){
                $denunciaItemExcluir=$sql->fetch(PDO::FETCH_ASSOC);
                for($i=0;$i<sizeof($denunciaItemExcluir);$i++){
                    $sql = $pdo->prepare("DELETE FROM denunciaitem WHERE codigoDenunciaItem = $denunciaAmbienteExcluir[$i]");
                    $sql->execute();
                }
            }

            $sql = $pdo->prepare("DELETE FROM usuario WHERE codigoUsuario = :c");
            $sql->bindValue(":c", $codigo);
            $sql->execute();
        }
    }
?>