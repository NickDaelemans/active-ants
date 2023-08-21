<?php

namespace Afosto\ActiveAnts;

class ReturnLabel extends Model {

  /**
   * The key used to lookup the model at ActiveAnts
   */
  protected $primaryKey = 'shippingId';

  protected $findAction = 'get';

  protected $v2 = TRUE;

  public $data;

  public $mimeType;

  public $fileName;

  public $shippingMethodId;

  public $packageNumber;

  public $isPaperlessReturnShippingMethod;

  public $findMethod = 'GET';

  /**
   * Find by the primary key
   *
   * @param string $pk
   *
   * @return array
   */
  public function findByPk($pk) {
    $response = App::getInstance()->client->request($this->_getPath() . '/' . $this->findAction . '/' . $pk, [], $this->findMethod);
    $result = $response->result;
    $result = (array) $result;
    $name = get_called_class();
    $object = new $name;
    foreach ($result as $key => $value) {
      //Fix the fact that for shipment data (only use case) properties
      //are camelcase (as expected) but for all the other models aren't
      $key = strtoupper(substr($key, 0, 1)) . substr($key, 1);
      $object->$key = $value;
    }
    return $object;

  }

}
