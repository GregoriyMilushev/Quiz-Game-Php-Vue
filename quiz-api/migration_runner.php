<?php

require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/database/migrations/Migration.php';
require_once __DIR__ . '/database/migrations/20230407120433_create_quotes_table.php';
require_once __DIR__ . '/database/migrations/20230407121233_create_authors_table.php';

function createMigrationsTable($pdo) {
  $pdo->exec("
    CREATE TABLE IF NOT EXISTS migrations (
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      migration VARCHAR(255) NOT NULL
    )
  ");
}

function runMigrations($pdo) {
  $tableNames = ['quotes', 'authors'];
  $migrations = [
    new CreateAuthorsTable($pdo, $tableNames[1]),
    new CreateQuotesTable($pdo, $tableNames[0])
  ];
  
  createMigrationsTable($pdo); // Create the migrations table if it does not exis

  $executedMigrations = [];
  
  $stmt = $pdo->query("SELECT migration FROM migrations");
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $executedMigrations[] = $row['migration'];
  }

  foreach ($migrations as $migration) {
    $migrationName = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', get_class($migration)));
    if (!in_array($migrationName, $executedMigrations)) {
      echo "Executing migration: $migrationName\n";
      $migration->up();
      $pdo->prepare("INSERT INTO migrations (migration) VALUES (?)")->execute([$migrationName]);
    }
  }
}

try {
  runMigrations($pdo);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
