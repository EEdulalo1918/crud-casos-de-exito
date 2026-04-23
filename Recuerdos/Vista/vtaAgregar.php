<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
            alert("Debes de Iniciar Sesion");
            window.location = "../../index.php";
            </script>
        ';
        session_destroy();
        die();
    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Recuerdos</title>
    <link rel="stylesheet" href="../../Estilos/StyleCE.css">
    <link rel="stylesheet" href="../../Estilos/style.css">
    <link rel="stylesheet" href="../../Estilos/styleMenu.css">
    <link rel="stylesheet" href="../../Estilos/stylesFooter.css">
    <title>Agregar</title>
</head>
<body>
    <!--header con el menu-->
        <?php include '../../Partials/Vista/vtaMenu.html';//cargamos el header de la pagina?>

    <main class="MainContentForm">
        
        <div class="divTitle2"><h2>Agregar Recuerdos</h2></div>
        
        <form class="frmAgregar" id="formAgregarRecuerdos" enctype="multipart/form-data">
            <label>Nombre:</label>
            <input class="InputsAgregar" type="text" name="txtNombre" required><br>

            <label>Descripción:</label>
            <textarea class="atxtDescription" name="atxtDescripcion" required></textarea><br>

            <label>Imagen:</label>
            <input class="InputsAgregar" type="file" name="imagen" accept=".jpg,.jpeg,.png,.gif" required>
            <small>Solo se permiten archivos JPG, JPEG, GIF Y PNG</small><br>

            <button class="btnAgregarSumit" type="submit">Guardar</button>
            <button class="btnCancelar"><a href="vtaRecuerdos.php">Cancelar</a></button>
            
        </form>
        
        <div id="mensaje"></div>
    </main>


    <script src="../Js/ajxAgregrarRecuerdo.js">//agregar usuario</script>

    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos el footer de la pagina?>
</body>
</html>