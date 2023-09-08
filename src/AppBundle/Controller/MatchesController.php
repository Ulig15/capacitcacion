<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Matches;
use AppBundle\Form\MatchesType;

class MatchesController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('base.html.twig');
    }

    public function listAction(Request $request)
    {
        $matches = $this->getDoctrine()->getManager()->getRepository("AppBundle:Matches")->findAll();

        return $this->render('AppBundle:Matches:list.html.twig', [
            "matches" => $matches
        ]);
    }

    public function newAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Matches::class);
        $matches = $repository->findAll();
        $matches = new Matches();

        $form = $this->createForm(MatchesType::class, $matches);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $this->getDoctrine()->getManager()->persist($matches);
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash('success', 'El partido se guardo correctamente.');
            }
        }

        return $this->render('AppBundle:Matches:new.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    public function editAction(Request $request, $id)
    {
        if (! $matches = $this->getDoctrine()->getRepository('AppBundle:Matches')->findOneById($request->get('id'))) {
            $matches = new Matches();
            $repository = $this->getDoctrine()->getManager()->getRepository("AppBundle:Matches");
        }

        $form = $this->createForm(MatchesType::class, $matches);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->persist($matches);
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash('success', 'El equipo se ha guardado correctamente.');
            }
        }

        return $this->render('AppBundle:Matches:edit.html.twig',
            [
                "form" => $form->createView()
            ]
        );
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $matches = $em->getRepository('AppBundle:Matches')->find($id);

        $em->remove($matches);
        $em->flush();

        return $this->redirectToRoute('matches_list');
    }
}