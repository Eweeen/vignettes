<?php

namespace App\Controller;

use App\Repository\MediasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MediasRepository $mediasRepository): Response
    {
        $medias = $mediasRepository->findBy(array('is_active' => true), array('id' => 'DESC'));

        return $this->render('home/index.html.twig', [
            'user' => $this->getUser(),
            'medias' => $medias,
        ]);
    }
}
