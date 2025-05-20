// sidebar.js
export function loadSidebar(containerId) {
    const sidebarHTML = `
        <div class="sidebar closed" id="sidebar">
            <div class="sidebar-content">
                <div class="sidebar-page-links">
                    <a href="#" class="page-link"><i class="fas fa-user"></i> Profile</a>
                    <a href="#" class="page-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </div><br>
                <h3>User Management</h3>
                <ul>
                    <li><a href="voterList.php"><i class="fas fa-users"></i> Manage Voters</a></li>
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

        <div class="toggle-btn" onclick="toggleSidebar()" id="toggleBtn">☰</div>
    `;
    document.getElementById(containerId).innerHTML = sidebarHTML;
}
