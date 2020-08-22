<?php

require_once '../model/Location.php';

class Statistics
{
  const DAY = 10001;
  const HOUR = 10002;
  /**
   * @var Location 
   */
  private $_location;
  /**
   * @var int[] 
   */
  private $_byDay;
  /**
   * @var int[] 
   */
  private $_byHour;
  /**
   * @var float 
   */
  private $_pReturn;
  /**
   * @var int 
   */
  private $_nToday;

  public function __construct()
  {
    $this->_location = new Location();
    $this->_byDay = array_fill(0, 7, 0);
    $this->_byHour = array_fill(0, 24, 0);
    $this->_nToday = 0;
    $this->_pReturn = 0;
  }

  public function location(): Location
  {
    return $this->_location;
  }
  public function getTimeStats(int $type): array
  {
    switch ($type) {
      case self::DAY:
        return $this->_byDay;
      case self::HOUR:
        return $this->_byHour;
    }
    throw new Error("Invalid time statistic entered.");
  }
  public function getReturnStats(): float
  {
    return $this->_pReturn;
  }
  public function getTodayCount(): int
  {
    return $this->_nToday;
  }

  public function importDay(array $data): bool
  {
    foreach ($data as $value) {
      $this->_byDay[$value["id"]] = intval($value['N']);
    }
    return true;
  }

  public function importHour(array $data): bool
  {
    foreach ($data as $value) {
      $this->_byHour[$value["id"]] = intval($value['N']);
    }
    return true;
  }

  public function setReturn(float $return): bool
  {
    $this->_pReturn = round($return * 100, 0);
    return true;
  }
  public function setToday(int $today): bool
  {
    $this->_nToday = intval($today);
    return true;
  }
}
