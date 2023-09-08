<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Team;
use AppBundle\Form\TeamType;

class TeamController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('base.html.twig');
    }

    public function listAction(Request $request)
    {
        $teams = $this->getDoctrine()->getManager()->getRepository("AppBundle:Team")->findAll();

        return $this->render('AppBundle:Team:list.html.twig',[
            "teams" => $teams
        ]);
    }

    public function newAction(Request $request)
    {
        $team = new Team();

        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                if ($this->getDoctrine()->getRepository(Team::class)->exist($team)) {
                    $this->addFlash('error', 'El equipo ya existe.');
                } else {
                    $this->getDoctrine()->getManager()->persist($team);
                    $this->getDoctrine()->getManager()->flush();
                    $this->addFlash('success', 'El equipo se ha guardado correctamente.');
                }
            }
        }

        return $this->render('AppBundle:Team:new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    public function editAction(Request $request,$id)
    {
        if (!$team = $this->getDoctrine()->getRepository('AppBundle:Team')->findOneById($request->get('id'))) {
            $team = new Team();
            $repository = $this->getDoctrine()->getManager()->getRepository("AppBundle:Team");
        }

        $form = $this->createForm(TeamType::class,$team);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $team = $form->getData();
                $this->getDoctrine()->getManager()->persist($team);
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash('success', 'El equipo se ha guardado correctamente.');
            }
        }

        return $this->render('AppBundle:Team:edit.html.twig',
            [
                "form" => $form->createView()
            ]
        );
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $team = $em->getRepository('AppBundle:Team')->find($id);

        $em->remove($team);
        $em->flush();

        return $this->redirectToRoute('team_list');
    }

    public function tableAction()
    {
        $table = $this->getDoctrine()->getManager()->getRepository('AppBundle:Team')->calculateTeamPoints();

        return $this->render('AppBundle:Team:positions.html.twig', [
            'table' => $table,
        ]);
    }
}