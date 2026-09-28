<?php

$retiros = $resumen['retiros'] ?? [];
$datosResumen = $resumen['resumen'] ?? [
    'cantidad' => 0,
    'total' => '0.00',
];

?>

<div class="historial-contenedor">

    <h1>Historial de retiros</h1>

    <section class="resumen">
        <h2>Resumen</h2>

        <p>
            <strong>Cantidad de retiros:</strong>
            <?= $datosResumen['cantidad'] ?>
        </p>

        <p>
            <strong>Total retirado:</strong>
            $<?= htmlspecialchars(
                $datosResumen['total'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>
    </section>

    <section class="lista-historial">

        <h2>Retiros realizados</h2>

        <?php if (count($retiros) === 0): ?>

            <p>No tienes retiros registrados.</p>

        <?php else: ?>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Valor</th>
                        <th>Fecha</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($retiros as $retiro): ?>

                        <tr>
                            <td>
                                <?= $retiro->getId() ?>
                            </td>

                            <td>
                                $<?= htmlspecialchars(
                                    $retiro->getValor(),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $retiro->getFecha(),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        <?php endif; ?>

    </section>

    <a href="index.php?ruta=panel/index">
        Volver al panel
    </a>

</div>
