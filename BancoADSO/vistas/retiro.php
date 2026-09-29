<?php
$error = $error ?? null;
?>

<div class="contenedor">

    <h1>Realizar retiro</h1>

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
        action="index.php?ruta=retiro/procesar"
    >

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
            Realizar retiro
        </button>

    </form>

    <div class="acciones-secundarias">
        <a href="index.php?ruta=panel/index">
            Volver al panel
        </a>
    </div>

</div>