<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('calculator/index.html.twig');
    }

    public function result()
    {

    }
}
