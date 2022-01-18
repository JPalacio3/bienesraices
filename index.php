<?php 
declare(strict_types=1); // Para que no se puedan usar variables no definidas o variables con nombres incorrectos

require 'includes/app.php'; // Incluimos el archivo de funciones

// $inicio = true;
// creamos una variable para validar que la clase existe y que queremos usarla en este archivo
incluirTemplates('header', $inicio = true); // Incluimos el header
?>

    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Aliquam accusamus esse maiores illum reprehenderit amet, voluptates illo error excepturi ratione, saepe nihil, necessitatibus quos delectus quod consequuntur ipsa veritatis magnam?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono precio loading=" lazy ">
                <h3>Precio</h3>
                <p>Aliquam accusamus esse maiores illum reprehenderit amet, voluptates illo error excepturi ratione, saepe nihil, necessitatibus quos delectus quod consequuntur ipsa veritatis magnam?</p>
            </div>
            <div class="icono ">
                <img src="build/img/icono3.svg " alt="icono tiempo " loading="lazy ">
                <h3>Tiempo</h3>
                <p>Aliquam accusamus esse maiores illum reprehenderit amet, voluptates illo error excepturi ratione, saepe nihil, necessitatibus quos delectus quod consequuntur ipsa veritatis magnam?</p>
            </div>

        </div>
    </main>
    
    <section class="seccion contenedor ">
<h2>Casas y Depas en Venta</h2>

<?php
$limite = 3; // Limite de anuncios
include 'includes/templates/anuncios.php'; //incluir archivo de anuncios
?>

        <!--contenedor-anuncio-->
        <div class="alinear-derecha ">
            <a href="anuncios.php " class="btn-verde ">Ver Todas</a>
        </div>
        </section>

        <section class="imagen-contacto ">
            <h2>Encuentra la Casa de tus Sueños</h2>
            <p>LLena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
            <a href="contacto.php " class="btn-amarillo ">Contáctanos</a>
        </section>
        <!-- sección imagen-contacto -->

        <div class="contenedor seccion seccion-inferior ">
            <section class="blog ">
                <h3>Nuestro Blog</h3>

                <article class="entrada-blog ">
                    <div class="imagen ">
                        <picture>
                            <source srcset="build/img/blog1.webp " type="image/webp ">
                            <source srcset="build/img/blog1.jpg " type="image/jpeg ">
                            <img loading="lazy " src="build/img/blog1.jpg " alt="Texto entrada Blog ">
                        </picture>
                    </div>
                    <div class="texto-entrada ">
                        <a href="entrada.php ">
                            <h4>Terraza en el Techo de Tu Casa</h4>
                            <p class="informacion-meta ">Escrito el <span>25-Sept-2021</span> por: <span>Darik Palacio</span></p>
                            <p>
                                Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.
                            </p>
                        </a>
                    </div>
                </article>

                <article class="entrada-blog ">
                    <div class="imagen ">
                        <picture>
                            <source srcset="build/img/blog2.webp " type="image/webp ">
                            <source srcset="build/img/blog2.jpg " type="image/jpeg ">
                            <img loading="lazy " src="build/img/blog2.jpg " alt="Texto entrada Blog ">
                        </picture>
                    </div>
                    <div class="texto-entrada ">
                        <a href="entrada.php ">
                            <h4>Guía para la Decoración de Tu Hogar</h4>
                            <p class="informacion-meta ">Escrito el <span>30-Ago-2021</span> por: <span>Johan Cotoplo</span></p>
                            <p>
                                Maximiza el espacio de tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio.
                            </p>
                        </a>
                    </div>
                </article>
            </section>

            <section class="testimoniales ">
                <h3>Testimoniales</h3>

                <div class="testimonial ">
                    <blockquote>
                        El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                    </blockquote>
                    <p>- Tatán Palacio</p>
                </div>
            </section>
        </div>

     
     
  <?php 
  incluirTemplates('footer');
  ?>