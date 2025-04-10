<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
            background-color: #200F21;
        }
        .heading {
    
            color: #fff;
            margin-bottom: 50px;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 40px;
        }
        .btn {
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: #3498db;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <h1 class = "heading">Welcome to Our App</h1>

    <div class="button-container">
        <a href="/login" class="btn">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>

        <a href="/signup" class="btn">
            <i class="fas fa-user-plus"></i> Signup
        </a>
    </div>

</body>
</html>
