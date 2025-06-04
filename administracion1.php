<?php

session_start();
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'administrador') {
    header("Location: admin_panel.php");
    exit;
}

include("config.php");


$result = [];

if (isset($_POST['buscar'])) {
    $busqueda = $_POST['busqueda'];
    $sql = "SELECT * FROM usuarios WHERE nombre LIKE ? OR usuario LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['%' . $busqueda . '%', '%' . $busqueda . '%']);
    $result = $stmt->fetchAll();
} else {

    $sql = "SELECT * FROM usuarios";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/mystyle1.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        
        .welcome-message {
            background-color: #198754;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            margin-right: 10px;
        }

        button {
            padding: 10px 15px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .add-user {
            margin-top: 20px;
            display: block;
            text-align: center;
            background-color: #198754;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .add-user:hover {
            background-color: #145a32;
        }
    </style>
</head>

<div id="welcomeMessage" class="alert alert-success text-center" role="alert">
    Bienvenido Administrador
</div>

<!-- JavaScript para ocultar el mensaje -->
<script>
    // Espera 5 segundos (5000 ms) y luego oculta el mensaje
    setTimeout(() => {
        const message = document.getElementById('welcomeMessage');
        if (message) {
            message.style.display = 'none';
        }
    }, 5000); // Cambia 5000 por la cantidad de milisegundos que deseas
</script>




<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Usuario</th>
        <th>Tipo de Usuario</th>
        <th>Acciones</th>
    </tr>
    <?php
    if ($result) {
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['correo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['usuario']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tipo_usuario']) . "</td>";
            echo "<td>
                    <a href='editar.php?id=" . htmlspecialchars($row['id']) . "'>Editar</a> |
                    <a href='eliminar.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\");'>Borrar</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
    }
    ?>
</table>

<a href="registro_pacientes.html" class="add-user">Agregar nuevo usuario</a>

</body>
</html>
