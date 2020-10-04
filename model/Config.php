<?php

date_default_timezone_set("Australia/Melbourne");

class Config {
  /**
   * Validates the inputed phone number against the list of valid phone number prefixes listed in {@link https://en.wikipedia.org/wiki/Telephone_numbers_in_Australia Wikipedia}.
   * Note: mobile phone numbers are not validated beyond length and commencing with `+614`.
   * @param string $pn The input phone number to be tested.
   * 
   * @return bool Returns `true` if the phone number entered is a valid Australian number; false upon failure.
   */
  public static function ValidatePhoneNumber(string $pn):bool {
    if (strlen($pn) !== 12) return false; //Phone number length confirmed
    if (substr($pn, 0, 3) !== "+61") return false; //Australian telephone number confirmed
    $vb = intval(substr($pn, 4, 2)); //substring to be evaluated against valid number ranges
    if (substr($pn, 3, 1) === "2" && ($vb < 37 && $vb !== 33)) return false; //NSW/ACT Number confirmed
    if (substr($pn, 3, 1) === "3" && ($vb < 32 || $vb > 34) && ($vb < 40 || $vb > 67 && ($vb !== 46 || $vb !== 60 || $vb !== 66)) && $vb < 70) return false; //VIC/TAS Number confirmed
    if (substr($pn, 3, 1) === "7" && ($vb < 20 && $vb > 58 && ($vb !== 50 || $vb !== 51)) && $vb !== 70 && ($vb < 75 || $vb > 77) && $vb !== 79) return false; //QLD Number confirmed
    if (substr($pn, 3, 1) === "8" && ($vb < 25 || $vb > 26) && ($vb < 51 || $vb > 55) && $vb !== 58 && $vb < 60) return false; //SA/NT/WA Number confirmed
    return true; //Passed all validation
  }

  public static function RegisterAPIAccess(int $id, string $endpoint) {
    require_once("DB.php");
    $writeDB = DB::connectWriteDB();
    $ip = self::GetIPAddress();
    $query = $writeDB->prepare("INSERT INTO `actions`(`account_id`, `endpoint`, `ip_address`) VALUES (:id, :e, :ip)");
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':e', $endpoint, PDO::PARAM_STR);
    $query->bindParam(':ip', $ip, PDO::PARAM_STR);
    $query->execute();
  }

  public static function ShortnameGenerator(string $name) {
    $name_arr = [];
    preg_match_all('/[A-Z]/', $name, $matches);
    $name_arr[] = implode($matches[0]);
    preg_match_all('/[A-Z][^aeiou]?/', $name, $matches);
    $name_arr[] = implode($matches[0]);
    preg_match_all('/[A-Z]/', $name, $matches, PREG_PATTERN_ORDER, 2);
    $name_arr[] = substr($name, 0, 2) . implode($matches[0]);
    preg_match_all('/[A-Z][a-z]/', $name, $matches);
    $name_arr[] = implode($matches[0]);
    return $name_arr;
  }

  private static function GetIPAddress() {
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}
}

class APIException extends Error {}