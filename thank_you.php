<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Feedback</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('thankyou.png');
            background-size: cover;
            color: #fff;
            text-align: center;
        }

        .container {
            background: rgba(0, 0, 0, 0.6); /* Adds a transparent overlay */
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .thank-you-container {
            text-align: center;
            padding: 50px 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .thank-you-message {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        a {
            font-size: 1em;
            color: #ffd700;
            text-decoration: none;
            font-weight: bold;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #2980b9;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container thank-you-container">
        <h1 class="thank-you-message">Thank You for Your Feedback!</h1>
        <p>We appreciate you taking the time to share your thoughts with us.</p>
        <p>Your feedback helps us improve our services.</p>
        <a href="index.php" class="back-button">Return to Homepage</a>
    </div>
</body>
</html>