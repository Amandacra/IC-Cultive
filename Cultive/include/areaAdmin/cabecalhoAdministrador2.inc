<nav class="navbar fixed-top mb-10 h1" id="corCabecalho">

  <span class="navbar-brand"><img id="imagem" src="../logo/Colorido/Sem_Fundo/Logo_Cultive_Pequeno_407px_407px.png"/></span>

  <p class="titulo">Cultive - Jardim Colaborativo</p>

  <div class="float-right">
    <p class="cabecalhoUsuaLogados">Seja bem vindo(a) Administrador</p>
    <div class="btn-group" role="group" aria-label="Grupo de botões com dropdown aninhado">
      <a role="button" class="btn btn-primary custom-btn" href="../index.php">
        Jardins
      </a>
      <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-primary custom-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cadastro
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalCadastrarJardim">
            Cadastrar Ambiente
          </button>
          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalCadastrarCuidado">
            Cadastrar Cuidado
          </button>
          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalCadastrarItem">
            Cadastrar Item
          </button>
          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalCadastrarMaterial1">
            Cadastrar Material
          </button>
          <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalCadastrarSensor1">
            Cadastrar Sensor
          </button>
        </div>
      </div>
      <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-primary custom-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Tabelas
          </button>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <a type="button" class="btn btn-link" href="areaAdmin/tabelaAmbientes.php">
                  Ambientes
              </a>
              <a type="button" class="btn btn-link" href="AreaAdmin/tabelaDenunciaA.php">
                  Denuncias Ambiente
              </a>
              <a type="button" class="btn btn-link" href="areaAdmin/tabelaCuidados.php">
                  Cuidados
              </a>
              <a type="button" class="btn btn-link" href="areaAdmin/tabelaItens.php">
                  Itens dos ambientes
              </a>
              <a type="button" class="btn btn-link" href="areaAdmin/tabelaMateriais.php">
                  Materiais
              </a>
              <a type="button" class="btn btn-link" href="areaAdmin/tabelaSensores.php">
                  Sensores
              </a>
              <a type="button" class="btn btn-link" href="areaAdmin/tabelaUsuarios.php">
                  Usuarios
              </a>
          </div>
          <button type="button" class="btn btn-primary custom-btn" data-toggle="modal" data-target="#modalAcionaNecessidade">
            Acionar Necessidade
          </button>
      </div>
      <a role="button" class="btn btn-primary custom-btn" href="sair.php">
        Sair
      </a>
    </div>
  </div>

</nav>