<?php

namespace Drupal\rest_system\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Provides a Page Json Resource
 *
 * @RestResource(
 *   id = "page_json_resource",
 *   label = @Translation("Page Json Resource"),
 *   uri_paths = {
 *     "canonical" = "/page_json/{apikey}/{nid}"
 *   }
 * )
 */
class PageJson extends ResourceBase {

  /**
   * Responds to entity GET requests.
   * @return \Drupal\rest\ResourceResponse
   */
  public function get($apikey, $nid) {
    $config_factory = \Drupal::configFactory();
    $config = $config_factory->get('system.site');
    $nid = $nid ?? "";
   if($config->get('siteapikey') != $apikey && empty($nid)){
        $response = ['message' => "access denied"];
        return new ResourceResponse($response);
    }
    elseif (!$nid) {
        throw new BadRequestHttpException("page id not available.");
      }
    elseif($config->get('siteapikey') != $apikey){
        throw new BadRequestHttpException("Invalid Api key??");
    }else{
    try{
        $node_storage = \Drupal::entityTypeManager()->getStorage('node');
        $node = $node_storage->load($nid);
        if(!is_null($node)){
            $response = ['node' => $node->toArray()];
        }else{
            $response = ['message' => "access denied"];
        }
        return new ResourceResponse($response);
    }
    catch (RequestException $exception) {
        $response = ['message' => $exception->getMessage()];
        return new ResourceResponse($response);
      }
    }

  }

}