<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $file = 'users.json';

    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }

    $users = json_decode(file_get_contents($file), true);

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            header("Location: signup.php?error=Email already registered");
            exit();
        }
    }

    $users[] = [
        "username" => $username,
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ];

    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

    // Redirect to login page
    header("Location: login.html");
    exit();
}
?>
