<?php
require_once("../../conexao.php");
$id = $_POST['id'];

$listaMecanicos = $pdo->query("DELETE FROM mecanicos WHERE id = '$id'");

echo 'Excluído com Sucesso!';

?>
