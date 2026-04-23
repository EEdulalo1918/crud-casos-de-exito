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
    <title>Editar Categoria Beneficio</title>
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
            <h2>Editar Categoria</h2> 
        </div>

        <!-- Contenedor para la imagen -->
        <div class="divImagenContainer">
            <img id="imagenCategoriaBeneficio" src="" alt="Imagen del Beneficio">
        </div>

<!--Formulario para mostrar y editar el Beneficio-->
        <form class="frmEditar" id="formEditarBeneficio" enctype="multipart/form-data">
            <input class="InputsEditar" type="hidden" name="idCategoriaBeneficio" id="categoriabeneficioId">

            <label>Nombre Categoria:</label>
            <input class="InputsEditar" type="text" name="txtNombreCategoria" id="nombrecategoria" required><br>

            <label>Imagen (solo en caso de que no tenga una o si desea cambiarla):</label>
            <input class="InputsAgregar" type="file" name="imagen" accept=".jpg,.jpeg,.png,.gif">
            <small>Solo se permiten archivos JPG, JPEG, PNG y GIF</small><br>

            <button class="InputEditarSubmit" type="submit">Actualizar</button>
            <a class="btnCancelar" href="vtaCategoriaBeneficios.php">Cancelar</a>
        </form>
        
        <div id="mensaje"></div>
    </main>


<!--llamada a los scrips con la información-->
    <script src="../Js/ajxEditarCategoriaBeneficio.js"></script>

    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos le footer de la pagina?>
</body>
</html>
