<?php


namespace App\Controller\Api;


use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class BooksController extends AbstractFOSRestController
{

    /**
     * @Rest\Get(path="/books")
     * @Rest\View(serializerGroups={"book"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(BookRepository $repository)
    {
        return $repository->findAll();
    }

    /**
     * @Rest\Post(path="/books")
     * @Rest\View(serializerGroups={"book"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(EntityManagerInterface $manager)
    {
       $book = new Book();
       $book->setTitle('La quinta estación');
       $manager->persist($book);
       $manager->flush();
       return $book;
    }
}