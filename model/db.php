<?php

//TODO - Update with different connections between read / write.
class DB {

    private static $writeDBConnection;
    private static $readDBConnection;

    public static function connectWriteDB() {
        if (is_null(self::$writeDBConnection)) {
            self::$writeDBConnection = new PDO('mysql:host=localhost;dbname=simplepr_covid;charset=utf8', getenv("DB_USERNAME"), getenv("DB_PASSWORD"));
            self::$writeDBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$writeDBConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return self::$writeDBConnection;
    }

    public static function connectReadDB() {
        if (is_null(self::$readDBConnection)) {
            self::$readDBConnection = new PDO('mysql:host=localhost;dbname=simplepr_covid;charset=utf8', getenv("DB_USERNAME"), getenv("DB_PASSWORD"));
            self::$readDBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$readDBConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return self::$readDBConnection;
    }
}

?>