<!-- Modal de Login -->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalLogin" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="login.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Faça seu login
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        E-mail:
                        <input type="email" name="emailUsuario" id="emailUsuario" class="form-control" maxlength="40" required="required"/>
                    </p>
                    <p>
                        Senha:
                        <input type="password" name="senhaUsuario" class="form-control password" maxlength="32" required="required"/>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-primary custom-btn">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Cadastro de usuário-->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalCadastrarUsuario" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="cadastrarUsuario.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Cadastre-se
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Nome:
                        <input type="text" name="nomeUsuario" id="nomeUsuario" class="form-control" maxlength="30" required="required"/>
                    </p>
                    <p>
                        Prontuário:
                        <input type="number" name="prontuarioUsuario" id="prontuario" class="form-control" maxlength="10" required="required"/>
                    </p>
                    <p>
                        E-mail:
                        <input type="email" name="emailUsuario" id="emailUsua" class="form-control" maxlength="40" required="required"/>
                    </p>
                    <p>
                        Senha:
                        <input type="password" name="senhaUsuario" class="form-control password" maxlength="32" required="required"/>
                    </p>
                    <p>
                        Confirmar senha:
                        <input type="password" name="confirmSenha" class="form-control password" required="required"/>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-primary custom-btn">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>