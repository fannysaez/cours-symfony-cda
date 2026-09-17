<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\IngredientFactory;
use App\Factory\ToolFactory;
use App\Factory\UserFactory;
use App\Factory\RecipeFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $array = ["Carotte", "Pomme", "Pdt"];
        foreach ($array as $value) {
            IngredientFactory::createOne([
                'label' => $value
            ]);
        }

        IngredientFactory::createMany(50);
        ToolFactory::createMany(20);
        UserFactory::createOne([
            'email' => 'admin@admin.fr',
            'roles' => ['ROLE_ADMIN'],
        ]);
        UserFactory::createMany(3000);
        RecipeFactory::createMany(500);
        $manager->flush();
    }
}
