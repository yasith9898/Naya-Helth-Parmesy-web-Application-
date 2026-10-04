<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Get partners from DB
$partners = \App\Models\Partner::all();

echo "=== Partners in Database ===\n";
foreach ($partners as $partner) {
    echo "ID: {$partner->id}\n";
    echo "Name EN: {$partner->name['en']}\n";
    echo "Image: {$partner->image}\n";

    $storagePath = "storage/app/public/{$partner->image}";
    $publicStoragePath = "public/storage/{$partner->image}";
    $publicPath = "public/{$partner->image}";

    echo "  - Storage disk exists: " . (file_exists($storagePath) ? "YES" : "NO") . "\n";
    echo "  - Public/storage exists: " . (file_exists($publicStoragePath) ? "YES" : "NO") . "\n";
    echo "  - Public exists: " . (file_exists($publicPath) ? "YES" : "NO") . "\n";
    echo "\n";
}
?>
