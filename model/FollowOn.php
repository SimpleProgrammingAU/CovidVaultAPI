<?php

require_once './Config.php';

class FollowOn {

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
  private $_img;
  /**
   * @var string
   */
  private $_url;
  /**
   * @var DateTime
   */
  private $_expiry;

  const DEFAULT = 10001;

  public function getID():int { return $this->_id; }
  public function getType():int { return $this->_type; }
  public function getText():string { return $this->_text; }
  public function getImg():string { return $this->_img; }
  public function getURL():string { return $this->_url; }
  public function getExpiry():string {
    if (isset($this->_expiry)) return $this->_expiry->format("Y-m-d H:i:s");
    else return "Does not expire";
  }
  
  public function setID(int $id):bool {
    if (is_null($id) || !is_int($id)) throw new APIException("ID must not be null and must be an integer value.");
    $this->_id = $id;
    return true;
  }

  public function setType(int $type):bool {
    if (is_null($type) || !is_int($type)) throw new APIException("Type must not be null and must be an integer value.");
    $this->_type = $type;
    return true;
  }

  public function setText(string $text):bool {
    if (!is_null($text) && !is_string($text)) throw new APIException("Follow-on link text must be a string.");
    $this->_text = $text;
    return true; 
  }

  public function setImg(string $file):bool {
    if (!is_string($file) || $file !== '' && preg_match('/^(?:(?<scheme>[^:\/?#]+):)?(?:\/\/(?<authority>[^\/?#]*))?(?<path>[^?#]*\/)?(?<file>[^?#]*\.(?<extension>[Jj][Pp][Ee]?[Gg]|[Pp][Nn][Gg]|[Gg][Ii][Ff]|[Ss][Vv][Gg]))(?:\?(?<query>[^#]*))?(?:#(?<fragment>.*))?$/', $file) !== 1) throw new APIException("Avatar filename should point to a valid image file."); 
    $this->_img = $file;
    return true;
  }

  public function setURL(string $url):bool {
    if (filter_var($url, FILTER_VALIDATE_URL) !== false) $this->_url = $url;
    else return false;
  }

  public function setExpiry(string $date):bool {
    $datetime = date_create($date);
    if ($datetime === false) throw new APIException("Date format not recognised.");
    $this->_expiry = $datetime;
    return true;
  }

}