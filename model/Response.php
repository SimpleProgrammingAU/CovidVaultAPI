<?php

class ResponseException extends Error {}

class Response {
    /**
     * The HTTP status code of the API response.
     * @var int 
     */
    private int $_httpStatusCode;

    /**
     * A flag to inform the recipient of the success status of the API query.
     * @var bool `true` if the API query was successful, `false` upon failure.
     */
    private bool $_success;
    
    /**
     * An array of messages sent to the client upon completion of the API query.
     * @var string[]
     */
    private array $_messages = [];
    
    /**
     * A data object, typically an associative array, containing the query results.
     * @var mixed
     */
    private $_data;

    /**
     * Determines whether cached results can be returned to the client.
     * @var boolean `true` if use of the cache is permitted, `false` otherwise.
     */
    private bool $_toCache = false;

    /**
     * The associative array that contains the HTTP status code, success flag, messages, and data to be issued to the client upon completion of the query.
     * @var array
     */
    private array $_responseData = [];

    /**
     * Sets the HTTP status code to be returned to the client.
     * All official status codes defined within the {@link https://en.wikipedia.org/wiki/List_of_HTTP_status_codes Wikipedia} page are accepted.
     * @param integer $code
     * 
     * @return bool Returns `true` upon success.
     * @throws ResponseException
     */
    public function setHttpStatusCode(int $code):bool {
        if (is_null($code) || !is_int($code)) throw new ResponseException("Status code must be an integer.");
        if (preg_match('/10[0-3]|20[0-8]|22[6-7]|30[0-8]|40\d|41[0-8]|42[1-6|8-9]|451|50[0-8]|51[0-1]/', strval($code)) === 1) $this->_httpStatusCode = $code;
        else throw new ResponseException("Invalid HTTP status code entered.");
        return true;
    }

    /**
     * Sets the success flag returned to the client.
     * @param bool $success
     * 
     * @return bool Returns `true` upon success.
     * @throws ResponseException
     */
    public function setSuccess(bool $success):bool {
        if (!is_bool($success)) throw new ResponseException("Success value must be either true or false.");
        $this->_success = $success;
        return true;
    }

    /**
     * Adds a message to the message array to be returned to the client.
     * @param string $message
     * 
     * @return bool Returns `true` upon success.
     */
    public function addMessage(string $message):bool {
        $this->_messages[] = strval($message);
        return true;
    }

    /**
     * Sets the data to be returned to the user.
     * This data must be able to be converted to JSON format.
     * @param mixed $data
     * 
     * @return bool Returns `true` on success.
     * @throws ResponseException
     */
    public function setData($data):bool {
        if (!json_encode($data)) throw new ResponseException("Data must be convertable to JSON format.");
        $this->_data = $data;
        return true;
    }

    /**
     * Sets the flag that permits use of the query cache when constructing the client response.
     * @param bool $toCache
     * 
     * @return bool Returns `true` on success.
     */
    public function toCache(bool $toCache):bool {
        if (!is_bool($toCache)) throw new ResponseException("Cache flag must be either true or false.");
        $this->_toCache = $toCache;
        return true;
    }

    /**
     * Sends the response by echoing the JSON encoded string back to the client.
     * @return void
     * @throws ResponseException
     */
    public function send():void {
        header('Content-type: application/json;charset=utf-8');
        if ($this->_toCache) header('Cache-control: max-age=60');
        else                 header('Cache-control: max-age=0');

        if (!is_bool($this->_success) || !is_numeric($this->_httpStatusCode)) {
            http_response_code(500);
            $this->_responseData["statusCode"] = 500;
            $this->_responseData["success"] = false;
            $this->addMessage("Response creation error.");
            $this->_responseData['messages'] = $this->_messages;
        } else {
            http_response_code($this->_httpStatusCode);
            $this->_responseData["statusCode"] = $this->_httpStatusCode;
            $this->_responseData["success"] = $this->_success;
            $this->_responseData["messages"] = $this->_messages;
            $this->_responseData["data"] = $this->_data;
        }
        if (!$json_out = json_encode($this->_responseData)) throw new ResponseException("Could not enocode response in JSON format.");
        echo $json_out;
    }
}

?>