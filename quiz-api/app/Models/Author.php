<?php

require_once __DIR__ . '/Model.php';
require_once __DIR__ . '/Quote.php';

class Author extends Model {
    public function __construct() {
        parent::__construct();
        $this->setTable('authors');
    }

    public function quotes() {
        return $this->hasMany(Quote::class, 'author_id');
    }

    public function random($count = 1, $excludedIds = []) {
        // Build the WHERE clause for excluded IDs
        $excludedIdsWhereClause = '';
        if (!empty($excludedIds)) {
            $excludedIdsWhereClause = 'WHERE id NOT IN (' . implode(',', $excludedIds) . ')';
        }

        // Build the query to select random authors
        $query = "SELECT * FROM authors $excludedIdsWhereClause ORDER BY RAND() LIMIT $count";
        // Prepare and execute the query
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}