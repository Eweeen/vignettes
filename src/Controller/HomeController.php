<?php

namespace App\Controller;

use App\Repository\MediasRepository;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function index(Request $request, MediasRepository $mediasRepository, CategoriesRepository $categoriesRepository): Response
  {
    if ($request->isMethod('post') && intval($request->get('category_filter'), 10) !== 0) {
      $mediaSelected = $request->get('category_filter');
      $medias = $mediasRepository->findBy(
        array(
          'category' => $request->get('category_filter'),
          'is_active' => true
        ),
        array('id' => 'DESC')
      );
    } else {
      $mediaSelected = 0;
      $medias = $mediasRepository->findBy(
        array('is_active' => true),
        array('id' => 'DESC')
      );
    }

    $categories = $categoriesRepository->findAll();

    return $this->render('home/index.html.twig', [
      'user' => $this->getUser(),
      'medias' => $medias,
      'mediaSelected' => $mediaSelected,
      'categories' => $categories,
    ]);
  }

  #[Route('/posts/{id}', name: 'app_posts')]
  public function userPost($id, Request $request, MediasRepository $mediasRepository, CategoriesRepository $categoriesRepository): Response
  {
    if ($request->isMethod('post') && intval($request->get('category_filter'), 10) !== 0) {
      $mediaSelected = $request->get('category_filter');
      $medias = $mediasRepository->findBy(
        array(
          'user' => $id,
          'category' => $request->get('category_filter'),
          'is_active' => true
        ),
        array('id' => 'DESC'),
      );
    } else {
      $mediaSelected = 0;
      $medias = $mediasRepository->findBy(
        array(
          'user' => $id,
          'is_active' => true
        ),
        array('id' => 'DESC'),
      );
    }

    $categories = $categoriesRepository->findAll();

    return $this->render('home/index.html.twig', [
      'user' => $this->getUser(),
      'medias' => $medias,
      'mediaSelected' => $mediaSelected,
      'categories' => $categories,
    ]);
  }
}
