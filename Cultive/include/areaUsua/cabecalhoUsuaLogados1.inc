<nav class="navbar fixed-top mb-10 h1" id="corCabecalho">

  <span class="navbar-brand"><img id="imagem" src="../logo/Colorido/Sem_Fundo/Logo_Cultive_Pequeno_407px_407px.png"/></span>

  <p class="titulo">Cultive - Jardim Colaborativo</p>

  <div class="float-right">
    <p class="cabecalhoUsuaLogados">Seja bem vindo(a) 
    <?php
      $_SESSION['usuarioLogin']=$banco->recuperaUsuario();
      if(count($_SESSION["usuarioLogin"])>0){
        for($i = 0; $i < sizeof($_SESSION["usuarioLogin"]); $i++){
            foreach ($_SESSION["usuarioLogin"][$i] as $key => $value){
                if($key == "nomeUsuario"){
                    echo $value;
                }
            }
        }
      }
    ?>
    </p>
    <div class="btn-group" role="group" aria-label="Grupo de botões com dropdown aninhado">
    <a role="button" class="btn btn-primary custom-btn" href="../index.php">
      Jardins
    </a>
    <a role="button" class="btn btn-primary custom-btn" href="areaUsua/Perfil.php">
      Perfil
    </a>
    <a role="button" class="btn btn-primary custom-btn" href="areaUsua/Ranking.php">
      Ranking
    </a>
    <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-primary custom-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Denunciar
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDenunciaAmbiente">
            Ambiente         /
          </button>
          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalDenunciaItem">
            Item
          </button>
        </div>
    </div>
    <a role="button" class="btn btn-primary custom-btn" href="sair.php">
      Sair
    </a>
  </div>
  </div>
</nav>