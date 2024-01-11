<?php

// src/Controller/ProductsController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductsRepository;


class ProductsController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(ProductsRepository $productsRepository): Response
    {
        $user = $this->getUser();

        // Assurez-vous que l'utilisateur est connecté
        if (!$user) {
            // Rediriger vers la page de connexion si non connecté
            return $this->redirectToRoute('app_login');
        }

        // Récupérez les produits associés à l'utilisateur
        $products = $user->getProducts();

        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }
}
