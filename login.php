<?php
$servername = "localhost";
$username = "mi_usuario";
$password = "mi_contraseña";
$dbname = "mi_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            header("Location: bienvenida.php");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('No existe el usuario'); window.location.href = 'index.php';</script>";
    }
}

$conn->close();
?>
