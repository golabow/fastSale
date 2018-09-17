<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\AbstractType;

class VueResponseService {

  public static function getResponse(array $actions = array()): JsonResponse {
    return new JsonResponse(array(
        'status' => true,
        'actions' => $actions
    ));
  }

  public static $notificationSuccessType = 'success';
  public static $notificationErrorType = 'error';
  
  public static function notification(string $type, string $message): array {
    return array(
        'action' => 'notification',
        'config' => array(
            'type' => $type,
            'message' => $message,
        )
    );
  }

  public static function notificationSuccess(string $message) : array {
    return self::notification(self::$notificationSuccessType, $message);
  }

  public static function notificationError(string $message) : array {
    return self::notification(self::$notificationErrorType, $message);
  }

  public static function refreshPage(int $sleep = 1) : array {
    return array(
        'action' => 'refreshPage',
        'config' => array(
            'sleep' => $sleep
        )
    );
  }

  public static function redirect(string $url, int $sleep = 3) : array {
    return array(
        'action' => 'redirect',
        'config' => array(
            'url' => $url,
            'sleep' => $sleep
        )
    );
  }

  public static function updateVariable(string $variableName, string $variableVal, bool $extend = false, bool $decodeJson = false) : array {
    $action = 'updateVariable';
    if ($extend) {
      $action = 'extendVariable';
    }
    if ($decodeJson) {
      $action = 'updateVariableDecodeJson';
    }
    return array(
        'action' => $action,
        'config' => array(
            'variableName' => $variableName,
            'variableVal' => $variableVal
        ),
    );
  }

}
