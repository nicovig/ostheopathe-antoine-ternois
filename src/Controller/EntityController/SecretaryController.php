<?php

namespace App\Controller\EntityController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SecretaryController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorage){
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/manage-secretary-admin", name="secretary.edit.admin")
     * @return Response
     */
    public function editAdmin():Response{
        return $this->render('manage/secretary-admin.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/manage-secretary", name="secretary.edit")
     * @return Response
     */
    public function edit():Response{
        return $this->render('manage/secretary.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/view-secretary", name="secretary.show")
     * @return Response
     */
    public function show():Response{
        return $this->render('pages/secretary.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/view-secretary", name="secretary.show.admin")
     * @return Response
     */
    public function showAdmin():Response{
        return $this->render('pages/secretary-admin.html.twig', [
            'user' => $this->user
        ]);
    }
}
