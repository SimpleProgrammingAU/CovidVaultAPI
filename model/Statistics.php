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
  private $_visitors_by_day;
  /**
   * @var int[] 
   */
  private $_visitors_by_hour;
  /**
   * @var mixed[] 
   */
  private $_api_calls_by_month;
  /**
   * @var float 
   */
  private $_p_return_visitors;
  /**
   * @var int 
   */
  private $_n_visitors_today;

  public function __construct()
  {
    $this->_location = new Location();
    $this->_visitors_by_day = array_fill(0, 7, 0);
    $this->_visitors_by_hour = array_fill(0, 24, 0);
    $this->_api_calls_by_month = [];
    $this->_n_visitors_today = 0;
    $this->_p_return_visitors = 0;
  }

  public function location(): Location
  {
    return $this->_location;
  }
  public function getTimeStats(int $type): array
  {
    switch ($type) {
      case self::DAY:
        return $this->_visitors_by_day;
      case self::HOUR:
        return $this->_visitors_by_hour;
    }
    throw new Error("Invalid time statistic entered.");
  }
  public function getAPIStats(): array
  {
    return $this->_api_calls_by_month;
  }
  public function getReturnStats(): float
  {
    return $this->_p_return_visitors;
  }
  public function getTodayCount(): int
  {
    return $this->_n_visitors_today;
  }

  public function importDay(array $data): bool
  {
    foreach ($data as $value) {
      $this->_visitors_by_day[$value["id"]] = intval($value['N']) / intval($value['F']);
    }
    return true;
  }

  public function importHour(array $data): bool
  {
    foreach ($data as $value) {
      $this->_visitors_by_hour[$value["id"]] = intval($value['N']);
    }
    return true;
  }

  public function importAPIStats(array $data): bool
  {
    $this->_api_calls_by_month = [];
    try {
      foreach ($data as $row) {
        $this->_api_calls_by_month[] = [
          "year" => intval($row["year"]),
          "month" => intval($row["month"]),
          "count" => intval($row["n"])
        ];
      }
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  public function setReturn(float $return): bool
  {
    $this->_p_return_visitors = round($return * 100, 0);
    return true;
  }
  public function setToday(int $today): bool
  {
    $this->_n_visitors_today = intval($today);
    return true;
  }
}
