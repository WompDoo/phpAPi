<?php
/**
 * Connect MySQL with PDO class
 */
class db {
  
  private $dbhost = 'exampleapp-db';
  private $dbuser = 'exampleapp-db';
  private $dbpass = 'exampleapp-pw';
  private $dbname = 'exampleapp-db';

  public function connect() {

    // https://www.php.net/manual/en/pdo.connections.php
    $prepare_conn_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
    $dbConn = new PDO( $prepare_conn_str, $this->dbuser, $this->dbpass );

    // https://www.php.net/manual/en/pdo.setattribute.php
    $dbConn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // return the database connection back
    return $dbConn;
  }
}