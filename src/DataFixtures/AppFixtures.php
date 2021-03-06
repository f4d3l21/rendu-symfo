<?php

namespace App\DataFixtures;

//require_once 'vendor/autoload.php';

use App\Entity\Annonce;
use App\Entity\Photo;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fake = (new \Faker\Factory())::create();
        $fake->addProvider(new \Faker\Provider\Fakecar($fake));
        $faker = Faker\Factory::create();

        for ($i=0; $i < 15; $i++) {
            $annonce = new Annonce();
            $annonce->setTitle($fake->vehicle())
            ->setDescription($faker->paragraph(2))
            ->setPrice($faker->randomNumber(4, true))
            ->setCreatedAt($faker->dateTime())
            ->setCity($faker->city());
            $manager->persist($annonce);
        }

        for ($i=0; $i < 15; $i++) { 
            $photo = new Photo();
            $photo->setPathImg($faker->imageUrl(640, 480, 'cars', true));
            $manager->persist($photo);
        }

        for ($i=0; $i <15; $i++) { 
            $type = new Type();
            $type->setTypeofvehicle($fake->vehicleType());
            $manager->persist($type);
        }

        for ($i=0; $i < 15; $i++) {
            $user = new User();
            $user->setEmail($faker->email())
            ->setRoles(array('ROLE_USER'))
            ->setPassword($faker->password())
            ->setUserName($faker->userName())
            ->setAdresse($faker->address())
            ->setPhone($faker->randomNumber(9, true));
            $manager->persist($user);
        }

        for ($i=0; $i < 15; $i++) { 
            $vehicle = new Vehicle();
            $vehicle
            ->setMarque($fake->vehicleBrand())
            ->setModel($fake->vehicleModel())
            ->setYear($faker->year())
            ->setKm($faker->numberBetween(5000, 200000))
            ->setCarburant($fake->vehicleFuelType())
            ->setCouleur($faker->safeColorName())
            ->setPuissance($faker->numberBetween(75, 400));
            $manager->persist($vehicle);
        }

        $manager->flush();
    }
}
