<?php

namespace Drupal\rest_system\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
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
  public function get() {
      
    $response = ['message' => 'Hello, this is a rest service'];
    return new ResourceResponse($response);
  }

}