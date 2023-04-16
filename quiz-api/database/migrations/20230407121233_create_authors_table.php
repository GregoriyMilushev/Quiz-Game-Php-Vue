<?php

require_once('Migration.php');

class CreateAuthorsTable extends Migration {
    public function up() {
      $sql = "CREATE TABLE $this->table (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        author VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )";
      $this->execute($sql);
    }
  
    public function down() {
      $this->dropTable();
    }
  }