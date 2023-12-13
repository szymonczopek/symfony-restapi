<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;


class GetPostsCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setName('get-posts')
            ->setDescription('Import posts from JSONPlaceholder API and save to the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $httpClient = HttpClient::create();
        $postsData = $httpClient->request('GET', 'https://jsonplaceholder.typicode.com/posts')->toArray();

        foreach ($postsData as $postData) {
            $userId = $postData['userId'];
            $user = $httpClient->request('GET', 'https://jsonplaceholder.typicode.com/users/' . $userId)->toArray();
            $authorName = $user['name'];

            $post = new Post();
            $post->setTitle($postData['title']);
            $post->setBody($postData['body']);
            $post->setauthorName($authorName);

            $this->entityManager->persist($post);
        }

        $this->entityManager->flush();

        $output->writeln('Posts imported successfully.');

        return Command::SUCCESS;
    }
}
