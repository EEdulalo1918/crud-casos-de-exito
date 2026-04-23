<?php
    session_start();

    include '../../conexion.php';
    $conexion = fncConexcion(); // Debe devolver una instancia de PDO

    $numempleado = $_POST['txtnumempleado'];
    $password = $_POST['password'];
    $password = hash('sha512', $password);

    // Usamos prepared statements para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE numEmpleado = :txtnumempleado AND password = :password");
    $stmt->bindParam(':txtnumempleado', $numempleado);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['usuario'] = $numempleado;
        header("Location: ../Vista/vtaInicio.php");
        exit;
    } else {
        echo '
            <script>
                alert("El usuario no existe, favor verifica que tus datos esten correctamente");
                window.location = "../../index.php";
            </script>
        ';
        exit;
    }

    // Cerrar conexión 
    $conexion = null;
?>
