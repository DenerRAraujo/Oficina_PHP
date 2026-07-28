<?php
require_once("../../conexao.php");
$nome = $_POST['nome-mecanico'];
$cpf = $_POST['cpf-mecanico'];
$email = $_POST['email-mecanico'];
$telefone = $_POST['telefone-mecanico'];
$endereco = $_POST['endereco-mecanico'];

$cpfAntigo = $_POST['cpfAntigo'];
$emailAntigo = $_POST['emailAntigo'];
$id = $_POST['txtid2'];

if($nome == ""){
    echo 'O nome é Obrigatório!';
    exit();

}

if($cpf == ""){
    echo 'O CPF é Obrigatório!';
    exit();

}

if($email == ""){
    echo 'O email é Obrigatório!';
    exit();

}

if($cpfAntigo != $cpf){
    $listaMecanicos = $pdo->query("SELECT * FROM mecanicos where cpf = '$cpf'");
    $registroMecanicos = $listaMecanicos->fetchAll(PDO::FETCH_ASSOC);

    $total_registros = @count($registroMecanicos);

    if($total_registros>0){
        echo 'Já existe um cadastro para esse CPF.';
        exit();
    }
}

if($emailAntigo != $email){
    $listaMecanicos = $pdo->query("SELECT * FROM mecanicos where email = '$email'");
    $registroMecanicos = $listaMecanicos->fetchAll(PDO::FETCH_ASSOC);

    $total_registros = @count($registroMecanicos);

    if($total_registros>0){
        echo 'Já existe um cadastro para esse Email.';
        exit();
    }
}

if($id == ""){
    $listaMecanicos = $pdo->prepare("INSERT INTO mecanicos SET nome = :nome, cpf = :cpf, email = :email,  telefone = :telefone, endereco = :endereco");
    $listaUsuarios = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, cpf = :cpf, email = :email,  senha = :senha, nivel = :nivel");
    $listaUsuarios->bindValue(":senha", '123');
    $listaUsuarios->bindValue(":nivel", 'Mecânico');
}else{
    $listaMecanicos = $pdo->prepare("UPDATE mecanicos SET nome = :nome, cpf = :cpf, email = :email,  telefone = :telefone, endereco = :endereco WHERE id = '$id'");
    $listaUsuarios = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email WHERE cpf = '$cpfAntigo'");
}

$listaMecanicos->bindValue(":nome", $nome);
$listaMecanicos->bindValue(":cpf", $cpf);
$listaMecanicos->bindValue(":email", $email);
$listaMecanicos->bindValue(":telefone", $telefone);
$listaMecanicos->bindValue(":endereco", $endereco);

$listaUsuarios->bindValue(":nome", $nome);
$listaUsuarios->bindValue(":cpf", $cpf);
$listaUsuarios->bindValue(":email", $email);

$listaUsuarios->execute();
$listaMecanicos->execute();

echo $cpfAntigo;


echo 'Salvo com Sucesso!';
?>
