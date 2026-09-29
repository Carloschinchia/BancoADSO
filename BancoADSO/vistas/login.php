<?php
$error = $error ?? null;
?>

<div class="contenedor">

    <h1>Banco ADSO</h1>

    <h2>Iniciar sesión</h2>

    <?php if ($error !== null): ?>
        <div class="mensaje mensaje-error">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form
        class="formulario"
        method="POST"
        action="index.php?ruta=login/procesar"
    >

        <label for="numero_cuenta">
            Número de cuenta
        </label>

        <input
            type="text"
            id="numero_cuenta"
            name="numero_cuenta"
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
            Iniciar sesión
        </button>

    </form>

</div>