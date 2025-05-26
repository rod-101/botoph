export async function navbar(container) {
    let isLoggedIn = false;

    try { //navbar is fetched in index.html so it's 'api/login...' not './api/log..'
        const response = await fetch('api/login_status.php', { 
            method: 'GET',
            credentials: 'include' // include PHP session cookie
        });
        const data = await response.json();
        isLoggedIn = data.isLoggedIn;
    } catch (error) {
        console.error("Error checking auth status:", error);
    }

    container.innerHTML = `
        <nav class="flex items-center justify-between bg-white py-4 px-6 lg:px-12 shadow-sm border-b border-gray-200">
            <div class="text-gray-900 font-semibold text-xl tracking-wide">
                BotoPH | 2025
            </div>
            <div id="menu" class="flex space-x-6">
                <a href="views/about.html" class="text-gray-700 hover:text-gray-900 transition font-medium px-3 py-2 rounded-md whitespace-nowrap">
                    About Us
                </a>
                ${
                    isLoggedIn
                        ? `
                            <a href="views/account.php" class="text-gray-700 hover:text-gray-900 transition font-medium px-3 py-2 rounded-md whitespace-nowrap">
                                Account
                            </a>
                            <a href="#" id="logoutBtn" class="text-gray-700 hover:text-gray-900 transition font-medium px-3 py-2 rounded-md whitespace-nowrap border border-gray-300 hover:border-gray-700">
                                Logout
                            </a>
                        `
                        : `
                            <a href="register.php" class="text-gray-700 hover:text-gray-900 transition font-medium px-3 py-2 rounded-md whitespace-nowrap">
                                Signup
                            </a>
                            <a href="login.php" class="text-gray-700 hover:text-gray-900 transition font-medium px-3 py-2 rounded-md whitespace-nowrap border border-gray-300 hover:border-gray-700">
                                Login
                            </a>
                        `
                }
            </div>
        </nav>
    `;

   //check if user (voter) is logged in
    if (isLoggedIn) {
        const logoutBtn = container.querySelector('#logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', async (e) => {
                e.preventDefault();
                try {
                    const response = await fetch('api/logout.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        credentials: 'include'
                    });
                    const data = await response.json();
                    alert(data.message);
                    window.location.href = 'login.php';
                } catch (err) {
                    console.error('Logout failed:', err);
                }
            });
        }
    }
}
