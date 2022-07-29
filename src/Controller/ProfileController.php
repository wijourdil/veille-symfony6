<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/', name: 'profiles.index')]
    public function index(UserRepository $repository): Response
    {
        $users = $repository->findAll();

        return $this->render('profiles/index.html.twig', [
            'profiles' => $users,
        ]);
    }

    #[Route('/u/{username}', name: 'profiles.show')]
    public function show(UserRepository $repository, string $username): Response
    {
        $user = $repository->findOneBy(['username' => $username]);

        if ($user === null) {
            throw $this->createNotFoundException();
        }

        return $this->render('profiles/show.html.twig', [
            'user' => $user,
        ]);
    }
}
