<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Products;
use App\Entity\Customers;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductsRepository $productsRepository): Response
    {
        $products = $productsRepository->findAll();

        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/save-product/{productId}', name: 'save_product_to_customer', methods: ['POST'])]
    public function saveProductToCustomer(Request $request, EntityManagerInterface $entityManager, Products $product): Response
    {
        $user = $this->getUser(); 
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->redirectToRoute('app_home');
    }
}