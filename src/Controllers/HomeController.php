<?php

namespace App\Controllers;

use Core\Controller;

/**
* 
*/
class HomeController extends Controller
{
    /**
    * 
    */
    public function index($request, $response)
    {
        return $this->view->render($response, 'admin/post-list.twig');
    }
}