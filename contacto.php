<?php 
require 'includes/app.php';
incluirTemplates('header'); ?>

<main class="contenedor seccion">
    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image.webp">
        <source srcset="build/img/destacada3.jpg" type="image.jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
    </picture>

    <h2>Llene el formulario de Contacto</h2>

    <form class="formulario">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Tu nombre" id="nombre" required >

            <label for="email">E-mail:</label>
            <input type="email" placeholder="Tu Email" id="email" required >

            <label for="telefono">Teléfono:</label>
            <input type="tel" placeholder="Tu teléfono" id="telefono" required >

            <label for="mensaje">Mensaje:</label>
            <textarea name="mensaje" id="mensaje" > Escribe tu mensaje</textarea>
        </fieldset>
        <!--información personal-->

        <fieldset>
            <legend>Sobre la Propiedad</legend>
            <label for="opciones" >Vende o Compra</label>
            <select name="" id="opciones" required>
    <option value="" disabled selected >--Seleccione--</option>
    <option value="compra">Compra</option>
    <option value="vende">Vende</option>
                </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" min="100000" >
        </fieldset>
        <!--sobre la propiedad-->

        <fieldset>
            <legend>Contacto</legend>
            <p>¿Cómo desea ser contactado?</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto" type="radio" id="contactar-telefono" required>

                <label for="contactar-email">E-mail</label>
                <input name="contacto" type="radio" id="contactar-email" required>
            </div>
            <!--.forma-contacto-->

            <p>Si eligió teléfono, elija la fecha y la hora </p>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" required>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" required>
        </fieldset>

        <input type="submit" value="Enviar" class="btn-verde">
    </form>
</main>


<?php incluirTemplates('footer'); ?>
