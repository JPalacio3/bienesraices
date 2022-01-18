<?php require 'includes/app.php';
incluirTemplates('header'); ?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="imagen sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>
                <p>Sit amet consectetur adipisicing elit. Esse exercitationem id, eaque corporis quam modi quae ex ad nostrum ab consectetur, in laudantium quos vero inventore officia consequatur perferendis minus Lorem ipsum dolor sit amet consectetur,
                    adipisicing elit. Deserunt consequuntur, minus nesciunt dolore eligendi voluptate sed aliquam, est placeat laudantium ipsum? Quod doloribus, sequi delectus eum sint minima nihil excepturi. Quia repudiandae architecto esse quidem aliquidsimilique.
                </p>
                <p>Recusandae esse asperiores impedit dolores praesentium nobis perspiciatis magni aperiam minima repudiandae exercitationem nostrum quam rerum accusantium commodi! Nihil, quos odio. Lorem ipsum dolor sit amet, consectetur adipisicing elit.

                </p>
            </div>
    </main>
    </div>
    <section class="contenedor seccion">
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
</section>

<?php incluirTemplates('footer'); ?>