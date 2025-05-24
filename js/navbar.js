export async function navbar(container) {
  container.innerHTML = `
    <nav class="flex flex-wrap items-center justify-between bg-white py-4 lg:px-12 shadow-sm border-b border-gray-200">
      <div class="flex justify-between items-center w-full px-6 lg:px-0 lg:w-auto border-b lg:border-none pb-5 lg:pb-0">
        <!-- Brand -->
        <div class="flex items-center flex-shrink-0 text-gray-900">
          <span class="font-semibold text-xl tracking-tight">BotoPH</span>
        </div>

        <!-- Hamburger button only for small screens -->
        <div class="flex items-center space-x-2 lg:hidden">
          <button id="nav" type="button" class="flex items-center px-3 py-2 border rounded text-gray-600 border-gray-300 hover:text-gray-900 hover:border-gray-500">
            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Menu links aligned to right -->
      <div id="menu" class="menu hidden w-full lg:block flex-grow lg:flex lg:items-center lg:w-auto lg:px-3 px-6 justify-end">
        <div class="text-md font-medium text-gray-700 lg:flex-grow-0">
          <a href="#" class="block mt-4 lg:inline-block lg:mt-0 hover:bg-gray-100 px-4 py-2 rounded transition">Menu 1</a>
          <a href="#" class="block mt-4 lg:inline-block lg:mt-0 hover:bg-gray-100 px-4 py-2 rounded transition">Menu 2</a>
          <a href="#" class="block mt-4 lg:inline-block lg:mt-0 hover:bg-gray-100 px-4 py-2 rounded transition">Menu 3</a>
        </div>
      </div>
    </nav>
  `;

  document.getElementById('nav').addEventListener('click', () => {
    document.getElementById('menu').classList.toggle('hidden');
  });
}
