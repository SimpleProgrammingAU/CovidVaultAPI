<?php
class Checklist implements Iterator {
  /**
   * @var string[]
   */
  private $_list;
  /**
   * @var boolean
   */
  private $_selectAll;
  
  public function __construct()
  {
    $this->_list = [];
    $this->_selectAll = false;
  }

  public function addStatement(string $statement) {
    $this->_list[] = $statement;
  }

  public function canSelectAll():bool {
    return $this->_selectAll;
  }

  public function selectAll(bool $val) {
    $this->_selectAll = $val;
  }

  public function count():int {
    return sizeof($this->_list);
  }

  public function toArray():array {
    return $this->_list;
  }

  public function current()
  {
    return current($this->_list);
  }

  public function key()
  {
    return key($this->_list);
  }

  public function valid()
  {
    $key = key($this->_list);
    return ($key !== NULL && $key !== FALSE);
  }

  public function next()
  {
    return next($this->_list);
  }

  public function rewind()
  {
    reset($this->_list);
  }
}