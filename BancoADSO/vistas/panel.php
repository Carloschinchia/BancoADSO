<?php
$cuenta = $cuenta ?? null;
$saldo = $saldo ?? '0.00';
$mensajeExito = $mensajeExito ?? null;
?>

<div class="contenedor">

    <header class="barra">
        <div>
            <div class="marca">Banco ADSO</div>
            <div>Panel de tu cuenta</div>
        </div>

        <nav class="navegacion">
            <a
                class="enlace-salir"
                href="index.php?ruta=login/salir"
            >
                Cerrar sesión
            </a>
        </nav>
    </header>

    <?php if ($mensajeExito !== null): ?>
        <div class="mensaje mensaje-exito">
            <?= htmlspecialchars(
                $mensajeExito,
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </div>
    <?php endif; ?>

    <section class="tarjeta-saldo">

        <h1>Mi cuenta</h1>

        <?php if ($cuenta !== null): ?>

            <p class="etiqueta">
                Número de cuenta
            </p>

            <p class="numero-cuenta">
                <?= htmlspecialchars(
                    $cuenta->getNumeroCuenta(),
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>

            <p class="etiqueta">
                Saldo disponible
            </p>

            <p class="saldo">
                $<?= htmlspecialchars(
                    $saldo,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>

        <?php else: ?>

            <p>No se encontró información de la cuenta.</p>

        <?php endif; ?>

    </section>

    <section>

        <h1>Operaciones</h1>

        <div class="accesos-rapidos">

            <a
                class="boton"
                href="index.php?ruta=retiro/formulario"
            >
                Realizar retiro
            </a>

            <a
                class="boton"
                href="index.php?ruta=transferencia/formulario"
            >
                Realizar transferencia
            </a>

            <a
                class="boton"
                href="index.php?ruta=retiro/historial"
            >
                Historial de retiros
            </a>

            <a
                class="boton"
                href="index.php?ruta=transferencia/historial"
            >
                Historial de transferencias
            </a>

        </div>

    </section>

</div>