CREATE TABLE usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    correo VARCHAR(50) NOT NULL,
    usuario VARCHAR(30) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('paciente', 'administrador', 'psicologo') NOT NULL
);
