<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Product;
use AppBundle\Form\ProductForm;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Services\MailerService;

class AdminController extends Controller {

  /**
   * @Route("/admin/add/product", name="admin_add_product") 
   */
  public function addProductAction(Request $request, MailerService $mailerService) : Response {
    $product = new Product();
    
    $form = $this->createForm(ProductForm::class, $product);
    $form->handleRequest($request);
    
    if (($isSubmitted = $form->isSubmitted()) && ($isValid = $form->isValid())) {
      $this->getDoctrine()->getManager()->persist($product);
      $this->getDoctrine()->getManager()->flush();
      $mailerService->sendMail('its working');
      $this->addFlash('success', 'Saved!');
    }

    return $this->render('@App/admin/add_product.html.twig', array(
                'form' => $form->createView()
    ));
  }

}
