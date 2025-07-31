<?php
require_once __DIR__ . '/../../config/db.php';

class AuthController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    function createUser(string $name, string $email, string $password, string $role): string
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return json_encode(['error' => 'Método inválido']);
        }

        if (empty($name) || empty($email) || empty($password) || empty($role)) {
            return json_encode(['error' => 'Preencha todos os campos.']);
        }

        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role
        ]);

        return json_encode(
            [
                'success' => 'Usuário criado com sucesso.',
                'code' => 201,
                'user' => [
                    'id' => $this->db->lastInsertId(),
                    'name' => $name,
                    'email' => $email,
                    'token' => 'logado',
                ]
            ]
        );
    }
    function login(string $email, string $password): string
    {

        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return json_encode(['error' => 'Método inválido']);
        }



        if (empty($email) || empty($password))
            return json_encode(['error' => 'Preencha todos os campos.']);


        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user)
            return json_encode(['error' => 'Usuário não encontrado.']);
        if (!password_verify($password, $user['password']))
            return json_encode(['error' => 'Senha incorreta.']);

        return json_encode(
            [
                'success' => 'Login bem-sucedido.',
                'code' => 200,
                'token' => 'logado',
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                ]
            ]
        );
    }
}
return new AuthController();
