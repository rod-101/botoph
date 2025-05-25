<?php
    include 'backend/dbConnection.php';
    session_start();

    // use this key for auth 58a520c2f866ddbe25294f86ea9c90c5

    $showModal = false;

    if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
        $showModal = true;
        unset($_SESSION['registration_success']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['pass'];

        $sql = "SELECT user_id, CONCAT(first_name, ' ', last_name) AS full_name, email, password_hash, role FROM users WHERE email = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);            
            $stmt->execute();
            $stmt->store_result();
            
            // Check if the email exists in the database
            if ($stmt->num_rows > 0) {
                // Bind the result variables
                $stmt->bind_result($id, $full_name, $db_email, $db_password, $role);
                
                // Fetch the result
                $stmt->fetch();
                
                // Verify the password (assuming the password is hashed in the database)
                if (password_verify($password, $db_password)) {
                    // Password is correct, set session variables
                    $_SESSION['id'] = $id;
                    $_SESSION['email'] = $db_email;
                    $_SESSION['role'] = $role;
                    $_SESSION['fullname'] = $full_name;
                    
                    //set last_login to NOW()
                    $update = "UPDATE users SET last_login = NOW() WHERE user_id = ?";
                    $stmt = $conn->prepare($update);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();

                    //redirect accordingly
                    if($role == 'admin') {
                        header("Location: adminDashboard.html"); // Redirect to dashboard or home page
                    } else if($role == 'moderator') {
                        header("Location: moderatorDashboard.html"); // Redirect to dashboard or home page                        
                    } else {
                        header("Location: index.html"); // Redirect to dashboard or home page
                    }
                } else {
                    // Invalid password
                    echo "Invalid email or password.";
                }
            } else {
                // Email does not exist
                echo "Invalid email or password.";
            }
            
            $stmt->close();
            $conn->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BotoPH Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/login.css">
        <style>
            .modal {
                display: none;
                position: fixed;
                z-index: 999;
                left: 0;
                top: 0;
                width: 100vw;
                height: 100vh;
                background-color: rgba(0,0,0,0.4);
            }
            .modal-content {
                background-color: #fff;
                margin: 15% auto;
                padding: 20px;
                border-radius: 8px;
                width: 300px;
                text-align: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                animation: fadeIn 0.5s ease-in-out;
            }
            .close {
                float: right;
                font-size: 20px;
                font-weight: bold;
                cursor: pointer;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">

                <!-- Login Form -->
                <div class="col-sm-5 d-flex align-items-center justify-content-center vh-100 bg-white">
                    <div class="login-card">
                        <div class="text-center mb-4">
                            <img src="../assets/botoph-logo.png" alt="Logo" width="60">
                            <h4 class="mt-2">BotoPH</h4>
                        </div>
                        <h5 class="mb-3">Log in</h5>
                        <form method="POST">
                            <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email address" required>
                            </div>
                            <div class="mb-3">
                            <input type="password" name="pass" class="form-control" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <div class="mt-3">
                            <a href="#" class="d-block small">Forgot password?</a>
                            <p class="mt-2 mb-0">Don't have an account? <a href="register.php">Register here</a></p>
                        </div>
                    </div>
                </div>

                <!-- Quote Section -->
                <div class="col-sm-7 quote-section">
                    <div>
                        <p id="quote">The worth of a State, in the long run, is the worth of the individuals composing it.</p>
                        <p id="author">– John Stuart Mill</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal popup -->
       <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Registration successful! <br> Please log in.</p>
            </div>
        </div>

        <script>
            const showModal = <?php echo json_encode($showModal); ?>;

            window.onload = function () {
                const modal = document.getElementById("myModal");

                if (showModal) {
                    modal.style.display = "block";

                    setTimeout(() => {
                        modal.style.display = "none";
                    }, 3000);
                }

                document.querySelector(".close").onclick = function () {
                    modal.style.display = "none";
                };

                window.onclick = function (event) {
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                };
            };
        </script>
    </body>
</html>
