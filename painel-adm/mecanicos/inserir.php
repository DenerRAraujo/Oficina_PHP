<?php
require_once("../../conexao.php");
$nome = $_POST['nome-mecanico'];
$cpf = $_POST['cpf-mecanico'];
$email = $_POST['email-mecanico'];
$telefone = $_POST['telefone-mecanico'];
$endereco = $_POST['endereco-mecanico'];

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];

$listaMecanicos = $pdo->query("SELECT * FROM mecanicos where cpf = '$cpf'");
$registroMecanicos = $listaMecanicos->fetchAll(PDO::FETCH_ASSOC);

$total_registro = @count($registroMecanicos);

if($total_registro){
    echo 'Já existe um cadastro para esse mecânico.';
    exit();
}

$listaMecanicos = $pdo->prepare("INSERT INTO mecanicos () VALUES ()");

echo $total_registro;
?>
