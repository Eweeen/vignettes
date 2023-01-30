<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        // usually you'll want to make sure the user is authenticated first,
        // see "Authorization" below
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        // Call whatever methods you've added to your User class
        // For example, if you added a getFirstName() method, you can use that.

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $categories = $categoriesRepository->findAll();

            return $this->render('profile/admin.html.twig', [
                'user' => $user,
                'categories' => $categories,
            ]);
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/add/categorie', name: 'add_categorie')]
    public function addCategorie(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $category = new Categories();
        $category->setLabel($request->get('label'));

        $errors = $validator->validate($category);

        if (count($errors) > 0) {
            dd($errors);
        }

        $entityManager->persist($category);
        $entityManager->flush();

        return $this->redirectToRoute('app_profile');
    }
}
