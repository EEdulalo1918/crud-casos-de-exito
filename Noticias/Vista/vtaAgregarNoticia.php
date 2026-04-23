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
    <title>Agregar Noticia</title>
    <link rel="stylesheet" href="../../Estilos/StyleCE.css">
    <link rel="stylesheet" href="../../Estilos/style.css">
    <link rel="stylesheet" href="../../Estilos/styleMenu.css">
    <link rel="stylesheet" href="../../Estilos/stylesFooter.css">
</head>
<body>
    <!--header con el menu-->
        <?php include '../../Partials/Vista/vtaMenu.html';//cargamos el header de la pagina?>

    <main class="MainContentForm">
        
        <div class="divTitle2"><h2>Agregar Noticia</h2></div>
        
        <form class="frmAgregar" id="formAgregarNoticias" enctype="multipart/form-data">
            <label>Titulo:</label>
            <input class="InputsAgregar" type="text" name="txtTitulo" required><br>

            <label>Autor:</label>
            <input class="InputsAgregar" type="text" placeholder="Campo no obligatorio" name="txtAutor"><br>

            <label>Epigrafe:</label>
            <input class="InputsAgregar" type="text" placeholder="Campo no obligatorio" name="txtEpigrafe"><br>

            <label>Contenido:</label>
            <textarea class="atxtDescription" name="atxtDescripcion" required></textarea><br>

            <label>Imagen:</label>
            <input class="InputsAgregar" type="file" name="imagen" accept=".jpg,.jpeg,.png,.gif" required>
            <small>Solo se permiten archivos JPG, JPEG, GIF Y PNG</small><br>

            <button class="btnAgregarSumit" type="submit">Guardar</button>
            <button class="btnCancelar"><a href="vtaNews.php">Cancelar</a></button>
            
        </form>
        
        <div id="mensaje"></div>
    </main>


    <script src="../Js/ajxAgregrarNoticia.js">//agregar noticia</script>

    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos el footer de la pagina?>
</body>
</html>