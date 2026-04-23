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
    <title>Agregar Eventos</title>
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
        
        <div class="divTitle2"><h2>Agregar Eventos</h2></div>
        
        <form class="frmAgregar" id="formAgregarEvento" enctype="multipart/form-data">
            <label>Nombre del Evento:</label>
            <input class="InputsEditar" type="text" name="txtNombre" id="nombre" required><br>

            <label>Nombre de la Persona:</label>
            <input class="InputsEditar" type="text" name="txtNomPersona" placeholder="Campo no obligatorio" id="nompersona"><br>

            <label>Hora:</label>
            <input class="InputsEditar" type="time" name="txtHora" id="hora" required><br>

            <label>Fecha:</label>
            <input class="InputsEditar" type="date" name="txtFecha" id="fecha" required><br>

            <label>Descripción:</label>
            <textarea class="atxtDescription" name="atxtDescripcion" placeholder="Campo no obligatorio" id="descripcion"></textarea><br>
            
            <label>Lugar:</label>
            <input class="InputsEditar" type="text" name="txtLugar" placeholder="Campo no obligatorio" id="lugar" ><br>

            <label>Imagen (solo en caso de que no tenga una o si desea cambiarla):</label>
            <input class="InputsAgregar" type="file" name="imagen" accept=".jpg,.jpeg,.png,.gif">
            <small>Solo se permiten archivos JPG, JPEG, PNG y GIF</small><br>

            <label>URL del Evento:</label>
            <input class="InputsEditar" type="text" name="txtUrl" placeholder="Campo no obligatorio" id="url"><br>

            <button class="btnAgregarSumit" type="submit">Guardar</button>
            <button class="btnCancelar"><a href="vtaEventos.php">Cancelar</a></button>
            
        </form>
        
        <div id="mensaje"></div>
    </main>


    <script src="../Js/ajxAgregrarEvento.js">//agregar usuario</script>

    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos el footer de la pagina?>
</body>
</html>