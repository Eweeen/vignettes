<?php

namespace App\Controller;

use App\Entity\Medias;
use App\Entity\Categories;
use App\Repository\MediasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MediasController extends AbstractController
{
    #[Route('/add/media', name: 'add_media')]
    public function addMedia(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $media = new Medias();

        $image = $request->files->get('media');
        
        $fichier = uniqid() . '.' . $image->guessExtension();

        $media->setTitle($request->get('title'));
        $media->setDescription($request->get('description'));
        $media->setPath($fichier);

        $media->setUser($this->getUser());

        $categories = $entityManager->getRepository(Categories::class, 'categories')->find($request->get('categories'));
        $media->setCategory($categories);
        $image->move('img/uploads/', $fichier);

        $entityManager->persist($media);
        $entityManager->flush();

        return $this->redirectToRoute('app_profile');
    }

    #[Route('/update/media/{id}', name: 'update_media')]
    public function updateMedia($id, Request $request, EntityManagerInterface $entityManager, MediasRepository $mediasRepository): Response
    {
        $media = $mediasRepository->find($id);

        if(!$media) return $this->redirectToRoute('app_home');

        $isActive = $request->get('is_active') ? true : false;

        $media->setWidth($request->get('width'));
        $media->setHeight($request->get('height'));
        $media->setIsActive($isActive);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}
