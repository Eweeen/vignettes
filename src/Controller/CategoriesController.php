<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CategoriesController extends AbstractController
{
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

    #[Route('/edit/category', name: 'edit_category')]
    public function editCategory(Request $request, EntityManagerInterface $entityManager, CategoriesRepository $categoriesRepository)
    {
        $category = $categoriesRepository->find($request->get('category'));

        if(!$category) return $this->redirectToRoute('app_profile');

        $category->setLabel($request->get('label'));
        $entityManager->flush();
        
        return $this->redirectToRoute('app_profile');
    }

    #[Route('/delete/category', name: 'delete_category')]
    public function deleteCategory(Request $request, EntityManagerInterface $entityManager, CategoriesRepository $categoriesRepository)
    {
        $category = $categoriesRepository->find($request->get('category'));

        if(!$category) return $this->redirectToRoute('app_profile');

        $categoriesRepository->remove($category, true);
        
        return $this->redirectToRoute('app_profile');
    }
}
