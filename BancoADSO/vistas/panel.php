<?php
$cuenta = $cuenta ?? null;
$saldo = $saldo ?? '0.00';
$mensajeExito = $mensajeExito ?? null;
?>

<div class="panel-contenedor">

    <header class="panel-cabecera">
        <div>
            <h1>Banco ADSO</h1>
            <p>Panel de tu cuenta</p>
        </div>

        <a href="index.php?ruta=login/salir">
            Cerrar sesión
        </a>
    </header>

    <?php if ($mensajeExito !== null): ?>
        <div class="mensaje-exito">
            <?= htmlspecialchars(
                $mensajeExito,
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </div>
    <?php endif; ?>

    <section class="cuenta">
        <h2>Mi cuenta</h2>

        <?php if ($cuenta !== null): ?>
            <p>
                <strong>Número de cuenta:</strong>
                <?= htmlspecialchars(
                    $cuenta->getNumeroCuenta(),
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </p>

            <p>
                <strong>Saldo disponible:</strong>
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

    <section class="acciones">
        <h2>Operaciones</h2>

        <a href="index.php?ruta=retiro/formulario">
            Realizar retiro
        </a>

        <a href="index.php?ruta=transferencia/formulario">
            Realizar transferencia
        </a>

        <a href="index.php?ruta=retiro/historial">
            Historial de retiros
        </a>

        <a href="index.php?ruta=transferencia/historial">
            Historial de transferencias
        </a>
    </section>

</div>