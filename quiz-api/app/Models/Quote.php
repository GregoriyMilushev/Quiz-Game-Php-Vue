<?php
require_once __DIR__ . '/Model.php';
require_once __DIR__ . '/Author.php';

class Quote extends Model {
    public function __construct() {
        parent::__construct();
        $this->setTable('quotes');
    }

    public function author() {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function random($excludedIds) {
        $query = "SELECT * FROM quotes";
        if (!empty($excludedIds)) {
            $query .= " WHERE id NOT IN (" . $excludedIds . ")";
        }
        $query .= " ORDER BY RAND() LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $model = new static();
        foreach ($result as $key => $value) {
            $model->$key = $value;
        }

        return $model;
    }
}