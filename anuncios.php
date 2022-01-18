<?php 
require 'includes/app.php';
incluirTemplates('header'); ?>


    <main class="contenedor seccion">
        <h1>Casas y Depas en Venta</h1>

<?php
$limite = 10; // Limite de anuncios
include 'includes/templates/anuncios.php'; //incluir archivo de anuncios
?>


    </main>




 <?php incluirTemplates('footer'); ?>