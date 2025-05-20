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
export function loadSidebar(containerId) {
    const sidebarHTML = `
        <div class="sidebar closed" id="sidebar">
            <div class="sidebar-content">
                <div id="adminProfImgContainer">
                    <img src="../assets/admin-profile.png" id="admin-profile">
                    <div id="name">name</div>
                    <div id="email">email</div>
                </div>

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
                    <li><a href="#"><i class="fas fa-user-tie"></i> Manage Candidates</a></li>
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