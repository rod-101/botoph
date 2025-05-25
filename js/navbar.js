export async function navbar(container) {
  container.innerHTML = `
    <nav class="flex items-center justify-between bg-white py-4 px-6 lg:px-12 shadow-sm border-b border-gray-200">
      <!-- Brand -->
      <div class="text-gray-900 font-semibold text-xl tracking-wide">
        BotoPH | 2025
      </div>

      <!-- Menu links -->
        <div id="menu" class="flex space-x-6">
            <a href="../README.md" class="text-gray-700 hover:text-gray-900 transition font-medium px-3 py-2 rounded-md whitespace-nowrap">
                About Us
            </a>
            <a href="#" class="text-gray-700 hover:text-gray-900 transition font-medium px-3 py-2 rounded-md whitespace-nowrap">
                Signup
            </a>
            <a href="#" class="text-gray-700 hover:text-gray-900 transition font-medium px-3 py-2 rounded-md whitespace-nowrap border border-gray-300 hover:border-gray-700">
                Login
            </a>
        </div>
    </nav>
  `;
}
