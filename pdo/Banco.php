<?php

require_once("connection_pdo.php");

class Banco
{
    private $tabela_aluno = "alunos";
    private $campo_nome_aluno = "nome";
    private $campo_curso_aluno = "curso";
    private $campo_data_criacao = "data_criacao";

    function inserir($nome, $aluno)
    {
        try {
            $db = conecta();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO {$this->tabela_aluno}
                   ({$this->campo_nome_aluno}, {$this->campo_curso_aluno}, {$this->campo_data_criacao}) 
                   VALUES ('{$nome}', '{$aluno}', '" . date("m/d/Y H:i:s") . "')";
            $db->exec($sql);

            return $db;


        } catch (Exception $exception) {
            echo $exception;
        }
    }

    function select()
    {
        try {
            $db = conecta();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("SELECT * FROM {$this->tabela_aluno} ORDER BY id DESC ");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;

        } catch (Exception $exception) {
            echo $exception;
        }

    }

    function update($nome, $curso, $id)
    {
        try {
            $db = conecta();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("UPDATE {$this->tabela_aluno} SET nome='{$nome}', curso='${curso}' WHERE id=${id}");
            $stmt->execute();

            return $stmt->rowCount();

        } catch (Exception $exception) {
            echo $exception;
        }

    }

    function delete($id)
    {
        try {
            $db = conecta();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM {$this->tabela_aluno} WHERE id=${id}";
            $db->exec($sql);

        } catch (Exception $exception) {
            echo $exception;
        }

    }


}