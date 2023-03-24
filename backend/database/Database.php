<?php

namespace Management;

use PDO;

class Database
{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->createConnection();
    }
    function createConnection() : PDO {
        $dsn = "mysql:host=eu-central.connect.psdb.cloud;dbname=phoenixprivat";
        $options = array(
            PDO::MYSQL_ATTR_SSL_CA => "./backend/certificate/cacert-2023-01-10.pem",
        );
        return new PDO($dsn, "5rbw28rqb72m150skcsa", "pscale_pw_qDJETcrqDDSJvpMFCeAljP9lGzTpcjysFE88knj2oJS", $options);
    }

    /**
     * @return PDO
     */
    public function getPDO() : PDO
    {
        return $this->pdo;
    }
}