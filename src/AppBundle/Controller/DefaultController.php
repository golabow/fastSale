<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProductForm;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

  /**
   * @Route("/", name="home")
   */
  public function indexAction(Request $request, \AppBundle\Services\ShoppingCartService $scs) : Response {
    $paginator = $this->get('knp_paginator');
    return $this->render('@App/home.html.twig', array(
                'products' => $paginator->paginate(
                        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll(), 
                        $page = $request->query->getInt('page', 1), 
                        $per_page = 10
                )
    ));
  }
}
