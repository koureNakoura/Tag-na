<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Address;
use App\Entity\Article;
use App\Entity\Profile;
use App\Entity\Category;
use App\Repository\UserRepository;
use EsperoSoft\Faker\Faker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class ArticleFixtures extends Fixture
{

    private $passwordHasherFactory;

    public function __construct(PasswordHasherFactoryInterface $encoderFactory, 
   
    )
    {
        $this->passwordHasherFactory = $encoderFactory;
     
       
       
    }

    public function load(ObjectManager $manager): void
    {
        $faker = new Faker();
        
       // $users = [];
       // for($i = 0; $i < 100; $i++){
       //     $user = (new User())->setFullName($faker->full_name())
       //                         ->setEmail($faker->email())
       //                         ->setRoles(['ROLE_USER'])
       //                        // ->setPassword(sha1("dfsfsdferfger"))
       //                         //->setCreatedAt($faker->dateTimeImmutable())
       //                         ->setPassword($this->passwordHasherFactory->getPasswordHasher(User::class)->hash('123456', null));
       //     ;
       //     $address = (new Address())//->setStreet($faker->streetAddress())
       //                              // ->setCodePostal($faker->codepostal())
       //                               ->setCity($faker->city())
       //                               ->setCountry($faker->country())
       //                              // ->setCreatedAt($faker->dateTimeImmutable())
       //     ;
       //     $profile = (new Profile())->setPicture($faker->image())
       //                            //   ->setCoverPicture($faker->image())
       //                               ->setDescription($faker->text(60))
       //                               ->setCreatedAt($faker->dateTimeImmutable())
       //     ;
       //     $user->addAddress($address);
       //     $user->setProfile($profile);
       //     $users[] = $user;
       //     $manager->persist($address);
       //     $manager->persist($profile);
       //     $manager->persist($user);
       // }

        $categories = [];
        for ($i=0; $i < 10 ; $i++) { 
            $category = (new Category())->setName($faker->text(30))
                                        ->setDescription($faker->text(60))
                                      //  ->setImageUrl($faker->image())
                                     //   ->setCreatedAt($faker->dateTimeImmutable())
            ;
            $categories[] = $category;
            $manager->persist($category);
        }

        for ($i=0; $i < 300 ; $i++) { 
            $article = (new Article())->setTitle($faker->text(30))
                                        ->setContent($faker->text(5,10))
                                        ->setPhoto($faker->image())
                                        ->setCreatedAt($faker->dateTimeImmutable())
                                     //   ->setAuthor($users[rand(0, count($users)-1)])
                                        ->addCategory($categories[rand(0, count($categories)-1)])
            ;
            $manager->persist($article);
        }

        $manager->flush();
    }
}
