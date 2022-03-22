<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ExpenseLine;
use Faker\Factory;

class ExpenseLineFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $numberExpenseLines = 30;

        for ($i = 0; $i <= $numberExpenseLines; $i++) {
            $expenseLine = new ExpenseLine();
            $expenseLine->setNature($faker->sentence())
                ->setDescription($faker->sentences(2, True))
                ->setInvoiceDate($faker->dateTimeBetween('-3 years'))
                ->setAmount($faker->randomFloat(2, 0, 10000))
                ->setInvoiceFile('expenseline'.$i .'.pdf');

            $manager->persist($expenseLine);
        }

        $manager->flush();
    }
}
