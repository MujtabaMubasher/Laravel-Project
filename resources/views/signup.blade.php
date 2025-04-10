<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style>
        body {
            background-color: #200F21;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
        }
        .signup-container h2 {
            margin-bottom: 25px;
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #2ecc71;
        }
        .signup-btn {
            width: 100%;
            padding: 12px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .signup-btn:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>

    <div class="signup-container">
        <h2>Create Account</h2>

        <form action="/register" method="POST">
         @csrf
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Create Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="signup-btn">Sign Up</button>
        </form>
    </div>

</body>
</html>
