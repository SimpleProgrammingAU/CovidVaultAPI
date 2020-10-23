<?php

require_once("Config.php");

class Activator {
  private const STRLEN = 64;
  /**
   * @var int 
   */
  private $_id;
  /**
   * @var int 
   */
  private $_account_id;
  /**
   * @var string 
   */
  private $_activator;

  function __construct() 
  {
    $this->_id = $this->_account_id = 0;
    $this->_activator = "";
  }

  public function getID():int { return $this->_id; }
  public function getAccountID():int { return $this->_account_id; }
  public function getActivator():string { return $this->_activator; }

  public function setID(int $id):bool {
    if (is_null($id) || !is_int($id) || $id < 0) throw new APIException("ID must not be null and must be a valid positive integer.");
    $this->_id = $id;
    return true;
  }

  public function setAccountID(int $id):bool {
    if (is_null($id) || !is_int($id) || $id < 0) throw new APIException("ID must not be null and must be a valid positive integer.");
    $this->_account_id = $id;
    return true;
  }

  public function setActivator(string $activator):bool {
    if (is_null($activator) || !is_string($activator)) throw new APIException("Activator must not be null and must be a valid string.");
    if (strlen($activator) !== self::STRLEN) throw new APIException("Activator must be a string of length " . self::STRLEN . ".");
    $this->_activator = $activator;
    return true;
  }

  public function generateActivator():bool {
    $this->_activator = bin2hex(random_bytes(self::STRLEN / 2));
    return true;
  }

  public function getBaseURL():string {
    return getenv("BASE_URL");
  }
}