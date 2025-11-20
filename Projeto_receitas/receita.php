<?php
// index.php - entrada PHP simples que serve index.html se existir.
// Coloca index.php e index.html na mesma pasta.
// Se quiseres transformar o HTML em template PHP, basta renomear index.html para index.php e adaptar.

if (file_exists(__DIR__ . '/receita.html')) {
    // Serve index.html
    header('Content-Type: text/html; charset=utf-8');
    readfile(__DIR__ . '/receita.html');
    exit;
} else {
    // fallback
    echo "<!doctype html><html><head><meta charset='utf-8'><title>Landing</title></head><body>";
    echo "<h1>Proyecto</h1><p>Coloca o ficheiro <strong>index.html</strong> na mesma pasta que este index.php.</p>";
    echo "</body></html>";
}
