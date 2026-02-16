<?php
class UserRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function insertOrFindByEmail($email) {

        $st = $this->pdo->prepare(
            "SELECT * FROM users WHERE email = ? LIMIT 1"
        );
        $st->execute([$email]);
        $user = $st->fetch(PDO::FETCH_ASSOC);

        if ($user !== false) {
            return $user;
        }

        $st = $this->pdo->prepare(
            "INSERT INTO users (email) VALUES (?)"
        );
        $st->execute([$email]);

        $id = $this->pdo->lastInsertId();

        $st = $this->pdo->prepare(
            "SELECT * FROM users WHERE id_users = ?"
        );
        $st->execute([$id]);

        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsersExcept($currentUserId) {
        $st = $this->pdo->prepare(
            "SELECT * FROM users WHERE id_users != ? ORDER BY email"
        );
        $st->execute([$currentUserId]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}

