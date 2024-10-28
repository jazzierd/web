<?php 
function conectarse(){
    $link = mysqli_connect("localhost", "root", "", "hacienda", "3306");
    if (!$link) {
        die("No hay conexión: " . mysqli_connect_error());
    }
    return $link;
}

