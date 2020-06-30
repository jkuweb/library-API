<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    /**
     * @Route("/books", name="library_list")
     */
    public function list()
    {
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => 1,
                    'title' => 'title01'
                ],
                [
                    'id' => 2,
                    'title' => 'title02'
                ]
            ]
        ]);
        return $response;
    }

    /**
     * @Route("/book/create", name="book_create", methods={"GET","HEAD"})
     */
    public function createBook(Request $request, EntityManagerInterface $em)
    {
        $book = new Book();
        $title = $request->get('title');
        $book->setTitle($title);
        $em->persist($book);
        $em->flush();
        $response = new JsonResponse();
        return $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => $book->getId(),
                    'title' => $book->getTitle()
                ]
            ]
        ]); 
    }


}