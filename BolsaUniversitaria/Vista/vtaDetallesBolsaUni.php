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
    <title>Detalles de la Bolsa Universitaria</title>
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
        <div class="divTitle2"><h2>Bolsa Universitaria</h2></div>
        <div class="detalles-BolsaUni">                  
            <!-- Contenedor para la imagen -->
            <div class="divImagenContainer">
                <img id="imagenBolsaUni" src="" alt="Imagen de la Plataforma">
            </div>
            
            <form class="frmEditar">
                <input type="hidden" name="idPlataforma" id="plataformaId">
                
                <label>Nombre:</label>
                <input class="InputsEditar" type="text" name="txtNombre" id="nombre" readonly><br>

                <label>URL:</label>
                <input class="InputsEditar" type="text" name="txtUrl" id="url" readonly><br>

                <a class="btnVolver" href="vtaBolsaUni.php">Volver</a>
            </form>
        </div>
    </main>


    <script src="../Js/ajxDetallesBolsa.js"></script>
    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos el footer de la pagina?>
</body>
</html>