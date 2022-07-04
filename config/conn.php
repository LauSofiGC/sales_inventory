<?php

namespace config;

use PDO;

class conn {

    private $_engine;
    private $_server;
    private $_port;
    private $_dbname;
    private $_username;
    private $_password;
    private $_debug;
    protected $_conn;

    public function __construct() {
        $CONFIG = parse_ini_file(".env");
        $this->_engine = $CONFIG["DB_CONNECTION"];
        $this->_server = $CONFIG["DB_HOST"];
        $this->_port = $CONFIG["DB_PORT"];
        $this->_dbname = $CONFIG["DB_NAME"];
        $this->_username = $CONFIG["DB_USERNAME"];
        $this->_password = $CONFIG["DB_PASSWORD"];
        $this->_debug = $CONFIG["DB_DEBUG"];
        $this->connect();
    }

    public function connect() {
        switch ($this->_engine) {
            case "mysql":
                $encoding = "SET NAMES \"UTF8\"";
                $textString = "mysql::host={$this->_server};dbname={$this->_dbname}";
                $arr = [PDO::MYSQL_ATTR_INIT_COMMAND => $encoding];
                $this->_conn = new PDO($textString, $this->_username, $this->_password, $arr);
                $this->_conn->query("SET SESSION sql_mode=\"STRICT_TRANS_TABLES\"");
                $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                break;
        }
    }

}
?>