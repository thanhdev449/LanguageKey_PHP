<?php
// $host = "localhost";
// $db_name = "sumikae_2020_07_01";
// $db_username = "root";
// $db_password = "vina5aver";
class DB
{
    private static $instance = NULl;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          self::$instance = new PDO('mysql:host=192.168.1.5;port=8282;dbname=sumikae', 'root', 'root');
          self::$instance->exec("SET NAMES 'utf8'");
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
      return self::$instance;
    }
}
?>