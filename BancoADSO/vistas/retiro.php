<?php
$error = $error ?? null;
?>

<div class="formulario-contenedor">

    <h1>Realizar retiro</h1>

    <?php if ($error !== null): ?>
        <div class="mensaje-error">
            <?= htmlspecialchars(
                $error,
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </div>
    <?php endif; ?>

    <form
        method="POST"
        action="index.php?ruta=retiro/procesar"
    >

        <div class="campo">
            <label for="valor">
                Valor del retiro
            </label>

            <input
                type="text"
                id="valor"
                name="valor"
                placeholder="Ejemplo: 50000.00"
                required
            >
        </div>

        <div class="campo">
            <label for="contrasena">
                Contraseña
            </label>

            <input
                type="password"
                id="contrasena"
                name="contrasena"
                required
            >
        </div>

        <button type="submit">
            Realizar retiro
        </button>

    </form>

    <a href="index.php?ruta=panel/index">
        Volver al panel
    </a>

</div>