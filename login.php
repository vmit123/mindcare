<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $file = 'users.json';

    if (!file_exists($file)) {
        // No users registered yet
        header("Location: signup.html?error=Please sign up first");
        exit();
    }

    $users = json_decode(file_get_contents($file), true);
    $userFound = false;

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $userFound = true;
            break;
        }
    }

    if ($userFound) {
        // Redirect to dashboard or home
        header("Location: index.html");
        exit();
    } else {
        // Redirect to signup page with alert if login fails
        echo "<script>
                alert('Invalid login. Please sign up first.');
                window.location.href='signup.html';
              </script>";
        exit();
    }
}
?>
