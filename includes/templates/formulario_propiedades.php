<fieldset>
    <legend> Información General </legend>

    <label for='titulo'> Título </label>
    <input type='text' name='titulo' id='titulo' placeholder='Título de la Propiedad' require value="<?php echo s($propiedad->titulo); ?>">

    <label for='precio'> Precio </label>
    <input type='number' name='precio' id='precio' placeholder='Precio de la Propiedad' min=1000000 require value="<?php echo s($propiedad->precio); ?>">

    <label for='imagen'> Imagen </label>
    <input type='file' name='imagen' id='imagen' accept='image/jpeg, image/png, image/jpg'> <!-- permite seleccionar el tipo de archivo que se puede subir -->
    <?php 
    if($propiedad->imagen) {?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="imagen de la propiedad" class="imagen-small">
    <?php } ?>

    <label for='descripcion'> Descripción </label>
    <textarea name='descripcion' id='descripcion'><?php echo s($propiedad->descripcion); ?> </textarea>
</fieldset>
<!--Información General -->

<fieldset>
    <legend> Información de la Propiedad </legend>

    <label for='habitaciones'> Habitaciones </label>
    <input type='number' name='habitaciones' id='habitaciones' placeholder='Ejm: 3' require min=1 max=9 value="<?php echo s($propiedad->habitaciones); ?>">

    <label for='wc'> Baños </label>
    <input type='number' name='wc' id='wc' placeholder='Ejm: 3' require min=1 max=9 value="<?php echo s($propiedad->wc); ?>">

    <label for='estacionamiento'> Estacionamiento </label>
    <input type='number' name='estacionamiento' id='estacionamiento' placeholder='Ejm: 3' require min=1 max=9 value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>
<!--Información de la propiedad -->

<fieldset>
    <legend> Vendedor </legend>
    
</fieldset>
<!--Vendedor -->