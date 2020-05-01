<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Invoice;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($u = 0; $u < 10; $u++) {
            $user = new User();
            $chrono = 1;
            $user->setFirstName($faker->firstName())
                 ->setLastName($faker->lastName)
                 ->setEmail($faker->email)
                 ->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    'password'
                ));
            $manager->persist($user);

            for ($c = 1; $c <= mt_rand(5,20); $c++) {
                $customer = new Customer();
                $customer->setFirstName($faker->firstName())
                         ->setLastName($faker->lastName)
                         ->setCompany($faker->company)
                         ->setEmail($faker->email)
                         ->setUser($user);
    
                $manager->persist($customer);
    
                for( $i = 0; $i < mt_rand(3, 10); $i++) {
                    $invoice = new Invoice();
                    $invoice->setAmount($faker->randomFloat(2, 250, 5000))
                            ->setSentAt($faker->dateTimeBetween(('-6 months')))
                            ->setStatus($faker->randomElement(['SENT', 'PAID', 'CANCELLED']))
                            ->setCustomer($customer)
                            ->setChrono($chrono);
                    $chrono++;
                    $manager->persist($invoice);
    
                }
            }
       }


        $manager->flush();
    }
}
