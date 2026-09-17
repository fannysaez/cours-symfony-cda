<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\RecipeRepository;
use App\Repository\ToolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(IngredientRepository $ingredientRepository, RecipeRepository $recipeRepository, ToolRepository $toolRepository): Response
    {

        $myVar = 'aurevoir';
        $array = [1, 2, 3];
        $age = 20;

        // dump($array);   // affiche le tableau dans le navigateur
        // dump($myVar);   // affiche la string 'aurevoir'

        $ingredientEntities = $ingredientRepository->findAll();
        $recipes = $recipeRepository->findAll();
        $tools = $toolRepository->findAll();
        $ingredient = $ingredientRepository->findOneBy(['label' => 'carotte']);
        $ingredients = $ingredientRepository->findBy(['label' => 'carotte']);
        dump($ingredient);
        dump($ingredients);
        // dump($ingredientEntities);
        //  dump($recipes);

        return $this->render('home/index.html.twig',  [
                'exempleVariable' => $myVar,
                'age' => $age,
                'array' => $array,
                'ingredientEntities' => $ingredientEntities,
                'recipes' => $recipes,
                'tools' => $tools,

        ]);
    }
}
