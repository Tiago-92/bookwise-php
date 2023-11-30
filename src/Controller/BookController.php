<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
/**
 * @Route("/upload-image", name="upload-image", methods={"POST"})
 */
  public function bookController(Request $request, EntityManagerInterface $em, CategoryRepository $categoryRepository): JsonResponse
  {
   
    $category = $categoryRepository->find($request->get('category_id'));
    $book = new Book();

    $book->setAuthor($request->get('author'));
    $book->setCategory($category);
    /* $book->setCoverUrl($request->get('coverUrl')); */
    $book->setName($request->get('name'));
    $book->setSummary($request->get('summary'));
    $book->setTotalPages($request->get('totalPages'));;

    if ($request->files->has('coverUrl')) {
        $coverImage = $request->files->get('coverUrl');

        $imageName = uniqid() . '.' . $coverImage->getClientOriginalExtension();

        try {
            $coverImage->move(
                $this->getParameter('covers_directory'),
                $imageName
            );

            $book->setCoverUrl($imageName);
        } catch (FileException $e) {
            return new JsonResponse(['message' => 'Erro ao fazer upload da imagem da capa.'], 500);
        }
    }

    try {
        $em->persist($book);
        $em->flush();

        return new JsonResponse(['message' => 'Livro cadastrado com sucesso!'], 201);
    } catch (\Exception $e) {
        return new JsonResponse(['message' => 'Erro ao cadastrar o livro.'], 500);
    }
  }
}