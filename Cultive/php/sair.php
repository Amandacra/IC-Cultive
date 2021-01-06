<?php
    session_start();
    unset($_SESSION['codigoUsuario']);
    unset($_SESSION['codigoAdmin']);
    unset($_SESSION['usuarioLogin']);
    header('Location: ../index.php');
?>