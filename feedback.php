<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
</head>
<style>
    /* Body styling */
body {
    background: url('bluemoon.jpg') no-repeat center center fixed;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Feedback container */
.feedback-container {
    background: #fff;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    text-align: center;
}

/* Form elements */
.feedback-form label {
    display: block;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
    text-align: left;
}

.feedback-form input,
.feedback-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    outline: none;
}

.feedback-form input:focus,
.feedback-form textarea:focus {
    border-color: #007BFF;
    box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
}

/* Submit button */
.submit-btn {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: #0056b3;
}
</style>
<body>
    <div class="feedback-container">
        <h1>Submit Your Feedback</h1>
        <form action="feedback_process.php" method="post" class="feedback-form">
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="comment">Your Comment:</label>
            <textarea id="comment" name="comment" rows="5" placeholder="Write your comment here..." required></textarea>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</body>
</html>
