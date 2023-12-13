// src/Controller/PostController.php
namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
/**
* @Route("/posts", name="get_posts", methods={"GET"})
*/
public function getPosts(EntityManagerInterface $entityManager): JsonResponse
{
$postRepository = $entityManager->getRepository(Post::class);
$posts = $postRepository->findAll();

$data = [];
foreach ($posts as $post) {
$data[] = [
'id' => $post->getId(),
'title' => $post->getTitle(),
'body' => $post->getBody(),
'authorName' => $post->getAuthorName(),
];
}

return new JsonResponse($data);
}
}
