<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        if($recipe === null){
           return $this->redirectToRoute(route:'app_home');
            }
        dump($recipe);
        return $this->render('recipe/item.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
