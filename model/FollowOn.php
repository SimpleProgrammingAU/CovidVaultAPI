<?php

require_once '../model/Config.php';

class FollowOn
{

  /**
   * @var int
   */
  private $_id;
  /**
   * @var int
   */
  private $_type;
  /**
   * @var string
   */
  private $_text;
  /**
   * @var string
   */
  private $_url;
  /**
   * @var DateTime
   */
  private $_start;
  /**
   * @var DateTime
   */
  private $_expiry;

  const
  DEFAULT = 10001;

  public function __construct()
  {
    $this->_id = -1;
    $this->_type = self::DEFAULT;
    $this->_text = $this->_url = "";
    $this->_start = new DateTime();
    $this->_expiry = new DateTime("2030-12-31 23:59:59");
  }

  public function getID(): int
  {
    return $this->_id;
  }
  public function getType(): int
  {
    return $this->_type;
  }
  public function getText(): string
  {
    return $this->_text;
  }
  public function getURL(): string
  {
    return $this->_url;
  }
  public function getStart()
  {
    if (isset($this->_start)) return $this->_start->format("Y-m-d");
    else return null;
  }
  public function getExpiry()
  {
    if (isset($this->_expiry)) return $this->_expiry->format("Y-m-d");
    else return null;
  }

  public function setID(int $id): bool
  {
    if (is_null($id) || !is_int($id)) throw new APIException("ID must not be null and must be an integer value.");
    $this->_id = $id;
    return true;
  }

  public function setType(int $type): bool
  {
    if (is_null($type) || !is_int($type)) throw new APIException("Type must not be null and must be an integer value.");
    $this->_type = $type;
    return true;
  }

  public function setText(string $text): bool
  {
    if (!is_null($text) && !is_string($text)) throw new APIException("Follow-on link text must be a string.");
    $this->_text = $text;
    return true;
  }

  public function setURL(string $url): bool
  {
    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
      $this->_url = $url;
      return true;
    } else return false;
  }

  public function setStart(string $date): bool
  {
    if (strlen($date) === 0) return false;
    $datetime = date_create($date);
    if ($datetime === false) throw new APIException("Date format not recognised.");
    $this->_start = $datetime;
    return true;
  }

  public function setExpiry(string $date): bool
  {
    if (strlen($date) === 0) return false;
    $datetime = date_create($date);
    if ($datetime === false) throw new APIException("Date format not recognised.");
    $this->_expiry = $datetime;
    return true;
  }
}
