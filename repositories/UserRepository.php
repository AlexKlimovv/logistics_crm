<?php
require_once __DIR__ . '/../models/User.php';
use models\User;
class UserRepository
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByUsername(string $username) : ? User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null; // если пользователя нет
        }

        $user = new User (
            $data['username'],
            $data['password'],
            $data['role']
        );
        $user->id = $data['id'];
        return $user;
    }
}