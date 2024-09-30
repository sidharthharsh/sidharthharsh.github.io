<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #555;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login Page</h2>
        <form action="index.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <?php
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Hardcoded username and password pairs
            $valid_credentials = [
                ['username' => 'user1', 'password' => 'pass1'],
                ['username' => 'user2', 'password' => 'pass2'],
                ['username' => 'user3', 'password' => 'pass3'],
                ['username' => 'user4', 'password' => 'pass4'],
                ['username' => 'user5', 'password' => 'pass5'],
            ];

            // Flag to check if user is valid
            $is_valid = false;

            // Validate the credentials
            foreach ($valid_credentials as $credential) {
                if ($username == $credential['username'] && $password == $credential['password']) {
                    $is_valid = true;
                    break;
                }
            }

            // Redirect if valid
            if ($is_valid) {
                header("Location: index1.php");
                exit;
            } else {
                echo "<p class='error-message'>Invalid username or password!</p>";
            }
        }
        ?>
    </div>

</body>
</html>
