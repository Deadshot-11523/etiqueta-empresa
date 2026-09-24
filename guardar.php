<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['empresa'])) {
    $empresas   = $_POST['empresa'];
    $codigos    = $_POST['codigo'];
    $nombres    = $_POST['nombre'];
    $cantidades = $_POST['cantidad'];
} else {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Impresión de Lote de Etiquetas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body onload="window.print()">

    <div class="no-print" style="text-align: center; margin-bottom: 15px;">
        <button onclick="window.print()" style="padding: 8px 16px; cursor: pointer; font-weight: bold;">Imprimir de nuevo</button>
    </div>

    <div class="impresion-contenedor">
        <?php 
        // Recorrer cada producto registrado
        for ($i = 0; $i < count($empresas); $i++): 
            $empresa  = htmlspecialchars($empresas[$i]);
            $codigo   = htmlspecialchars($codigos[$i]);
            $nombre   = htmlspecialchars($nombres[$i]);
            $cantidad = intval($cantidades[$i]);

            // Determinar contorno por empresa
            switch ($empresa) {
                case 'Hoverd.jpg':
                    $claseBorde = 'borde-hoverd';
                    break;
                case 'A.T.P.jpg':
                    $claseBorde = 'borde-atp';
                    break;
                case 'Proyectos de ingenieria.jpg':
                    $claseBorde = 'borde-proyectos';
                    break;
                default:
                    $claseBorde = 'borde-ekipment';
                    break;
            }

            // Repetir la impresión según la cantidad de cada producto
            for ($k = 0; $k < $cantidad; $k++):
        ?>
            <div class="etiqueta-box <?php echo $claseBorde; ?>">
                <div class="info-seccion">
                    <div class="nombre-producto">
                        <?php echo nl2br(strtoupper($nombre)); ?>
                    </div>
                    <div class="codigo-producto">
                        <?php echo strtoupper($codigo); ?>
                    </div>
                </div>

                <div class="logo-seccion">
                    <img src="<?php echo $empresa; ?>" alt="Logo Marca">
                </div>
            </div>
        <?php 
            endfor;
        endfor; 
        ?>
    </div>

</body>
</html>