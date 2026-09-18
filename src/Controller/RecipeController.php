<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RecipeController extends AbstractController
{
    #[Route('/recipe/{id}', name: 'app_recipe_item')]
    public function item($id, RecipeRepository $recipeRepository): Response
    {
        //findAll => tableau d'entititées, si rien tableau vide
        //find => tableau d'entitées, si rien NULL

        //findAll => [Entity] | []
        //find => Entity | Null

        dump($id);
        $recipe = $recipeRepository->find($id);
        if ($recipe === null) {
            return $this->redirectToRoute(route: 'app_home');
        }
        dump($recipe);
        return $this->render('recipe/item.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[Route('/recipe-create', name: 'app_recipe_create')]
    public function addRecipe(EntityManagerInterface $em, Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $recipe->setUser($this->getUser()); // ← commenter pour l'instant
            $recipe->setCreatedAt(new \DateTimeImmutable());
            $em->persist($recipe);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('recipe/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
