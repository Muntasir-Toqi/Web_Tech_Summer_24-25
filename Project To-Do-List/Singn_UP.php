<?php 
    include("db.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatpassword = $_POST['repeatpassword'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];
        $notification = isset($_POST['notification']) ? 1 : 0;

        if ($password !== $repeatpassword) {
            echo "<p style='color:red;'>Passwords do not match!</p>";
        }
        else {
        
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, password, birthday, gender, notification) 
                 VALUES ('$username', '$email', '$hashedPassword', '$birthday', '$gender', '$notification')";

            if ($conn->query($sql) === TRUE) {
                header("Location: welcome.php?user=" . urlencode($username));
                exit();
            } 
            else {
                echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body class="auth-page">
    <div class="form-container">
        <h2>Sign Up</h2>
        <hr>
        <form action="" method="post">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" required />
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email" required />
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required />
            <label for="repeatpassword"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="repeatpassword" id="repeatpassword" required />
            <label for="birthday">Date Of Birth:</label>
            <input type="date" id="birthday" name="birthday" required>
            Please Select Your Gender:<br>
            <input type="radio" id="gender1" name="gender" value="Male" style="width: 5%;" required>
            <label for="gender1"><b>Male</b></label><br>
            <input type="radio" id="gender2" name="gender" value="Female" style="width: 5%;" required>
            <label for="gender2"><b>Female</b></label><br>
            <hr>
            <input type="checkbox" name="notification" id="notification" style="width: 5%;">
            <label for="notification">Send Me Notification for all Updates</label><br>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
