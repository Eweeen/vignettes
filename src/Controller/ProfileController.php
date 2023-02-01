<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Categories;
use App\Entity\Medias;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

        $categories = $entityManager->getRepository(Categories::class, 'categories')->findAll();
        
        if (!in_array('ROLE_ADMIN', $user->getRoles())) {
            $medias = $entityManager->getRepository(Medias::class, 'medias')->findBy(array('user' => $user->getId()));

            return $this->render('profile/index.html.twig', [
                'user' => $user,
                'categories' => $categories,
                'medias' => $medias,
            ]);
        }

        $users = $entityManager->getRepository(User::class, 'users')->findAll();

        return $this->render('profile/admin.html.twig', [
            'user' => $user,
            'categories' => $categories,
            'users' => $users,
        ]);
    }
}
