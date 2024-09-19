<?php

namespace App\DataFixtures;

use App\Factory\CustomerFactory;
use App\Factory\ProductFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Zenstruck\Foundry\Test\Factories;

class AppFixtures extends Fixture
{
    use Factories;

    public function load(ObjectManager $manager): void
    {
        ProductFactory::createMany(rand(30,100));
        CustomerFactory::createMany(rand(100,1000));
    }
}
