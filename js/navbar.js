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
  <nav class="bg-white border-b border-gray-200 px-4 py-3 lg:px-12 shadow-sm">
    <div class="flex items-center justify-between">
      <div class="text-gray-900 font-semibold text-xl tracking-wide">
        BotoPH | 2025
      </div>

      <!-- Hamburger button -->
      <button id="menuToggle" class="lg:hidden text-gray-700 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16">
          </path>
        </svg>
      </button>

      <!-- Menu for large screens -->
      <div id="menu" class="hidden lg:flex lg:items-center lg:space-x-6">
        <a href="views/about.html" class="nav-link">About Us</a>
        ${
          isLoggedIn
            ? `
              <a href="views/account.php" class="nav-link">Account</a>
              <a href="#" id="logoutBtn" class="nav-link border border-gray-300 hover:border-gray-700">Logout</a>
            `
            : `
              <a href="register.php" class="nav-link">Signup</a>
              <a href="login.php" class="nav-link border border-gray-300 hover:border-gray-700">Login</a>
            `
        }
      </div>
    </div>

    <!-- Mobile dropdown menu -->
    <div id="mobileMenu" class="mt-4 space-y-2 lg:hidden hidden">
      <a href="views/about.html" class="nav-link block">About Us</a>
      ${
        isLoggedIn
          ? `
            <a href="views/account.php" class="nav-link block">Account</a>
            <a href="#" id="logoutBtnMobile" class="nav-link block border border-gray-300 hover:border-gray-700">Logout</a>
          `
          : `
            <a href="register.php" class="nav-link block">Signup</a>
            <a href="login.php" class="nav-link block border border-gray-300 hover:border-gray-700">Login</a>
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
    
// Tailwind utility class shortcut
const navLinks = container.querySelectorAll('.nav-link');
navLinks.forEach(link => {
  link.classList.add('text-gray-700', 'hover:text-gray-900', 'transition', 'font-medium', 'px-3', 'py-2', 'rounded-md');
});

// Toggle mobile menu
const menuToggle = container.querySelector('#menuToggle');
const mobileMenu = container.querySelector('#mobileMenu');
if (menuToggle && mobileMenu) {
  menuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
}

// Logout (desktop)
const logoutBtn = container.querySelector('#logoutBtn');
// Logout (mobile)
const logoutBtnMobile = container.querySelector('#logoutBtnMobile');

const attachLogoutHandler = (btn) => {
  if (!btn) return;
  btn.addEventListener('click', async (e) => {
    e.preventDefault();
    try {
      const response = await fetch('api/logout.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include'
      });
      const data = await response.json();
      alert(data.message);
      window.location.href = 'login.php';
    } catch (err) {
      console.error('Logout failed:', err);
    }
  });
};

attachLogoutHandler(logoutBtn);
attachLogoutHandler(logoutBtnMobile);


   
}
