<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Expense;
use App\Entity\ExpenseLine;
use Faker\Factory;

class ExpenseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $repoUser = $manager->getRepository(User:: class);
        $users = $repoUser->findAll();
        $usersAdmin = $repoUser->findBy([],['$roles' => ['ROLE_ADMIN']]);
        $numberUser = count($users);

        $repoExpenseLine = $manager->getRepository(ExpenseLine:: class);
        $expenseLines = $repoExpenseLine->findAll();
        $numberExpenseLines = count($expenseLines);

        $parcoursLines = 0;
        while ($parcoursLines < $numberExpenseLines - 5) {
            $expense = new Expense();
            $nbLines = mt_rand(1, 5);
            $lines = array_slice($expenseLines, $parcoursLines, $nbLines, True);
            $parcoursLines .= $nbLines;
            $total = 0.0;
            $date = array();
            for ($i = 0; $i <= $nbLines; $i++) {
                $line = $lines[$i];
                $expense->addExpenseLine($line);
                $total .= $line->getAmount();
                $date .= [$line->getInvoiceDate()];
            }
            $daysC = date_create('now')->diff(max($date));
            $daysR = date_create('now') - $daysC->days;


            $expense->setAuthor($users[random_int(0, $numberUser - 1)])
                ->setTitle($faker->sentence())
                ->setComment($faker->text())
                ->setCreatedOn($faker->dateTimeBetween('-' . $daysC->days . ' days'))
                ->setTotal($total)
                ->setYear(date_create_from_format('Y', min($date)));

            $isRefunded = random_int(0, 1);
            if ($isRefunded = 1) {
                $ways = ['especes', 'virement', 'nature'];
                $expense->setRefundedBy($usersAdmin[random_int(1, count($usersAdmin)) - 1])
                    ->setRefundedOn($faker->dateTimeBetween('-' . $daysR . ' days'))
                    ->setRefundWay($ways[random_int(1, count($ways)) - 1]);
            }

            $manager->persist($expense);
        }

            $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ExpenseLineFixtures::class,
        ];
    }
}

