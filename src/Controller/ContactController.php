<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/{_locale}/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index", methods={"GET"})
     */
    public function index(TranslatorInterface $translator, ContactRepository $contactRepository): Response
    {
        $lang = $translator->trans('lang');
        $titre = $translator->trans('titre.contact.home');
        return $this->render('contact/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
            'title' => $titre,
            'lang' => $lang
        ]);
    }

    /**
     * @Route("/new", name="contact_new", methods={"GET","POST"})
     */
    public function new(TranslatorInterface $translator, Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        $lang = $translator->trans('lang');
        $titre = $translator->trans('titre.contact.new');

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact/new.html.twig', [
            'title' => $titre,
            'lang' => $lang,
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="contact_show", methods={"GET"})
     */
    public function show(TranslatorInterface $translator, Contact $contact): Response
    {
        $lang = $translator->trans('lang');
        $titre = $translator->trans('titre.contact.show');

        return $this->render('contact/show.html.twig', [
            'title' => $titre,
            'lang' => $lang,
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contact_edit", methods={"GET","POST"})
     */
    public function edit(TranslatorInterface $translator, Request $request, Contact $contact): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        $lang = $translator->trans('lang');
        $titre = $translator->trans('titre.contact.edit');

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact/edit.html.twig', [
            'title' => $titre,
            'lang' => $lang,
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="contact_delete", methods={"POST"})
     */
    public function delete(TranslatorInterface $translator, Request $request, Contact $contact): Response
    {
        $lang = $translator->trans('lang');
        $titre = $translator->trans('titre.contact.delete');

        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_index', [
            'title' => $titre,
            'lang' => $lang,
        ], Response::HTTP_SEE_OTHER);
    }
}
