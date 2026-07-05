<?php
session_start();

if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Get Coffee</title>
    
    <link rel="stylesheet" href="css/style.css">
    <style>
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--color-primary); 
            margin: 0;
            font-family: var(--font-sans);
        }
        .login-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-card h2 {
            color: var(--color-accent); 
            margin-bottom: 0.5rem;
            font-weight: 800;
            letter-spacing: 1px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 1.2rem;
        }
        .form-group label {
            display: block;
            color: #faf9f6;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            box-sizing: border-box;
            font-family: inherit;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--color-accent);
            background: rgba(255, 255, 255, 0.08);
        }
        .btn-login {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--color-accent);
            border: none;
            border-radius: 8px;
            color: var(--color-primary);
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(201, 160, 80, 0.2);
        }
        .btn-login:hover {
            background-color: var(--color-accent-light);
            box-shadow: var(--shadow-md);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>GET COFFEE</h2>
        <p style="color: #a8968e; margin-bottom: 2rem; font-size: 0.95rem;">Please login to continue</p>
        
        <form action="process-login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter password">
            </div>
            <button type="submit" name="submit_login" class="btn-login">Login</button>
        </form>
    </div>

</body>
</html>
