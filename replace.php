<?php
$replacements = [
    '���' => '<i class="fa-solid fa-chart-simple"></i>',
    '���' => '<i class="fa-solid fa-hand-sparkles"></i>',
    '���' => '<i class="fa-solid fa-champagne-glasses"></i>',
    '���' => '<i class="fa-solid fa-clapperboard"></i>',
    '✅' => '<i class="fa-solid fa-circle-check"></i>',
    '���' => '<i class="fa-solid fa-file-signature"></i>',
    '✓' => '<i class="fa-solid fa-check"></i>',
    '✗' => '<i class="fa-solid fa-xmark"></i>',
    '⚠️' => '<i class="fa-solid fa-triangle-exclamation"></i>',
    '➕' => '<i class="fa-solid fa-plus"></i>',
    '���' => '<i class="fa-solid fa-lightbulb"></i>',
    '���' => '<i class="fa-solid fa-users"></i>'
];

$directory = new RecursiveDirectoryIterator('resources/views');
$iterator = new RecursiveIteratorIterator($directory);
foreach ($iterator as $file) {
    if ($file->isFile() && strpos($file->getFilename(), '.blade.php') !== false) {
        $path = $file->getRealPath();
        $content = file_get_contents($path);
        $newContent = str_replace(array_keys($replacements), array_values($replacements), $content);
        if ($content !== $newContent) {
            file_put_contents($path, $newContent);
            echo "Updated: $path\n";
        }
    }
}
