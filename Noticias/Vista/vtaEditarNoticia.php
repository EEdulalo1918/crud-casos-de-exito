
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
    <title>Noticias</title>
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
        <div class="divTitle2">
            <h2>Noticias</h2> 
        </div>

        <!-- Contenedor para la imagen -->
        <div class="divImagenContainer">
            <img id="imagenNoticia" src="" alt="Imagen de la Noticia">
        </div>

<!--Formulario para mostrar y editar el Recuerdos-->
        <form class="frmEditar" id="formEditarNoticia" enctype="multipart/form-data">
            <input class="InputsEditar" type="hidden" name="idNoticia" id="noticiaId">

            <label>Titulo:</label>
            <input class="InputsEditar" type="text" name="txtTitulo" id="titulo" required><br>

            <label>Autor</label>
            <input class="InputsEditar" type="text" name="txtAutor" placeholder="Campo no obligatorio" id="autor"><br>

            <label>Epigrafe</label>
            <input class="InputsEditar" type="text" name="txtEpigrafe" placeholder="Campo no obligatorio" id="epigrafe"><br>

            <label>Contenido:</label>
            <textarea class="atxtDescriptionEditar" name="atxtDescripcion" id="descripcion" required></textarea><br>

            <label>Imagen (solo en caso de que no tenga una o si desea cambiarla):</label>
            <input class="InputsAgregar" type="file" name="imagen" accept=".jpg,.jpeg,.png,.gif">
            <small>Solo se permiten archivos JPG, JPEG, PNG y GIF</small><br>

            <button class="InputEditarSubmit" type="submit">Actualizar</button>
            <a class="btnCancelar" href="vtaNews.php">Cancelar</a>
        </form>
        
        <div id="mensaje"></div>
    </main>


<!--llamada a los scrips con la información-->
    <script src="../Js/ajxEditarNoticia.js"></script>

    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos le footer de la pagina?>
</body>
</html>
