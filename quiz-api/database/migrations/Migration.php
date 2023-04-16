<?php

abstract class Migration {
    protected $pdo;
    protected $table;
  
    public function __construct(PDO $pdo, $table) {
      $this->pdo = $pdo;
      $this->table = $table;
    }
  
    abstract public function up();
    abstract public function down();
  
    protected function execute($sql) {
      try {
        $this->pdo->exec($sql);
        echo "Migration executed successfully\n";
      } catch(PDOException $e) {
        echo "Error executing migration: " . $e->getMessage() . "\n";
      }
    }
  
    protected function dropTable() {
      $sql = "DROP TABLE IF EXISTS " . $this->table;
      $this->execute($sql);
    }
}