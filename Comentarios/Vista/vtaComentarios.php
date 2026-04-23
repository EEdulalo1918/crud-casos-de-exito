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
    <title>Comentarios</title>
</head>

<body>
<!--header con el menu-->
        <?php include '../../Partials/Vista/vtaMenu.html';//cargamos el header de la pagina?>

        <div class="divTitle">
            <h2>Comentarios</h2>
        </div>

        <main class="MainContentForm">
        <div class="divContentInfo">
            
            <table class="TablesInfo" id="comentariosTable">
                <h2 class="divTitle1">Comentarios Registrados</h2>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Descripción</th>
                        <th>Correo</th>
                        <th>Detalles</th>
                        <th></th>
                    </tr>
                </thead>
    
                <tbody id="comentariosTableBody">
                    <!--los datos se cargaran dinamicamente con js-->
                </tbody>
            </table>
        </div>
    </main>


<!--footer con el menu-->
    <?php include '../../Partials/Vista/vtaFooter.html';//cargamos el header de la pagina?>
    <script src="../Js/ajxCargarComentarios.js">//cargar casos de exito</script>
</body>
</html>