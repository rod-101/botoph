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
    <script type="module">
        import { authCheckOnPageRestoreForVoter, checkSessionAndRedirectForVoter } from '../js/auth.js'

        checkSessionAndRedirectForVoter();
        authCheckOnPageRestoreForVoter();
    </script>
    <style>
        .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(3px);
        justify-content: center;
        align-items: center;
        }

        .modal-content {
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        position: relative;
        }

        .modal-content h3 {
        margin-top: 0;
        }

        .modal-content label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        }

        .modal-content input {
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border-radius: 6px;
        border: 1px solid #ccc;
        }

        .modal-content .close {
        position: absolute;
        right: 1rem;
        top: 1rem;
        font-size: 1.2rem;
        cursor: pointer;
        }
    </style>

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
                <button class="btn primary" id="editEmailBtn">Edit Profile</button>
                <button class="btn secondary" id="logout">Logout</button>
                <button class="btn tertiary" onclick="history.back()">← Back</button>
            </div>
        </div>
    </div>

        <!-- Edit Email Modal -->
    <div id="editEmailModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h3>Edit Email</h3>
        <form id="editEmailForm">
        <label for="newEmail">New Email</label>
        <input type="email" id="newEmail" name="newEmail" required placeholder="Enter new email" value="<?php echo $email ?>" />
        <button type="submit" class="btn primary">Update Email</button>
        </form>
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

        // for modal
        document.getElementById('editEmailBtn').addEventListener('click', () => {
            document.getElementById('editEmailModal').style.display = 'flex';
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('editEmailModal').style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            const modal = document.getElementById('editEmailModal');
            if (e.target === modal) modal.style.display = 'none';
        });

        document.getElementById('editEmailForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const newEmail = document.getElementById('newEmail').value;

            try {
                const response = await fetch('../api/updateEmail.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    credentials: 'include',
                    body: JSON.stringify({ email: newEmail })
                });

                const result = await response.json();

                if (result.success) {
                    alert('Email updated successfully.');
                    window.location.reload(); // refresh to show updated email
                } else {
                    alert(result.message || 'Update failed.');
                }
            } catch (err) {
                console.error(err);
                alert('Error updating email.');
            }
        });
    </script>

</body>
</html>
