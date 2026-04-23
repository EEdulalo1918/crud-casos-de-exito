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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Estilos/StyleCE.css">
    <link rel="stylesheet" href="../../Estilos/style.css">
    <link rel="stylesheet" href="../../Estilos/styleMenu.css">
    <link rel="stylesheet" href="../../Estilos/styleIMG.CSS">
    <link rel="stylesheet" href="../../Estilos/stylesFooter.css">
    <title>Eventos</title>
</head>

<body>
<!--header con el menu-->
        <?php include '../../Partials/Vista/vtaMenu.html';//cargamos el header de la pagina?>

        <div class="divTitle">
            <h2>Eventos</h2>
        </div>

        <main class="MainContentForm">
        <div class="divContentInfo">
            
            <table class="TablesInfo" id="eventosTable">
                <h2 class="divTitle1">Eventos Registrados</h2>
                <div class="divAgregar">
                    <a href="vtaAgregarEvento.php">Agregar</a>
                </div>

                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Hora</th>
                        <th>Fecha</th>
                        <th>Lugar</th>
                        <th>Imagen</th>
                        <th>Detalles</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
    
                <tbody id="eventosTableBody">
                    <!--los datos se cargaran dinamicamente con js-->
                </tbody>
            </table>
        </div>
    </main>


<!--footer con el menu-->
    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos el header de la pagina?>
    <script src="../Js/ajxCargarEvento.js">//cargar evento</script>
</body>
</html>