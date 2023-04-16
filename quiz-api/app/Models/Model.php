<?php

require_once __DIR__ . '/../../database/database.php';

abstract class Model {

    protected $db;
    protected $table;

    public function __construct() {
        global $pdo;
        $this->db = $pdo;
    }

    public function getTable() {
        return $this->table;
    }

    public function setTable($table) {
        $this->table = $table;
    }

    public function all() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $model = new static();
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }

        return $model;
    }

    public function belongsTo($model, $foreign_key) {
        $model = new $model($this->db);
        $query = "SELECT * FROM " . $model->getTable() . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->$foreign_key);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception("Invalid foreign key value: " . $this->$foreign_key);
        }

        return $result;
    }

    public function hasMany($model, $foreign_key) {
        $model = new $model($this->db);
        $query = "SELECT * FROM " . $model->getTable() . " WHERE " . $foreign_key . " = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception("Invalid id value: " . $this->id);
        }
        return $result;
    }
}
