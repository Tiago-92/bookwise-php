<?php

namespace App\Controller;

use Exception;
use App\Entity\Book;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
  /**
   * @Route("/books", name="create_book", methods={"POST"})
   */
  public function index(
    Request $request, 
    EntityManagerInterface $em, 
    CategoryRepository $categoryRepository) : JsonResponse
  {
    $request = json_decode($request->getContent(), true);

    $category = $categoryRepository->find($request['category_id']);
    $book = new Book();

    $book->setAuthor($request['author']);
    $book->setCategory($category);
    $book->setCoverUrl($request['coverUrl']);
    $book->setName($request['name']);
    $book->setSummary($request['summary']);
    $book->setTotalPages($request['totalPages']);

    $msg = "";

    try {
      $em->persist($book);
      $em->flush();
      $msg = "Livro cadastrado com sucesso!";

      return new JsonResponse(['message' => $msg], 201);
    }
    catch(Exception $e){
      $msg = "Erro ao cadastrar o livro.";

      return new JsonResponse(['message' => $msg], 500);
    }
  }
}