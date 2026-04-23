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
    <title>Detalles de la Noticia</title>
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
        <div class="divTitle2"><h2>Noticias</h2></div>
        <div class="detalles-Noticias">                  
            <!-- Contenedor para la imagen -->
            <div class="divImagenContainer">
                <img id="imagenNoticias" src="" alt="Imagen de la Noticia">
            </div>
            
            <form class="frmNoticia">
                <input type="hidden" name="idNoticia" id="noticiaId">
                
                <label>Titulo:</label>
                <input class="InputsEditar" type="text" name="txtAutor" id="autor" readonly><br>

                <label>Autor:</label>
                <input class="InputsEditar" type="text" name="txtTitulo" id="titulo" readonly><br>

                <label>Epigrafe:</label>
                <input class="InputsEditar" type="text" name="txtEpigrafe" id="epigrafe" readonly><br>

                <label>Contenido:</label>
                <textarea class="atxtDescriptionEditar" name="atxtDescripcion" id="descripcion" readonly></textarea><br>

                <a class="btnVolver" href="vtaNews.php">Volver</a>
            </form>
        </div>
    </main>


    <script src="../Js/ajxDetallesNoticia.js"></script>
    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos el footer de la pagina?>
</body>
</html>