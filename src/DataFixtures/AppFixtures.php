<?php

namespace App\DataFixtures;

use Generator;
use Faker\Factory;
use App\Entity\Admin;
use App\Entity\Author;
use App\Entity\Member;
use App\Entity\Article;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AppFixtures extends Fixture
{
    /**
     * Undocumented variable
     *
     * @var Generator
     */
    private Generator $faker;

    private $passwordHasherFactory;

    public function __construct(private SluggerInterface $slugger, PasswordHasherFactoryInterface $encoderFactory, 
    
    )
    {
        $this->passwordHasherFactory = $encoderFactory;
      //  $this->teacherRepository = $teacherRepository;
      //  $this->courseCategoryRepository = $courseCategoryRepository;
       
       
    }

  
    public function load(ObjectManager $manager): void
    {
        $this->faker= Factory::create('fr_FR');

     //   $admin = new Admin();
      //  $admin->setRoles(['ROLE_ADMIN']);
      //  $admin->setEmail('admin@taggast.org');
       // $admin->setPassword($this->passwordHasherFactory->getPasswordHasher(Admin::class)->hash('admin', null));
     //   $manager->persist($admin);

        for ($i=0; $i < 20 ; $i++) { 
            
        $member = new Member();
        $member->setProfilePicture($this->faker->imageUrl());
        $member->setEmail($this->faker->email());
        $member->setFirstName($this->faker->name());
        $member->setLastName($this->faker->name());
        $manager->persist($member);

        }

        for ($i=0; $i < 5 ; $i++) { 
            
         //    $author = new Author();
         //    $author->setRoles(['ROLE_AUTHOR']);
          //   $author->setEmail($this->faker->email());
         //    $author->setPassword($this->passwordHasherFactory->getPasswordHasher(Author::class)->hash('123456', null));
         //    $author->setFirstName($this->faker->name());
          //   $author->setLastName($this->faker->name());
          //   $author->setDescription($this->faker->text());
         //    $author->setIsApproved(true);
          //   $manager->persist($author);
    
            }
            for ($i=0; $i < 5 ; $i++) { 
            
                $project = new Project();
                $project->setTitle($this->faker->name());
                $project->setSlug($this->slugger->slug($project->getTitle())->lower());
               // $courseCategory->setSlug($this->slugger->slug($courseCategory->getSlug()));
                $project->setContent($this->faker->text());
                $manager->persist($project);
        
                }

                for ($i=0; $i < 5 ; $i++) { 
            
                    $article = new Article();
                    $article->setTitle($this->faker->name());
                    $article->setSlug($this->slugger->slug($article->getTitle())->lower());
                   // $courseCategory->setSlug($this->slugger->slug($courseCategory->getSlug()));
                    $article->setContent($this->faker->text());
                    $manager->persist($article);
            
                    }

        $manager->flush();
    }

}
