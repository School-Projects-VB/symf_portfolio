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
        $lang = $translator->trans('lang');
        $titre = $translator->trans('titre.home');
        return $this->render('views/index.html.twig', ['title' => $titre, 'lang' => $lang]);
    }

    /**
     * @Route("/projects", name="projects")
     * @Route("/{_locale}/projects", name="projects")
     */
    public function projects(TranslatorInterface $translator): Response
    {
        $lang = $translator->trans('lang');
        $titre = $translator->trans('titre.projects');
        return $this->render('views/projects.html.twig', ['title' => $titre, 'lang' => $lang]);
    }

    /**
     * @Route("/cv", name="cv")
     * @Route("/{_locale}/cv", name="cv")
     */
    public function cv(TranslatorInterface $translator): Response
    {
        $lang = $translator->trans('lang');
        $titre = $translator->trans('titre.cv');
        return $this->render('views/cv.html.twig', ['title' => $titre, 'lang' => $lang]);
    }
}