<?php
    print('
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Metflix</title>
            <meta name="description" content="Bienvenidos a Metflix tus pelis y series favoritas">
            <!-- El icono de arriba del navegador -->
            <link rel="shortcut icon" type="image/png" href="./public/img/favicon.png">
            <!-- Trabajo con el framewokr de MirCha por eso uso cosas raras en los nombres de clase porque el en el css
            ya los definio -->
            <link rel="stylesheet" href="./public/css/responsimple.min.css">
            <link rel="stylesheet" href="./public/css/metflix.css">
        </head>
        <body>
            <header class="container center header">
                <div class="item i-b v-middle ph12 lg2 lg-left">
                    <h1 class="logo">Metflix</h1>
                </div>    
    ');

    //El menu de navegacion solo lo muestro si esta logueado
    if($_SESSION['ok']){
        print(' 
            <nav class="item i-b middle ph12 lg10 lg-right menu">
                <ul class="container">
                    <li class="nobullet item inline"><a href="./">Inicio</a></li>
                    <li class="nobullet item inline"><a href="movieseries">MovieSeries</a></li>
                    <li class="nobullet item inline"><a href="usuarios">Usuarios</a></li>
                    <li class="nobullet item inline"><a href="status">Status</a></li>
                    <li class="nobullet item inline"><a href="salir">Salir</a></li>
                </ul>
            </nav>
        ');
    }

    print('
        </header>
        <main class="container center main">'
    );  