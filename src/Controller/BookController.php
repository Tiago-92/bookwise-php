<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    $book->setName($request->get('name'));
    $book->setSummary($request->get('summary'));
    $book->setTotalPages($request->get('totalPages'));

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

    /**
     * @Route("/book/{id}", name="book", methods={"GET"})
     */
    public function findyBookById($id, EntityManagerInterface $em): JsonResponse
    {
        $book = $em->getRepository(Book::class)->find($id);

        if (!$book) {
            return new JsonResponse(['message' => 'Livro não encontrado.'], 404);
        }

        $bookInfo = [
            'id' => $book->getId(),
            'name' => $book->getName(),
            'author' => $book->getAuthor(),
            'category' => $book->getCategory()->getName(),
            'summary' => $book->getSummary(),
            'totalPages' => $book->getTotalPages(),
            'coverUrl' => $book->getCoverUrl(),
        ];

        return new JsonResponse($bookInfo, 200);
    }

    /**
     * @Route("/books/", name="books", methods={"GET"})
     */
    public function findAllBooks(EntityManagerInterface $em): JsonResponse
    {
        $books = $em->getRepository(Book::class)->findAll();

        if (empty($books)) {
            return new JsonResponse(['message' => 'Nenhum livro encontrado.'], 404);
        }

        $booksInfo = [];
        foreach ($books as $book) {
            $bookInfo = [
                'id' => $book->getId(),
                'name' => $book->getName(),
                'author' => $book->getAuthor(),
                'category' => $book->getCategory()->getName(),
                'summary' => $book->getSummary(),
                'totalPages' => $book->getTotalPages(),
                'coverUrl' => $book->getCoverUrl(),
            ];
            $booksInfo[] = $bookInfo;
        }

    return new JsonResponse($booksInfo, 200);

    }

    /**
     * @Route("/book-covers/{coverUrl}", name="book_cover")
     */
    public function getBookCover($coverUrl)
    {
        $coverPath = $this->getParameter('covers_directory') . '/' . $coverUrl;

        // Verifica se o arquivo da capa existe
        if (!file_exists($coverPath)) {
            throw $this->createNotFoundException('A capa do livro não foi encontrada.');
        }

        $coverFile = new File($coverPath);

        // Retorna a imagem como uma resposta HTTP
        $response = new Response(file_get_contents($coverFile->getPathname()));
        $response->headers->set('Content-Type', $coverFile->getMimeType());

        return $response;
    }
}