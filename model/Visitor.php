<?php

require_once './Config.php';

class Visitor {
  private int $_id;
  private Location $_location;
  private string $_name;
  private string $_phone_number;
  private DateTime $_arrival;
  private DateTime $_departure;

  public function getID():int { return $this->_id; }
  public function location():Location { return $this->_location; }
  public function getName():string { return $this->_name; }
  public function getPhoneNumber():string { return $this->_phone_number; }
  public function getArrival():string { return $this->_arrival->format("d/m/Y H:i"); }
  public function getDeparture():string { 
    if (!is_null($this->_departure)) return $this->_departure->format("d/m/Y H:i");
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
    if (is_null($pn) || !Config::ValidatePhoneNumber($pn)) throw new APIException("Phone number must not be null and must be a string in the format +61xxxxxxxxx.");
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