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
    <title>Detalles del Recuerdos</title>
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
        <div class="divTitle2"><h2>Recuerdos</h2></div>
        <div class="detalles-Recuerdos">                  
            <!-- Contenedor para la imagen -->
            <div class="divImagenContainer">
                <img id="imagenRecuerdos" src="" alt="Imagen del Recuerdo">
            </div>
            
            <form class="frmEditar">
                <input type="hidden" name="idCaso" id="recuerdoId">
                
                <label>Nombre:</label>
                <input class="InputsEditar" type="text" name="txtNombre" id="nombre" readonly><br>

                <label>Descripción:</label>
                <textarea class="atxtDescriptionEditar" name="atxtDescripcion" id="descripcion" readonly></textarea><br>

                <a class="btnVolver" href="vtaRecuerdos.php">Volver</a>
            </form>
        </div>
    </main>


    <script src="../Js/ajxDetallesRecuerdo.js"></script>
    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos el footer de la pagina?>
</body>
</html>