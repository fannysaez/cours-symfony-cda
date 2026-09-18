<?php

namespace App\Controller;

use App\Entity\Tool;
use App\Form\ToolType;
use App\Repository\ToolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ToolController extends AbstractController
{
    #[Route('/tool', name: 'app_tool')]
    public function index(ToolRepository $toolRepository): Response
    {
        $tools = $toolRepository->findAll();
        return $this->render('tool/index.html.twig', [
            'tools' => $tools,
        ]);
    }

    #[Route('/tool-create', name: 'app_tool_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        //récupérer des données -> repository
        //envoyer ou modifier ou supprimer des données -> entityManger

        //récupérer l'entitée qu'on veux supprimer par le repository
        //une fois que c'est bon, on passe l'entitée à supprimer

        // $tool = new Tool();
        // $tool->setLabel(label: 'Notre super tool');
        // $tool->setDanger(danger: 8);
        // $tool->setCreatedAt(createdAt: new \DateTimeImmutable());

        // dump($tool);
        // $entityManager->persist($tool);
        // $entityManager->flush();

        $tool = new Tool();
        $form = $this->createForm(ToolType::class, $tool);

        //formulaire -> écoute ce qu'il se passe dans la request ($_GET || $_POST)
        $form->handleRequest($request);

        // Ensuite le if
        if ($form->isSubmitted() && $form->isValid()) {
            $tool->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($tool);
            $entityManager->flush();

            return $this->redirectToRoute(route:'app_tool');
        }

        return $this->render('tool/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
