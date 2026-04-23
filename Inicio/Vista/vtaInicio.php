
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Inicio</title>

    <link rel="stylesheet" href="../../Estilos/styleMenu.css">
    <link rel="stylesheet" href="../../Estilos/styleIMG.css">
    <link rel="stylesheet" href="../../Estilos/stylesFooter.css">
    <link rel="stylesheet" href="../../Estilos/StyleCE.css">
    <link rel="stylesheet" href="../../Estilos/style.css">
    <link rel="stylesheet" href="../../Estilos/styleInicio.css">
    <link rel="preconnect" href="../../https://fonts.gstatic.com" crossorigin>
    
</head>

<body>
     <?php include '../../Partials/Vista/vtaMenu.html';//cargamos el header de la pagina?>

    <main class="MainInfo Cards">
        <div class="divTitle">
            <h1>Acerca de ...</h1>
        </div>

        <div class="Container Grid">
            <!-- Tarjeta 1 -->
            <article class="Card">
                <img src="https://www.uaeh.edu.mx/gaceta/5/numero60/febrero/images/credencial-universitaria/1.jpg" alt="HISTORIA" class="CardImg">
                <div class="CardBody">
                    <h3 class="CardTitle">Preguntas</h3>
                    <p class="CardText">
                        Preguntas frecuentes por parte de los estudiantes y egresados.
                    </p>
                    <a href="https://uaeh.edu.mx/fotografia_online?c=fotosOnline&a=faq" class="btn">Ver más</a>
                </div>
            </article>

            <!-- Tarjeta 2 -->
            <article class="Card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/Ciudad_del_Conocimiento_de_la_UAEH._64.jpg/640px-Ciudad_del_Conocimiento_de_la_UAEH._64.jpg"
                    alt="CEDAI-Instalaciones" class="CardImg">
                <div class="CardBody">
                    <h3 class="CardTitle">La credencial</h3>
                    <p class="CardText">
                        Conece más acerca de los beneficios al obtener tu credencial y acerca de ella.
                    </p>
                    <a href="https://uaeh.edu.mx/garceta/2018/agosto/credencial.html" class="btn">Ver más</a>
                </div>
            </article>

            <!-- Tarjeta 3 -->
            <article class="Card">
                <img src="https://criteriohidalgo.com/_next/image?url=https%3A%2F%2Fcdn-cubimetrix.sfo3.cdn.digitaloceanspaces.com%2Fuploads%2F2018%2F01%2F02-768x512.jpg&w=3840&q=75"
                    alt="Procedimientos" class="CardImg">
                <div class="CardBody">
                    <h3 class="CardTitle">Tramites</h3>
                    <p class="CardText">
                        Conoce los procesos que puedes tramitar.
                    </p>
                    <a href="https://uaeh.edu.mx/fotografia_online/" class="btn">Ver más</a>
                </div>
            </article>
        </div>
    </main>

    <?php include '../../Partials/Vista/vtaFooter.html'; ?>
</body>
</html>
