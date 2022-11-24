<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\RegistrationAuthorFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/devenir-auteur-du-blog', name: 'app_register_teacher')]
    public function registerTeacher(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $author = new Author();
        $form = $this->createForm(RegistrationAuthorFormType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $author->setPassword(
            $userPasswordHasher->hashPassword(
                    $author,
                    $form->get('plainPassword')->getData()
                )
            );

            /** @var UploadedFile $profilePictureFile */
            $profilePictureFile = $form->get('profilePicture')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($profilePictureFile) {
                $originalFilename = pathinfo($profilePictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$profilePictureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $profilePictureFile->move(
                        $this->getParameter('profile_pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $author->setProfilePicture($newFilename);
            }

            $entityManager->persist($author);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash('success', 'Votre demande a été transmise ! Un membre de notre équipe prendra contact avec vous afin de fixer un entretien très rapidement ! ');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register_author.html.twig', [
            'registrationAuthorForm' => $form->createView(),
        ]);
    }
}
