<?php
$error = $error ?? null;
?>

<div class="contenedor">

    <h1>Realizar transferencia</h1>

    <?php if ($error !== null): ?>
        <div class="mensaje mensaje-error">
            <?= htmlspecialchars(
                $error,
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </div>
    <?php endif; ?>

    <form
        class="formulario"
        method="POST"
        action="index.php?ruta=transferencia/procesar"
    >

        <label for="numero_cuenta_destino">
            Número de cuenta destino
        </label>

        <input
            type="text"
            id="numero_cuenta_destino"
            name="numero_cuenta_destino"
            required
        >

        <label for="valor">
            Valor de la transferencia
        </label>

        <input
            type="text"
            id="valor"
            name="valor"
            placeholder="Ejemplo: 50000.00"
            required
        >

        <label for="contrasena">
            Contraseña
        </label>

        <input
            type="password"
            id="contrasena"
            name="contrasena"
            required
        >

        <button type="submit">
            Realizar transferencia
        </button>

    </form>

    <div class="acciones-secundarias">
        <a href="index.php?ruta=panel/index">
            Volver al panel
        </a>
    </div>

</div>