<?php

require_once '../model/Location.php';
require_once '../model/Visitor.php';

class Extract {

  const MODE_DATE = 20011;
  const MODE_PHONE = 20012;

  /**
   * @var Location
   */
  public $location;

  /**
   * @var int
   */
  private $mode;

  /**
   * @var DateTime
   */
  private $date;

  /**
   * @var Visit[]
   */
  private $data_table;

  function __construct() {
    $this->location = new Location();
    $this->data_table = [];
  }

  public function getMode() {
    return $this->mode;
  }

  public function detectMode(string $data):bool {
    if (strlen($data) === 12) {
      $this->mode = self::MODE_PHONE;
      return true;
    }
    try {
      $date = new DateTime($data);
    } catch (Exception $e) {
      return false;
    }
    $this->mode = self::MODE_DATE;
    $this->date = $date;
    return true;
  }

  public function getDate() {
    if (isset($this->date) && self::MODE_DATE) return $this->date->format("Y-m-d");
    else return false;
  }

  public function addRow(string $name, string $phone, string $arr, string $dep):bool {
    $visitor = new Visitor();
    array_push($this->data_table, new Visit($name, $phone, $arr, $dep));
    return true;
  }

  public function export() {
    $str_out = "Name,Phone,Check-in,Check-out" . PHP_EOL;
    foreach ($this->data_table as $value) {
      $str_out .= "{$value->name},{$value->phone},{$value->arr},{$value->dep}" . PHP_EOL;
    }
    return base64_encode($str_out);
  }

}

class Visit {
  /**
   * @var string
   */
  public $name;
  /**
   * @var string
   */
  public $phone;
  /**
   * @var string
   */
  public $arr;
  /**
   * @var string
   */
  public $dep;

  public function __construct(string $name, string $phone, string $arr, string $dep) {
    $this->name = $name;
    $this->phone = $phone;
    $this->arr = $arr;
    $this->dep = $dep;
  }
}

