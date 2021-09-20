<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Route("/{_locale}/", name="index")
     */
    public function index(TranslatorInterface $translator): Response
    {
        $titre = $translator->trans('titre.accueil');
        return $this->render('index.html.twig', ['title' => $titre]);
    }

    /**
     * @Route("/projects", name="projects")
     */
    public function projects(): Response
    {
        return $this->render('projects.html.twig');
    }

    /**
     * @Route("/cv", name="cv")
     */
    public function cv(): Response
    {
        return $this->render('cv.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('contact.html.twig');
    }
}