<?php
namespace App\Controllers;

use App\System\Config;
use App\System\Routing\Route;

class IndexController
{
    #[Route('/')]
    public function index($id = null, $index = null): void
    {
        require_once Config::getPathToView(subPath: 'index.php');
    }
}