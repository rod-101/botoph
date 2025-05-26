<?php
session_start();
$id = $_SESSION['id'];
$role = $_SESSION['role'];
$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];
$joined = date("F j, Y", strtotime($_SESSION['joined']));

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Account</title>
  <link rel="stylesheet" href="../css/account.css" />
</head>
<body>


    <div class="container">
        <div class="account-card">
            <div class="avatar-section">
                <img src="../assets/user.png" alt="User Avatar" class="avatar" />
                <h2 class="user-name"><?php echo $fullname ?></h2>
                <p class="user-role"><?php echo $role ?></p>
            </div>

            <div class="info-section">
                <div class="info-row"><strong>Email:</strong> <?php echo $email ?></div>
                <div class="info-row"><strong>Joined:</strong> <?php echo $joined ?></div>
                <!-- <div class="info-row"><strong>Phone:</strong> 0917-123-4567</div>
                <div class="info-row"><strong>Location:</strong> Quezon City, NCR</div> -->
            </div>

            <div class="action-buttons">
                <button class="btn primary">Edit Profile</button>
                <button class="btn secondary" id="logout">Logout</button>
                <button class="btn tertiary" onclick="history.back()">← Back</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('logout').addEventListener('click', async () => {
            try {
                const response = await fetch('../api/logout.php', {
                    method: 'POST',
                    credentials: 'include'
                });

                const result = await response.json();
console.log(result.success)
                if (result.success) {
                    // Redirect to login or home page
                    window.location.href = '../index.html';
                } else {
                    alert('Logout failed.');
                }
            } catch (error) {
                console.error('Logout error:', error);
                alert('Something went wrong while logging out.');
            }
        });
    </script>
</body>
</html>
