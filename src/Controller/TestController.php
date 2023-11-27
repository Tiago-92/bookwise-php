<?php

namespace App\Controller; 

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
  /**
   * @Route("/test", name="test")
   */
  public function index() : JsonResponse
  {
    $data = ['message' => 'Página de Teste React'];
    return $this->json($data);
  }
}