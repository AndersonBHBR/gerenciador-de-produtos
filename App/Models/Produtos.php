<?php
    namespace App\Models;

    class Produtos {
        private static $table = 'produtos';

        public static function select(int $id) {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table.' WHERE id = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum produto encontrado!");
            }
        }

        public static function selectAll() {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table;
            $stmt = $connPdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum produto encontrado!");
            }
        }

        public static function insert($data) {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'INSERT INTO '.self::$table.' (nome, descricao, preco, quantidade) VALUES (:nome, :descricao, :preco, :quantidade)';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':nome', $data['nome']);
            $stmt->bindValue(':descricao', $data['descricao']);
            $stmt->bindValue(':preco', $data['preco']);
            $stmt->bindValue(':quantidade', $data['quantidade']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Produto inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir produto!");
            }
        }

        public static function update($id, $data) {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
    
            $sql = 'UPDATE '.self::$table.' SET nome = :nome, descricao = :descricao, preco = :preco, quantidade = :quantidade WHERE id = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nome', $data['nome']);
            $stmt->bindValue(':descricao', $data['descricao']);
            $stmt->bindValue(':preco', $data['preco']);
            $stmt->bindValue(':quantidade', $data['quantidade']);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                return 'Produto atualizado com sucesso!';
            } else {
                throw new \Exception("Falha ao atualizar produto!");
            }
        }
    
        public static function delete($id) {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
    
            $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                return 'Produto excluído com sucesso!';
            } else {
                throw new \Exception("Falha ao excluir produto!");
            }
        }
    }