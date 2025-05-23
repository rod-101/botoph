export async function navbar(body) {
  body.innerHTML = `
    <nav class="flex flex-wrap items-center justify-between bg-white py-4 lg:px-12 shadow-sm border-b border-gray-200">
      <div class="flex justify-between items-center w-full px-6 lg:px-0 lg:w-auto border-b lg:border-none pb-5 lg:pb-0">
        <div class="flex items-center flex-shrink-0 text-gray-900">
          <span class="font-semibold text-xl tracking-tight">BotoPH</span>
        </div>

        <!-- Small screen search bar + hamburger -->
        <div class="flex items-center space-x-2 lg:hidden">
          <div class="relative text-gray-700">
            <input
              class="border border-gray-300 bg-white h-8 pl-3 pr-8 rounded-lg text-sm focus:outline-none focus:border-gray-400"
              type="search" name="search" placeholder="Search" />
            <button type="submit" class="absolute right-0 top-0 mt-2 mr-2">
              <svg class="text-gray-500 h-3.5 w-3.5 fill-current" viewBox="0 0 56.966 56.966">
                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23
                s-23,10.318-23,23s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208
                c0.571,0.593,1.339,0.92,2.162,0.92c0.779,0,1.518-0.297,2.079-0.837
                C56.255,54.982,56.293,53.08,55.146,51.887z
                M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17s-17-7.626-17-17S14.61,6,23.984,6z" />
              </svg>
            </button>
          </div>

          <button id="nav" type="button" class="flex items-center px-3 py-2 border rounded text-gray-600 border-gray-300 hover:text-gray-900 hover:border-gray-500">
            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Full nav menu (toggle for small screens) -->
      <div id="menu" class="menu hidden w-full lg:block flex-grow lg:flex lg:items-center lg:w-auto lg:px-3 px-6">
        <div class="text-md font-medium text-gray-700 lg:flex-grow">
          <a href="#" class="block mt-4 lg:inline-block lg:mt-0 hover:bg-gray-100 px-4 py-2 rounded transition">Menu 1</a>
          <a href="#" class="block mt-4 lg:inline-block lg:mt-0 hover:bg-gray-100 px-4 py-2 rounded transition">Menu 2</a>
          <a href="#" class="block mt-4 lg:inline-block lg:mt-0 hover:bg-gray-100 px-4 py-2 rounded transition">Menu 3</a>
        </div>

        <!-- Large screen search bar -->
        <div class="relative mx-auto text-gray-700 hidden lg:block">
          <input
            class="border border-gray-300 bg-white h-10 pl-3 pr-10 rounded-lg text-sm focus:outline-none focus:border-gray-400"
            type="search" name="search" placeholder="Search" />
          <button type="submit" class="absolute right-0 top-0 mt-3 mr-3">
            <svg class="text-gray-500 h-4 w-4 fill-current" viewBox="0 0 56.966 56.966">
              <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23
                s-23,10.318-23,23s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208
                c0.571,0.593,1.339,0.92,2.162,0.92c0.779,0,1.518-0.297,2.079-0.837
                C56.255,54.982,56.293,53.08,55.146,51.887z
                M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17s-17-7.626-17-17S14.61,6,23.984,6z" />
            </svg>
          </button>
        </div>
      </div>
    </nav>
  `;

  document.getElementById('nav').addEventListener('click', () => {
    document.getElementById('menu').classList.toggle('hidden');
  });
}
