<?php
    class Cuidado{

        private $pdo;
        public $msgErro = "";

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

        public function cadastrarCuidado($descricaoCuidado, $pontuacaoCuidado, $cuidadoItem){

            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("SELECT codigoCuidado FROM cuidado WHERE descricaoCuidado = :d");
            $sql->bindValue(":d", $descricaoCuidado);
            $sql->execute();

            if($sql->rowCount()>0){
                return false;
            }else{
                $sql = $pdo->prepare("INSERT INTO cuidado (descricaoCuidado, pontuacaoCuidado) VALUES (:d, :p)");
                $sql->bindValue(":d", $descricaoCuidado);
                $sql->bindValue(":p", $pontuacaoCuidado);
                $sql->execute();
                return true;
            }
        }

        public function relacionamentoCuidadoItem($descricaoCuidado, $cuidadoItem){
            global $pdo;
            global $msgErro;

            $codigoCuidado=array();
            $codigoItem=array();
            $codigoAmbiente=array();

            $sql = $pdo->prepare("SELECT codigoCuidado FROM cuidado WHERE descricaoCuidado = :d"); 
            $sql->bindValue(":d", $descricaoCuidado);
            $sql->execute();

            $sql1 = $pdo->prepare("SELECT codigoAmbiente FROM item WHERE codigoItem = :c");
            $sql1->bindValue(":c", $cuidadoItem);
            $sql1->execute();

            if(($sql->rowCount()>0) && ($sql1->rowCount()>0)){
                //variável com todos os dados da consulta
                $dadosCuidado=$sql->fetchAll(PDO::FETCH_ASSOC);
                $dadosItem=$sql1->fetchAll(PDO::FETCH_ASSOC);

                //Atribuição dos dados em variáveis separadas
                for($i = 0; $i < sizeof($dadosCuidado); $i++){
                    foreach ($dadosCuidado[$i] as $key => $value){
                        if($key == "codigoCuidado"){
                            $codigoCuidado = $value;
                        }
                    }
                }

                for($i = 0; $i < sizeof($dadosItem); $i++){
                    foreach ($dadosItem[$i] as $key => $value){
                        if($key == "codigoAmbiente"){
                            $codigoAmbiente = $value;
                        }
                    }
                }

                $sql = $pdo->prepare("INSERT INTO ItemAmbientePrecisaCuidado (codigoCuidado, codigoItem, codigoAmbiente) VALUES (:cc, :ci, :ca)");
                $sql->bindValue(":cc", $codigoCuidado);
                $sql->bindValue(":ci", $cuidadoItem);
                $sql->bindValue(":ca", $codigoAmbiente);
                $sql->execute();
                return true;
            }else{
                return false;
            }
        }


        public function relacionamentoCuidadoMaterial($descricaoCuidado, $cuidadoMaterial){
            global $pdo;
            global $msgErro;

            $codigoCuidado=array();
            $codigoMaterial=array();
            $sql = $pdo->prepare("SELECT codigoCuidado FROM cuidado WHERE descricaoCuidado = :d");
            $sql->bindValue(":d", $descricaoCuidado);
            $sql->execute();

            if($sql->rowCount()>0){
                $codigoCuidado=$sql->fetch(PDO::FETCH_ASSOC);
                
                foreach ($codigoCuidado as $key){
                    $var = $key;
                }

                $sql = $pdo->prepare("INSERT INTO cuidadoMaterial (codigoCuidado, codigoMaterial) VALUES (:cc, :ci)");
                $sql->bindValue(":cc", $var);
                $sql->bindValue(":ci", $cuidadoMaterial);
                $sql->execute();
                return true;
            }else{
                return false;
            }
        }

        public function recuperaCuidado(){
            global $pdo;
            global $msgErro;

            $dadosCuidado=array();
            $sql = $pdo->prepare("SELECT * FROM cuidado ORDER BY codigoCuidado ASC");
            $sql->execute();
            
            if($sql->rowCount()>0){
                $dadosCuidado=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dadosCuidado;
            }else{
                return $dadosCuidado;
            }
        }

        public function excluir($codigo){
            global $pdo;
            global $msgErro;

            //Deletando relacionamento cuidado e material
            $sql = $pdo->prepare("SELECT codigoCuidado FROM cuidadomaterial WHERE codigoCuidado = $codigo");
            $sql->execute();
            if($sql->rowCount()>0){
                $cuidadomaterialExcluir=$sql->fetch(PDO::FETCH_ASSOC);
                for($i=0;$i<sizeof($cuidadoExcluir);$i++){
                    $sql = $pdo->prepare("DELETE FROM cuidadomaterial WHERE codigoCuidado = $cuidadomaterialExcluir[$i]");
                    $sql->execute();
                }
            }

            //Deletando relacionamento cuidado e item
            $sql = $pdo->prepare("SELECT codigoCuidado FROM itemambienteprecisacuidado WHERE codigoCuidado = $codigo");
            $sql->execute();
            if($sql->rowCount()>0){
                $cuidadoitemExcluir=$sql->fetch(PDO::FETCH_ASSOC);
                for($i=0;$i<sizeof($cuidadoExcluir);$i++){
                    $sql = $pdo->prepare("DELETE FROM itemambienteprecisacuidado WHERE codigoCuidado = $cuidadoitemExcluir[$i]");
                    $sql->execute();
                }
            }

            $sql = $pdo->prepare("DELETE FROM cuidado WHERE codigoCuidado = :c");
            $sql->bindValue(":c", $codigo);
            $sql->execute();
        }

        public function recuperaCuidadoNecessidade(){
            global $pdo;
            global $msgErro;

            $sql = $pdo->prepare("SELECT codigoCuidado, descricaoCuidado, pontuacaoCuidado, nomeMaterial FROM cuidado as c INNER JOIN cuidadoMaterial as cm ON c.codigoCuidado = cm.codigoCuidado INNER JOIN material as m ON cm.codigoMaterial = m.codigoMaterial WHERE codigoCuidado = $codigo");
            $sql->execute();
        }
    }
?>