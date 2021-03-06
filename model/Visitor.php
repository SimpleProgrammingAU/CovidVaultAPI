<?php

require_once '../model/Config.php';

class Visitor {
  /**
   * @var int 
   */
  private $_id;
  /**
   * @var Location 
   */
  private $_location;
  /**
   * @var string 
   */
  private $_name;
  /**
   * @var string 
   */
  private $_phone_number;
  /**
   * @var DateTime 
   */
  private $_arrival;
  /**
   * @var DateTime 
   */
  private $_departure;

  public function getID():int { return $this->_id; }
  public function location():Location { return $this->_location; }
  public function getName():string { return $this->_name; }
  public function getPhoneNumber():string { return $this->_phone_number; }
  public function getArrival():string { return $this->_arrival->format("Y-m-d H:i:s"); }
  public function getDeparture():string { 
    if (!is_null($this->_departure)) return $this->_departure->format("Y-m-d H:i:s");
    else return "";
  }

  public function setID(int $id):bool {
    if (is_null($id) || !is_int($id)) throw new APIException("ID must not be null and must be an integer value.");
    $this->_id = $id;
    return true;
  }

  public function setName(string $name):bool {
    if (is_null($name) || !is_string($name)) throw new APIException("Name must not be null and must be a string.");
    $this->_name = $name;
    return true; 
  }

  public function setPhoneNumber(string $pn):bool {
    if (is_null($pn) || !Config::ValidatePhoneNumber($pn)) throw new APIException("Phone number must not be null and must be a string in the format +61xxxxxxxxx. For example, if your telephone number is 0412-123-987 you would enter +61412123987.");
    $this->_phone_number = $pn;
    return true;
  }

  public function setArrival(string $date):bool {
    $datetime = date_create($date);
    if ($datetime === false) throw new APIException("Date format not recognised.");
    $this->_arrival = $datetime;
    return true;
  }

  public function setDeparture(string $date):bool {
    $datetime = date_create($date);
    if ($datetime === false) throw new APIException("Date format not recognised.");
    $this->_departure = $datetime;
    return true;
  }
}