<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\VueResponseService;
use AppBundle\Services\ShoppingCartService;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class ShoppingCartController extends Controller {

  /**
   * @Route("/cart/summary", name="cart_summary")
   * @param ShoppingCartService $shoppingCartService
   * @return Response
   */
  public function shoppingCartSummaryAction(ShoppingCartService $shoppingCartService): Response {
    $products = $shoppingCartService->getProductsInCart();
    return $this->render('@App/shoppingCartSummary.html.twig', array(
                'products' => $products
    ));
  }

  /**
   * @Route("/cart/add/{id}", name="cart_add_product")
   * @return JsonResponse
   */
  public function addProductToCartAction(Product $product, ShoppingCartService $shoppingCartService, Request $request): JsonResponse {
    $shoppingCartService->addProductToCart($product);
    return VueResponseService::getResponse(array(
                VueResponseService::notificationSuccess(sprintf('Product %s has been added correctly to your shopping cart', $product->getName())),
                VueResponseService::updateVariable('items', $shoppingCartService->getProductsInCartsIdsJson(), $extend = false, $decodeJson = true),
    ));
  }

  /**
   * @Route("/cart/remove/{id}", name="cart_remove_product")
   * @return JsonResponse
   */
  public function removeProductFromCartAction(Product $product, ShoppingCartService $shoppingCartService, Request $request): JsonResponse {
    $shoppingCartService->removeProductFromCart($product);
    return VueResponseService::getResponse(array(
                VueResponseService::notificationSuccess(sprintf('Product %s has been removed correctly from your shopping cart, refreshing page in 1 sec..', $product->getName())),
                VueResponseService::updateVariable('items', $shoppingCartService->getProductsInCartsIdsJson(), $extend = false, $decodeJson = true),
                VueResponseService::refreshPage()
    ));
  }

}
