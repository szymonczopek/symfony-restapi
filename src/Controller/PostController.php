<?php
namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PostController extends AbstractController
{
    #[Route('/lista', name: 'lista')]
    #[IsGranted("ROLE_USER")]
    public function getPosts(EntityManagerInterface $entityManager)
    {
        return $this->render('post/index.html.twig');
    }
}
