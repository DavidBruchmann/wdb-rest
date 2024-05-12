<?php

declare(strict_types=1);

namespace WDB\WdbRest\Annotations;

use Nng\Nnrestapi\Api\AbstractApi;

/**
 * @Annotation
 */
class Page extends AbstractApi
{
   public $value;

//   /**
//    * Normalize parameter to array.
//    * Only needed, if you allow single AND multiple arguments in your annotation.
//    *
//    */
//   public function __construct( $arr )
//   {
//      $this->value = is_array( $arr['value'] ) ? $arr['value'] : [$arr['value']];
//   }

   /**
    * This method is called when parsing all classes.
    * You must implement it in your own Annotation, if you want the parsed
    * data to be cached and accessible later in your endpoint.
    *
    */
   public function mergeDataForEndpoint( &$data )
   {
      $data['myIdentifer'] = $this->value;
   }
}
