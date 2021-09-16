<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @throws Exception
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}