<?php
$error = $error ?? null;
?>

<div class="login-contenedor">
    <div class="login-tarjeta">
        <h1>Banco ADSO</h1>

        <h2>Iniciar sesión</h2>

        <?php if ($error !== null): ?>
            <div class="mensaje-error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form
            method="POST"
            action="index.php?ruta=login/procesar"
        >
            <div class="campo">
                <label for="numero_cuenta">
                    Número de cuenta
                </label>

                <input
                    type="text"
                    id="numero_cuenta"
                    name="numero_cuenta"
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
                Iniciar sesión
            </button>
        </form>
    </div>
</div>