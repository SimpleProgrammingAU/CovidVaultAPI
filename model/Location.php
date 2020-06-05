<?php

require_once '../model/Config.php';
require_once '../model/Address.php';

class Location {
  /**
   * @var int 
   */
  private $_id;
  /**
   * @var string 
   */
  private $_name;
  /**
   * @var string 
   */
  private $_auth_contact;
  /**
   * @var string 
   */
  private $_avatar;
  /**
   * @var string 
   */
  private $_phone_number;
  /**
   * @var string 
   */
  private $_email;
  /**
   * @var Address 
   */
  private $_address;
  /**
   * @var string 
   */
  private $_abn;

  public function __construct() {
    $this->_id = $this->_name = $this->_auth_contact = $this->_avatar = $this->_phone_number = $this->_email = $this->_abn = null;
    $this->_address = new Address();
  }

  public function getID():int { return $this->_id; }
  public function getName():string { return $this->_name; }
  public function getAuthorisedContact():string { return $this->_auth_contact; }
  public function getAvatar():string { return strval($this->_avatar); }
  public function getPhoneNumber():string { return $this->_phone_number; }
  public function getEmailAddress():string { return $this->_email; }
  public function address():Address { return $this->_address; }
  public function getABN():string { return strval($this->_abn); }

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

  public function setAuthContact(string $name):bool {
    if (is_null($name) || strlen($name) < 1 || strlen($name) > 127) throw new APIException("Authorised contact name must be a valid string not longer than 127 characters.");
    $this->_auth_contact = $name;
    return true;
  }

  public function setAvatar(string $file):bool {
    if (!is_string($file) || $file !== '' && preg_match('/^(?:(?<scheme>[^:\/?#]+):)?(?:\/\/(?<authority>[^\/?#]*))?(?<path>[^?#]*\/)?(?<file>[^?#]*\.(?<extension>[Jj][Pp][Ee]?[Gg]|[Pp][Nn][Gg]|[Gg][Ii][Ff]))(?:\?(?<query>[^#]*))?(?:#(?<fragment>.*))?$/', $file) !== 1) throw new APIException("Avatar filename should point to a valid image file."); 
    $this->_avatar = $file;
    return true;
  }

  public function setPhoneNumber(string $pn):bool {
    if (is_null($pn) || !Config::ValidatePhoneNumber($pn)) throw new APIException("Phone number must not be null and must be a string in the format +61xxxxxxxxx.");
    $this->_phone_number = $pn;
    return true;
  }

  public function setEmailAddress(string $email):bool {
    if (!is_null($email) && preg_match('/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/', $email) !== 1) throw new APIException("Email address is not in a recognised format.");
    $this->_email = $email;
    return true;
  }

  /**
   * Sets the ABN of the business location validated by the ruleset outlined on the {@link https://abr.business.gov.au/Help/AbnFormat ABR} website.
   * @param string $abn
   * 
   * @return bool
   */
  public function setABN(string $abn):bool {
    if (!is_null($abn)) {
      $cumsum = 0;
      $abn_arr = str_split($abn);
      foreach ($abn_arr as $i => $digit) {
        $cumsum += ($i === 0) ? (intval($digit) - 1) * 10 : (2 * $i - 1) * $digit;
      }
      if (strlen($abn) !== 11 || $cumsum % 89 !== 0) throw new APIException("ABN entered is invalid.");
    }
    $this->_abn = $abn;
    return true;
  }
}