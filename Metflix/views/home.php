<?php
    $template = '
        <article class="item">
	        <h2 class="p1">Hola %s, bienvenid@ a Mexflix</h2>
	        <h3 class="p1">Tus Películas y Series Favoritas</h3>
	        <p class="p1  f1_25">Tu nombre es <b>%s</b></p>
	        <p class="p1  f1_25">Tu email es <b>%s</b></p>
	        <p class="p1  f1_25">Tu cumpleaños es <b>%s</b></p>
	        <p class="p1  f1_25">Tu perfil de usuario tiene nivel de <b>%s</b></p>
        </article>
    ';

//printf(texto, variable1, varable2 ...) reemplaza los %s por las variables que le mande en el texto en el orden que se envian
printf($template,
    $_SESSION['user'],
	$_SESSION['nombre'],
	$_SESSION['email'],
	$_SESSION['birthday'],
    $_SESSION['role']
);