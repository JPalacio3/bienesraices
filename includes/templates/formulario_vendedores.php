<fieldset>
    <legend>Formulario de Vendedor</legend>

    <label for="nombre"> Nombre </label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre de Vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido"> Apellido </label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido de Vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">
</fieldset>

<fieldset>
    <legend>Información Extra</legend>
    <label for="telefono"> Teléfono </label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Teléfono" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>