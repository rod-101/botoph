<?php
    include '../backend/dbConnection.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $birth = $_POST['birthdate'];
        $region = $_POST['region'];
        $province = $_POST['province'];
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sqlEmailIsAvailable = "SELECT email FROM users WHERE email = ?";

        if($stmt = $conn->prepare($sqlEmailIsAvailable)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "email already in use.";
                exit();
            }
            $stmt->close();

            $sql = "INSERT INTO users (first_name, middle_name, last_name, email, password_hash, birthdate, region, province) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            if($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssssssss", $fname, $mname, $lname, $email, $hashedPassword, $birth, $region, $province);            
                $stmt->execute();
                if($stmt->affected_rows > 0) {
                    $_SESSION['registration_success'] = true;
                    header("Location: login.php");
                    exit();
                } else {
                    echo "registration failed.";
                    exit();
                }
                $stmt->close();
            } else {
                echo "error preparing statement.";
                exit();
            }
        } else {
            echo "error preparing email check query.";
            exit();
        }
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Register</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

        <div class="w-full max-w-xl bg-white p-8 rounded-2xl shadow-lg" style="transform:scale(0.85);">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Create an Account</h2>

            <form action="register.php" method="POST" class="space-y-4">
                <!-- First Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="fname" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Middle Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                    <input type="text" name="mname" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Last Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="lname" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="pass" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Birthdate -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Birthdate</label>
                    <input type="date" name="birthdate" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Region -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Region</label>
                    <input type="text" name="region" required placeholder="e.g., Region IV-A" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Province -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Province</label>
                    <input type="text" name="province" required placeholder="e.g., Batangas" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Register</button>
                </div>
            </form>
        </div>
    </body>
</html>
