<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User ;
use Faker\Factory;

class UserFixtures extends Fixture
{
    /**
     * @throws \Exception
     */

    public function fctRetirerAccents($varMaChaine)
    {
        $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');

        $varMaChaine = str_replace($search, $replace, $varMaChaine);
        return $varMaChaine;
    }

    public function fctChoixRoles($varNombre)
    {
        if ($varNombre < 3) {
            return ['ROLE_ADMIN'];
        }
        elseif ($varNombre < 5){
            return ['ROLE_BR'];
        }
        else {
            return ['ROLE_USER'];
        }
    }

    public function fctChoixPosition($varNombre)
    {
        if ($varNombre = 1) {
            return 'president';
        }
        elseif ($varNombre = 2){
            return 'vice-president';
        }
        elseif ($varNombre = 3){
            return 'tresorier';
        }
        elseif($varNombre = 4){
            return 'secretaire';
        }
        else {
            return 'membre';
        }
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //Création de 15 users
        for ($i = 1; $i <= 15; $i++) {
            $user = new User();
            $user->setFirstName($this->fctRetirerAccents($faker->firstName()))
                 ->setLastName($this->fctRetirerAccents($faker->lastName()));
            $prenom = strtolower($user->getFirstName());
            $nom = strtolower($user->getLastName());
            $user->setUsername(substr($prenom, 0, 1) . $nom)
                ->setEmail($user->getUsername() . '@ec-m.fr')
                ->setPassword($faker->password())
                ->setPromo(mt_rand(2017, 2021))
                ->setRoles($this->fctChoixRoles($i))
                ->setPosition($this->fctChoixPosition($i));

            $manager->persist($user);
        }

        $moi = new User();
        $moi->setUsername('ibaguette');
        $moi->setFirstName('Ines');
        $moi->setLastName('Baguette');
        $moi->setEmail('ibaguette@ec-m.fr');
        $moi->setRoles(['ROLE_ADMIN']);
        $moi->setPromo(2021);
        $moi->setPassword('miam');
        $moi->setPosition('Grande-Manitou');

        $manager->persist($moi);

        $manager->flush();
    }
}
