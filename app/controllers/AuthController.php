<?php
require_once __DIR__ . '/../../config/db.php';

class AuthController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    function createUser(string $name, string $email, string $phone, string $password, string $role): string
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return json_encode(['error' => 'Método inválido']);
        }

        if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($role)) {
            http_response_code(400);
            return json_encode(['error' => 'Preencha todos os campos.']);
        }

        $stmt = $this->db->prepare("INSERT INTO admin (name, email, phone, password, role) VALUES (:name, :email, :phone, :password, :role)");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role
        ]);
        http_response_code(201);
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



        if (empty($email) || empty($password)){
            http_response_code(400);
            return json_encode(['error' => 'Preencha todos os campos.']);
        }

        $stmt = $this->db->prepare("SELECT * FROM admin WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user){
            http_response_code(400);
            return json_encode(['error' => 'Usuário não encontrado.']);
        }
        if (!password_verify($password, $user['password'])){
            http_response_code(403);
            return json_encode(['error' => 'Senha incorreta.']);
        }

        return json_encode(
            [
                'success' => 'Login bem-sucedido.',
                'code' => 200,
                'token' => 'logado',
                'redirect' => '/admin',
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
