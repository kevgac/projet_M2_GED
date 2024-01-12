<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    #[Route('/generate-pdf/{productId}', name: 'generate_pdf')]
    public function generatePdf(int $productId, ProductsRepository $productsRepository, Pdf $knpSnappyPdf): Response
    {
        $product = $productsRepository->find($productId);
        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé.');
        }

        $fds = $product->getFds();

        $html = $this->renderView('pdf/index.html.twig', [
            'product' => $product,
            'fds' => $fds,
        ]);

        $pdfContent = $knpSnappyPdf->getOutputFromHtml($html);

        return new Response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="product-' . $product->getId() . '.pdf"'
        ]);
    }
}
