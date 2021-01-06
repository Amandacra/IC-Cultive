<nav class="navbar fixed-top mb-10 h1" id="corCabecalho">

  <span class="navbar-brand"><img id="imagem" src="Logo/Colorido/Sem_Fundo/Logo_Cultive_Pequeno_407px_407px.png"/></span>

  <p class="titulo">Cultive - Jardim Colaborativo</p>

  <div class="float-right">
    <p class="cabecalhoUsuaLogados">Seja bem vindo(a) <br>
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
    <a role="button" class="btn btn-primary custom-btn" href="index.php">
      Jardins
    </a>
    <a role="button" class="btn btn-primary custom-btn" href="php/areaUsua/Perfil.php">
      Perfil
    </a>
    <a role="button" class="btn btn-primary custom-btn" href="php/areaUsua/Ranking.php">
      Ranking
    </a>
    <a role="button" class="btn btn-primary custom-btn" href="php/sair.php">
      Sair
    </a>
  </div>

</nav>