<fieldset>
    <legend> Información General </legend>

    <label for='titulo'> Título </label>
    <input type='text' name='titulo' id='titulo' placeholder='Título de la Propiedad' require value="<?php echo s( $propiedad->titulo ); ?>">

    <label for='precio'> Precio </label>
    <input type='number' name='precio' id='precio' placeholder='Precio de la Propiedad' min=1000000 require value="<?php echo s( $propiedad->precio ); ?>">

    <label for='imagen'> Imagen </label>
    <input type='file' name='imagen' id='imagen' accept='image/jpeg, image/png, image/jpg' > <!-- permite seleccionar el tipo de archivo que se puede subir -->

    <label for='descripcion'> Descripción </label>
    <textarea name='descripcion' id='descripcion'><?php echo s( $propiedad->descripcion );?> </textarea>
</fieldset>
<!--Información General -->

<fieldset>
    <legend> Información de la Propiedad </legend>

    <label for='habitaciones'> Habitaciones </label>
    <input type='number' name='habitaciones' id='habitaciones' placeholder='Ejm: 3' require min=1 max=9 value="<?php echo s( $propiedad->habitaciones ); ?>">

    <label for='wc'> Baños </label>
    <input type='number' name='wc' id='wc' placeholder='Ejm: 3' require min=1 max=9 value="<?php echo s( $propiedad->wc ); ?>">

    <label for='estacionamiento'> Estacionamiento </label>
    <input type='number' name='estacionamiento' id='estacionamiento' placeholder='Ejm: 3' require min=1 max=9 value="<?php echo s( $propiedad->estacionamiento ); ?>">
</fieldset>
<!--Información de la propiedad -->

<fieldset>
    <legend> Vendedor </legend>
    <select name='vendedorId' id='vendedorId'>
        <option selected disabled> Seleccione vendedor </option>
        <?php while ($vendedorId = mysqli_fetch_assoc($resultado)) : ?>
            <option <?php echo $propiedad->vendedorId == $propiedad->vendedorId->id ? 'selected' : '';
                    ?> value=" <?php echo $propiedad->vendedorId['id']; ?> ">
                <?php echo $propiedad->vendedorId['nombre'] . ' ' . $propiedad->vendedorId['apellido'];
                ?>
                <!-- insertamos los valores de los vendedores con los valores de la base de datos -->
            </option>
        <?php endwhile;
        ?>

    </select>
</fieldset>
<!--Vendedor -->