function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleBtn");
    sidebar.classList.toggle("closed");
    toggleBtn.textContent = sidebar.classList.contains("closed") ? "☰" : "✕";
}

function logout() {
    window.location.replace('http://localhost/BotoPH/views/login.php');
}

// sidebar.js
export async function loadSidebar(containerId) {
    let fullname = 'Unauthorized';
    let email = 'unauthorized@access.com';

    try {
        const response = await fetch('../api/fetch_user_session.php');
        const data = await response.json();
        fullname = data.fullname;
        email = data.email;
    } catch (error) {
        console.error('Failed to fetch session info:', error);
    }

    const sidebarHTML = `
        <div class="sidebar closed" id="sidebar">
            <div class="sidebar-content">
                <div id="adminProfImgContainer">
                    <img src="../assets/admin-profile-3.png" id="admin-profile">
                    <div id="name"><b>${fullname}</b></div>
                    <div id="email"><i>${email}</i></div>
                </div><br>

                <div class="sidebar-page-links">
                    <a href="adminDashboard.html" class="page-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </div><br>

                <h3>User Management</h3>
                <ul>
                    <li><a href="manageVoters.html"><i class="fas fa-users"></i> Manage Voters</a></li>
                    <li><a href="#"><i class="fas fa-user-shield"></i> Manage Moderators</a></li>
                </ul><br>

                <h3>Candidate Information</h3>
                <ul>
                    <li><a href="manageCandidates.html"><i class="fas fa-users"></i> Manage Candidates</a></li>
                    <li><a href="#"><i class="fas fa-vote-yea"></i> Manage Elections</a></li>
                </ul>
                
                <div><button id="logoutBtn">Logout</button></div>
            </div>
        </div>

        <div class="toggle-btn" id="toggleBtn">☰</div>
    `;
    document.getElementById(containerId).innerHTML = sidebarHTML;
    document.getElementById('toggleBtn').addEventListener('click', toggleSidebar);
    document.querySelector('#logoutBtn').addEventListener('click', logout);
}