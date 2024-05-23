<?php

class Tarefas {
    private $conexao;
    private $table_name = 'tarefas';

    public $id_tarefas;
    public $nome;
    public $descricao;
    public $id_usuario;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function create(){
        $query = 'INSERT INTO ' . $this->table_name . ' SET nome = :nome, descricao = :descricao, id_usuario = :id_usuario';
        $stmt = $this->conexao->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll(){
        $query = 'SELECT * FROM ' . $this->table_name;
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTarefaById($id) {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE id_tarefas =
        :id_tarefas';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':id_tarefas', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->id_tarefa = $row['id_tarefa'];
            $this->nome = $row['nome'];
            $this->descricao = $row['descricao'];
            $this->id_usuario = $row['id_usuario'];
            return $row;
        }
        return [];
    }

    public function update () {
        $query = 'UPDATE ' . $this->table_name . ' SET nome = :nome, descricao = :descricao, id_usuario = :id_usuario';
        $stmt = $this->conexao->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':id_usuario', $this->id_usuario);
        if ($stmt->execute()){
            return true;
        }
        return false;
    }

    public function remove() {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id_tarefas = :id_tarefas';
        $stmt = $this->conexao->prepare($query);

        $this->id_tarefas = (int) $this->id_tarefas;
        $stmt->bindParam(':id_tarefas', $this->id_tarefas);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}