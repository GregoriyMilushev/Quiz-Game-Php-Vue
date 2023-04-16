<?php

require_once('Migration.php');

class AddForeignKeyToQuizzesTable extends Migration {
  public function up() {
    $sql = "ALTER TABLE $this->table
      ADD CONSTRAINT fk_quizzes_answers
      FOREIGN KEY (answer_id) REFERENCES answers(id)
      ON DELETE SET NULL";

    $this->execute($sql);
  }

  public function down() {
    $this->pdo->exec("
      ALTER TABLE $this->table
      DROP FOREIGN KEY fk_quizzes_answers
    ");
  }
}
