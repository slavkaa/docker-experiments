<?php
namespace App\Controllers;

use App\System\Routing\Route;

class AttributesDemoController
{
    #[Route('/attributes/case-1-routing')]
    #[Route(routePath: '/attributes/routing')]
    #[Route('/attributes/routing/{id}')]
    #[Route('/attributes/routing/{id}/{index}')]
    public function case_1_routing($id = null, $index = null): void
    {
        echo "Here I use Route attribute of AttributesDemoController method case1(). ID = $id. INDEX = $index";
    }
}