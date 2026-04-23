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
    <title>Detalles del Evento</title>
    <link rel="stylesheet" href="../../Estilos/StyleCE.css">
    <link rel="stylesheet" href="../../Estilos/style.css">
    <link rel="stylesheet" href="../../Estilos/styleMenu.css">
    <link rel="stylesheet" href="../../Estilos/styleIMG.css">
    <link rel="stylesheet" href="../../Estilos/stylesFooter.css">
</head>
<body>
    
        <!--header con el menu-->
        <?php include '../../Partials/Vista/vtaMenu.html';//cargamos el header de la pagina?>
        

    <main class="MainContentForm">
        <div class="divTitle2"><h2>Evento</h2></div>
        <div class="detalles-Evento">                  
            <!-- Contenedor para la imagen -->
            <div class="divImagenContainer">
                <img id="imagenEvento" src="" alt="Imagen del Evento">
            </div>
            
            <form class="frmEditar">
            <input type="hidden" name="idEvento" id="eventoId">

            <label>Nombre del Evento:</label>
            <input class="InputsEditar" type="text" name="txtNombre" id="nombre" readonly><br>

            <label>Nombre de la Persona:</label>
            <input class="InputsEditar" type="text" name="txtNomPersona" id="nompersona" readonly><br>

            <label>Hora:</label>
            <input class="InputsEditar" type="time" name="txtHora" id="hora" readonly><br>

            <label>Fecha:</label>
            <input class="InputsEditar" type="date" name="txtFecha" id="fecha" readonly><br>

            <label>Descripción:</label>
            <textarea class="atxtDescriptionEditar atxtDescription" name="atxtDescripcion" id="descripcion" readonly></textarea><br>
            
            <label>Lugar:</label>
            <input class="InputsEditar" type="text" name="txtLugar" id="lugar" readonly><br>

            <label>URL del Evento:</label>
            <input class="InputsEditar" type="text" name="txtUrl" id="url" readonly><br>

                <a class="btnVolver" href="vtaEventos.php">Volver</a>
            </form>
        </div>
    </main>


    <script src="../Js/ajxDetallesEvento.js"></script>
    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos el footer de la pagina?>
</body>
</html>