<?php
declare(strict_types=1);

use App\Controllers\ChangerController;

require_once realpath("vendor/autoload.php");
require("src/helpers.php");

$changer = new ChangerController();

try {
    $changer->calculateCommission(file_get_contents($argv[1]));
} catch (Exception $e) {
    return $e->getMessage();
}
