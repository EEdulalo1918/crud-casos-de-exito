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
    <title>Noticias</title>
    <link rel="stylesheet" href="../../Estilos/style.css">
    <link rel="stylesheet" href="../../Estilos/styleMenu.css">
    <link rel="stylesheet" href="../../Estilos/stylesFooter.css">
    <link rel="stylesheet" href="../../Estilos/styleCE.css">
    <link rel="stylesheet" href="../../Estilos/styleIMG.css">

</head>
<body>
    
        <!--header con el menu-->
        <?php include '../../Partials/Vista/vtaMenu.html';//cargamos el header de la pagina?>
        
        <div class="divTitle">
            <h1>Noticias</h1>
        </div>

        <main class="MainContentForm">
            <div class="divContentInfo">

                <table class="TablesInfo" id="noticiasTables">
                    <h2 class="divTitle1">Noticias Registradas</h2>
                    <div class="divAgregar">
                        <a href="vtaAgregarNoticia.php">Agregar</a>
                    </div>

                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Titulo</th>
                            <!--<th>Autor</th>
                            <th>Epigrafe</th>-->
                            <th>Imagen</th>
                            <th>Detalles</th>
                            <th></th>
                            
                        </tr>
                    </thead>

                    <tbody id="NoticiaTable">
                    <!--cargaran aqui los datos del mediante js-->
                    </tbody>
                </table>
            </div>
        </main>  


<!--Footer-->
<?php include '../../Partials/Vista/vtaFooter.html';//cargamos el header de la pagina?>
<script src="../Js/ajxCargarNoticia.js">//cargar noticias</script>
</body>
</html>