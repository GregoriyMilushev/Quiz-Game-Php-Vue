<?php

require_once('Migration.php');

class CreateQuotesTable extends Migration {
    public function up() {
      $sql = "CREATE TABLE $this->table (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        quote TEXT NOT NULL,
        author_id INT(6) UNSIGNED,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (author_id) REFERENCES authors(id)
      )";
      $this->execute($sql);
    }
  
    public function down() {
      $this->dropTable();
    }
}