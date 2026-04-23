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
    <title>Bolsa Universitaria</title>
    <link rel="stylesheet" href="../../Estilos/StyleCE.css">
    <link rel="stylesheet" href="../../Estilos/style.css">
    <link rel="stylesheet" href="../../Estilos/styleMenu.css">
    <link rel="stylesheet" href="../../Estilos/styleIMG.css">
    <link rel="stylesheet" href="../../Estilos/stylesFooter.css">
    
    <title>Editar</title>
</head>
<body>
    <!--header con el menu-->
        <?php include '../../Partials/Vista/vtaMenu.html';//cargamos el header de la pagina?>
    <main class="MainContentForm">
        <div class="divTitle2">
            <h2>Bolsa Universitaria</h2> 
        </div>

        <!-- Contenedor para la imagen -->
        <div class="divImagenContainer">
            <img id="imagenBolsaUni" src="" alt="Imagen de la plataforma">
        </div>

<!--Formulario para mostrar y editar el Caso de Éxito-->
        <form class="frmEditar" id="formEditarBolsaUni" enctype="multipart/form-data">
            <input class="InputsEditar" type="hidden" name="idPlataforma" id="plataformaId">

            <label>Nombre:</label>
            <input class="InputsEditar" type="text" name="txtNombre" id="nombre" required><br>

            <label>URL:</label>
            <input class="InputsEditar" type="text" name="txtUrl" id="url" required><br>

            <label>Imagen (solo en caso de que no tenga una o si desea cambiarla):</label>
            <input class="InputsAgregar" type="file" name="imagen" accept=".jpg,.jpeg,.png,.gif">
            <small>Solo se permiten archivos JPG, JPEG, PNG y GIF</small><br>

            <button class="InputEditarSubmit" type="submit">Actualizar</button>
            <a class="btnCancelar" href="vtaBolsaUni.php">Cancelar</a>
        </form>
        
        <div id="mensaje"></div>
    </main>


<!--llamada a los scrips con la información-->
    <script src="../Js/ajxEditarBolsa.js"></script>

    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos le footer de la pagina?>
</body>
</html>
