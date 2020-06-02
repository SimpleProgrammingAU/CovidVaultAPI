<?php

require_once '../model/Config.php';

class Address {
  /**
   * @var string 
   */
  private $_street_address;
  /**
   * @var string 
   */
  private $_suburb;
  /**
   * @var string 
   */
  private $_state;
  /**
   * @var string 
   */
  private $_postcode;

  public function __toString():string {
    return "{$this->_street_address}\r\n{$this->_suburb} {$this->_state} {$this->_postcode}"; 
  }

  public function getStreetAddress():string { return $this->_street_address; }
  public function getSuburb():string { return $this->_suburb; }
  public function getState():string { return $this->_state; }
  public function getPostcode():string { return $this->_postcode; }

  public function setStreetAddress(string $addr):bool {
    if (is_null($addr) || !is_string($addr)) throw new APIException("Street address must not be null and must be a valid string no longer than 255 characters.");
    $this->_street_address = $addr;
    return true;
  }

  public function setSuburb(string $suburb):bool {
    if (is_null($suburb) || !is_string($suburb) || strlen($suburb) > 127 || strlen($suburb) == 0) throw new APIException("Suburb must not be null and must be a valid string no longer than 127 characters.");
    $this->_suburb = $suburb;
    return true;
  }

  public function setState(string $state):bool {
    if (is_null($state) || !is_string($state) || strlen($state) > 3 || strlen($state) < 2) throw new APIException("State must be a valid two or three character long string.");
    if (array_search(strtoupper($state), ["ACT", "QLD", "SA", "WA", "VIC", "NT", "TAS", "NSW"]) === false) throw new APIException("Invalid Australian state abbreviation entered.");
    $this->_state = strtoupper($state);
    return true;
  }

  /**
   * Sets and validates the postcode entered against the valid **street address** postcodes as defined on {@link https://en.wikipedia.org/wiki/Postcodes_in_Australia#Allocation Wikipedia}.
   * @param string $pc
   * 
   * @return bool Returns `true` upon success.
   */
  public function setPostCode(string $pc):bool {
    $ipc = intval($pc);
    if (is_null($pc) || $ipc === 0 || strlen($pc) !== 4) throw new APIException("Postcode must be four digits.");
    if (($ipc < 800 || $ipc > 899) && ($ipc < 2000 || $ipc > 5799) && ($ipc < 6000 || $ipc > 6797) && ($ipc < 7000 || $ipc > 7799)) throw new APIException("Postcode must be a valid for a street address.");
    $this->_postcode = $pc;
    return true;
  }
}