<?php
@session_start();

if(@$_SESSION['nivelUsuario'] == null || @$_SESSION['nivelUsuario'] != 'Administrador'){
        echo "<script language='javascript'>
        window.location='../index.php' </script>";
}
?>
