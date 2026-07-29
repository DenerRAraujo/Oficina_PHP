<?php
require_once("conexao.php");
@session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$listaUsuarios = $pdo->prepare("SELECT * FROM usuarios where email = :email and senha = :senha");
$listaUsuarios->bindValue(":email", $email);
$listaUsuarios->bindValue(":senha", $senha);
$listaUsuarios->execute();
$registroUsuario = $listaUsuarios->fetchAll(PDO::FETCH_ASSOC);
$total_registros = @count($registroUsuario);

if($total_registros>0){

    $_SESSION['idUsuario'] = $registroUsuario[0]['id'];
    $_SESSION['nomeUsuario'] = $registroUsuario[0]['nome'];
    $_SESSION['cpfUsuario'] = $registroUsuario[0]['cpf'];
    $_SESSION['nivelUsuario'] = $registroUsuario[0]['nivel'];

    if($registroUsuario[0]['nivel'] == 'Administrador'){
        echo "<script language='javascript'>
            window.location='painel-adm' </script>";
    }
    if($registroUsuario[0]['nivel'] == 'Mecânico'){
        echo "<script language='javascript'>
            window.location='painel-mecanico' </script>";
    }
    if($registroUsuario[0]['nivel'] == 'Recepcionista'){
        echo "<script language='javascript'>
            window.location='painel-recepcao' </script>";
    }
}
else{
    echo "<script language='javascript'> window.alert('Usuário ou Senha Incorreta!') </script>";
    echo "<script language='javascript'>
        window.location='index.php' </script>";

}


?>
