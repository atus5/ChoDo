<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\DB;

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Show all databases
    echo "All available databases:\n";
    $databases = DB::select("SHOW DATABASES");
    foreach ($databases as $db) {
        $dbName = (array)$db;
        $name = reset($dbName);
        if (strpos($name, 'long') !== false || strpos($name, 'LONG') !== false) {
            echo "✓ $name (contains 'long')\n";
        } else {
            echo "  $name\n";
        }
    }
    
    // Check databases with phims table
    echo "\nDatabases with 'phims' table:\n";
    $result = DB::select("SELECT TABLE_SCHEMA FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='phims' GROUP BY TABLE_SCHEMA");
    foreach ($result as $row) {
        echo "✓ {$row->TABLE_SCHEMA}\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
