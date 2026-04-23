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
    <title>Editar Evento</title>
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
            <h2>Editar Evento</h2> 
        </div>

        <!-- Contenedor para la imagen -->
        <div class="divImagenContainer">
            <img id="imagenEvento" src="" alt="Imagen del Evento">
        </div>

<!--Formulario para mostrar y editar el Evento-->
        <form class="frmEditar" id="formEditarEvento" enctype="multipart/form-data">
            <input class="InputsEditar" type="hidden" name="idEvento" id="eventoId">

            <label>Nombre del Evento:</label>
            <input class="InputsEditar" type="text" name="txtNombre"  id="nombre" required><br>

            <label>Nombre de la Persona:</label>
            <input class="InputsEditar" type="text" name="txtNomPersona" placeholder="Campo no obligatorio" id="nompersona"><br>

            <label>Hora:</label>
            <input class="InputsEditar" type="time" name="txtHora" id="hora" required><br>

            <label>Fecha:</label>
            <input class="InputsEditar" type="date" name="txtFecha" id="fecha" required><br>

            <label>Descripción:</label>
            <textarea class="atxtDescriptionEditar atxtDescription" name="atxtDescripcion" placeholder="Campo no obligatorio" id="descripcion"></textarea><br>
            
            <label>Lugar:</label>
            <input class="InputsEditar" type="text" name="txtLugar" placeholder="Campo no obligatorio" id="lugar"><br>


            <label>Imagen (solo en caso de que no tenga una o si desea cambiarla):</label>
            <input class="InputsAgregar" type="file" name="imagen" accept=".jpg,.jpeg,.png,.gif">
            <small>Solo se permiten archivos JPG, JPEG, PNG Y GIF</small><br>

            <label>URL del Evento:</label>
            <input class="InputsEditar" type="text" name="txtUrl" placeholder="Campo no obligatorio" id="url"><br>


            <button class="InputEditarSubmit" type="submit">Actualizar</button>
            <a class="btnCancelar" href="vtaEventos.php">Cancelar</a>
        </form>
        
        <div id="mensaje"></div>
    </main>


<!--llamada a los scrips con la información-->
    <script src="../Js/ajxEditarEvento.js"></script>

    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos le footer de la pagina?>
</body>
</html>
