<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
  /**
   * @Route("/category", name="category_index")
   */
  public function index(EntityManagerInterface $em) : Response
  {
    $category = new Category();
    $category->setName("Fantasia");
    $msg = "";

    try {
      $em->persist($category);
      $em->flush();
      $msg = "Categoria cadastrada com sucesso!";
    }
    catch(Exception $e){
      $msg = "Erro ao cadastrar a categoria.";
    }
    return new Response("<h1>" .$msg. "</h1>");
  }

}