<?php
session_start();
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header("Location: login.html");
    exit;
}

include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    echo "<script>alert('Usuario eliminado exitosamente.'); window.location.href = 'administracion1.php';</script>";
    exit;
} else {
    echo "<script>alert('ID no especificado.'); window.location.href = 'administracion1.php';</script>";
    exit;
}
?>
