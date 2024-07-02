<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Windmill Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{url_for('static', filename='css/tailwind.output.css')}}" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="{{url_for('static', filename='js/init-alpine.js')}}"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    

    
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="{{url_for('static', filename='js/charts-lines.js')}}" defer></script>
    <script src="{{url_for('static', filename='js/charts-pie.js')}}" defer></script>
    <!-- Estilos de DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<style>
  /* Estilos para la tabla */
  .custom-table {
    border-collapse: collapse;
    width: 100%;
  }

  table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 0px solid rgb(17, 17, 17);
}
table.dataTable.no-footer {
    border-bottom: 0px solid #111;
}
  
  .custom-table th,
  .custom-table td {
    padding: 8px;
    text-align: left;
    border-bottom: none; /* Elimina el borde inferior */
  }
  
  .custom-table th {
    background-color: #f2f2f2;
    font-weight: bold;
  }

  


  </style>

  </head>



  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
            Dashboard
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{ url_for('admin_home') }}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Dashboard</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ url_for('admin_RegistroPacientes') }}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Analisis</span>
              </a>
            </li>
          </ul>
        </div>
      </aside>
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
            Dashboard
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="index.html"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Dashboard</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ url_for('admin_RegistroPacientes') }}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Analisis de Datos</span>
              </a>
            </li>
            
            
            
            
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ url_for('admin_GestionarPacientes') }}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                <span class="ml-4">Gestionar Pacientes</span>
              </a>
            </li>
            
          </ul>
          <div class="px-6 my-6">
            <button
              class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
              Create account
              <span class="ml-2" aria-hidden="true">+</span>
            </button>
          </div>
        </div>
      </aside>
      <div class="flex flex-col flex-1 w-full">
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
          <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
            <div class="flex justify-center flex-1 lg:mr-32">
              <div
                class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
              >
                <div class="absolute inset-y-0 flex items-center pl-2">
                  <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <input
                  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                  type="text"
                  placeholder="Buscar Elemento"
                  aria-label="Search"
                />
              </div>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              <li class="flex">
                <button
                  class="rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleTheme"
                  aria-label="Toggle color mode"
                >
                  <template x-if="!dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                      ></path>
                    </svg>
                  </template>
                  <template x-if="dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </template>
                </button>
              </li>
              <!-- Notifications menu -->
              <li class="relative">
                <button
                  class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleNotificationsMenu"
                  @keydown.escape="closeNotificationsMenu"
                  aria-label="Notifications"
                  aria-haspopup="true"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                    ></path>
                  </svg>
                  <!-- Notification badge -->
                  <span
                    aria-hidden="true"
                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"
                  ></span>
                </button>
                <template x-if="isNotificationsMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeNotificationsMenu"
                    @keydown.escape="closeNotificationsMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <span>Mensajes</span>
                        <span
                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                        >
                          10
                        </span>
                      </a>
                    </li>
                    
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <span>Alertas</span>
                      </a>
                    </li>
                  </ul>
                </template>
              </li>
              <!-- Profile menu -->
              <li class="relative">
                <button
                  class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                  @click="toggleProfileMenu"
                  @keydown.escape="closeProfileMenu"
                  aria-label="Account"
                  aria-haspopup="true"
                >
                  <img
                    class="object-cover w-8 h-8 rounded-full"
                    src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                    alt=""
                    aria-hidden="true"
                  />
                </button>
                <template x-if="isProfileMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeProfileMenu"
                    @keydown.escape="closeProfileMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                    aria-label="submenu"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          ></path>
                        </svg>
                        <span>Perfil</span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                          ></path>
                          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="/logout"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        <span>Cerrar Sesion</span>
                      </a>
                    </li>
                  </ul>
                </template>
              </li>
            </ul>
          </div>
        </header>
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Dashboard
            </h2>
            
            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    Total de Usuarios
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="userCount"
                  >
                    1
                  </p>
                </div>
              </div>
             
              
              
              
            </div>








            <!-- New Table -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Usuarios 
            </h4>
            
            <!-- Botón para abrir el modal -->
            <!-- Agrega SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

<!-- Botón para abrir el modal -->

<br>
<style>
  .custom-button {
    padding: 8px 16px;
    background-color: #007BFF; /* Color de fondo */
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    font-size: 14px;
    transition: background-color 0.3s;
    max-width: 120px; /* Establece un ancho máximo */
  }

  .custom-button:hover {
    background-color: #0056b3; /* Color de fondo en hover */
  }
</style>

<button id="openModalBtn" onclick="addUser()" class="custom-button btn btn-primary">Agregar</button>
<br>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
  <script>
   

   let globalUsuarios = [];
    function addUser() {
            Swal.fire({
                title: "Registrar Usuario",
                html: `
                    <input id="nombreUsuario" class="swal2-input" placeholder="Nombre de Usuario" required>
                    <input id="nombre" class="swal2-input" placeholder="Nombre" required>
                    <input id="apellido" class="swal2-input" placeholder="Apellido" required>
                    <input id="dni" class="swal2-input" placeholder="DNI" required>
                    <input id="correoElectronico" class="swal2-input" placeholder="Correo Electrónico" required>
                    <input id="contrasenaHash" class="swal2-input" type="password" placeholder="Contraseña" required>
                    <input id="fechaRegistro" class="swal2-input" type="datetime-local" placeholder="Fecha de Registro" required>
                    <input id="roles" class="swal2-input" placeholder="Roles (Separados por comas)" required>
                    <select id="activo" class="swal2-input">
                        <option value="true">Activo</option>
                        <option value="false">Inactivo</option>
                    </select>
                `,
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Registrar",
                cancelButtonText: "Cancelar",
                preConfirm: () => {
                    const nombreUsuario = document.getElementById("nombreUsuario").value;
                    const nombre = document.getElementById("nombre").value;
                    const apellido = document.getElementById("apellido").value;
                    const dni = document.getElementById("dni").value;
                    const correoElectronico = document.getElementById("correoElectronico").value;
                    const contrasenaHash = document.getElementById("contrasenaHash").value;
                    const fechaRegistro = document.getElementById("fechaRegistro").value;
                    const roles = document.getElementById("roles").value.split(",").map((role) => role.trim());
                    const activoElement = document.getElementById("activo");
                    const activo = activoElement.value === "true";

                    return {
                        nombreUsuario,
                        nombre,
                        apellido,
                        dni,
                        correoElectronico,
                        contrasenaHash,
                        fechaRegistro,
                        roles,
                        activo,
                    };
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const userData = result.value;
                    fetch("/api/usuarios2", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(userData),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        Swal.fire("¡Registro exitoso!", data.mensaje, "success");
                        console.log(data.usuarios)
                        globalUsuarios = data.usuarios;
                        renderTable(data.usuarios);
                        
                    })
                    .catch((error) => {
                        Swal.fire("¡Error!", error.message, "error");
                    });
                }
            });
        }
  </script>

            
            


<div class="w-full overflow-hidden rounded-lg shadow-xs">
  <div class="w-full overflow-x-auto">
    <table id="myTable" class="w-full whitespace-no-wrap datatable">
      <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
          <th class="px-4 py-3">Nombre de Usuario</th>
          <th class="px-4 py-3">Nombre</th>
          <th class="px-4 py-3">Apellido</th>
          <th class="px-4 py-3">DNI</th>
          <th class="px-4 py-3">Correo Electrónico</th>
          <th class="px-4 py-3">Fecha de Registro</th>
          <th class="px-4 py-3">Roles</th>
          <th class="px-4 py-3">Estado</th>
          <th class="px-4 py-3">Acciones</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        {% for detalle in detalles_list %}

        <tr class="text-gray-700 dark:text-gray-400">
          <td class="px-4 py-3">
            <div class="flex items-center text-sm">
              <!-- Avatar with inset shadow -->
              <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                <img class="object-cover w-full h-full rounded-full" src="https://img.freepik.com/vector-premium/icono-circulo-usuario-anonimo-ilustracion-vector-estilo-plano-sombra_520826-1931.jpg" alt="" loading="lazy" />
                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
              </div>
              <div>
                <p class="font-semibold">{{ detalle.nombreUsuario }}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                  Usuario
                </p>
              </div>
            </div>
          </td>
          
          <td class="px-4 py-3">
            {{ detalle.nombre }}
          </td>
          <td class="px-4 py-3">
            {{ detalle.apellido }}
          </td>
          <td class="px-4 py-3">
            {{ detalle.dni }}
          </td>
          <td class="px-4 py-3">
            {{ detalle.correoElectronico }}
          </td>
          <td class="px-4 py-3">
            {{ detalle.fechaRegistro }}
          </td>
          <td class="px-4 py-3">
            {{ detalle.roles | join(", ") }}
          </td>
          <td class="px-4 py-3 text-xs">
            <span class="px-2 py-1 font-semibold leading-tight
              {% if detalle.activo %}
                text-blue-700 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-700
              {% else %}
                text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700
              {% endif %}">
              {{ "Activo" if detalle.activo else "Inactivo" }}
            </span>
          </td>
          <td class="px-4 py-3">
            <div class="flex items-center space-x-4 text-sm">
              <button id="editButton" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
        aria-label="Edit"
        data-document-id="{{ detalle._id }}"
        onclick="showDocumentId(this)">
    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
    </svg>
</button>
              <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                aria-label="Delete"
                data-document-id="{{ detalle._id }}"
                onclick="eliminarDocumento(this)">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
              </button>
            </div>
          </td>
        </tr>
        {% endfor %}
      </tbody>
    </table>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<script>
  // Convertimos el JSON a un objeto JavaScript en el lado del cliente
  

  function formatDate(dateString) {
      const date = new Date(dateString);
      const year = date.getFullYear();
      const month = ('0' + (date.getMonth() + 1)).slice(-2);
      const day = ('0' + date.getDate()).slice(-2);
      const hours = ('0' + date.getHours()).slice(-2);
      const minutes = ('0' + date.getMinutes()).slice(-2);
      return `${year}-${month}-${day}T${hours}:${minutes}`;
  }

  function showDocumentId(button) {
            const documentId = button.getAttribute("data-document-id");
            
            const documento = globalUsuarios.find(detalle => detalle._id.$oid === documentId) || {};
            

            const formattedDate = documento.fechaRegistro ? formatDate(documento.fechaRegistro) : '';

            Swal.fire({
                title: documentId ? "Editar Detalles del Documento" : "Registrar Usuario",
                html: `
                    <input id="nombreUsuario" class="swal2-input" placeholder="Nombre de Usuario" value="${documento.nombreUsuario || ''}" required>
                    <input id="nombre" class="swal2-input" placeholder="Nombre" value="${documento.nombre || ''}" required>
                    <input id="apellido" class="swal2-input" placeholder="Apellido" value="${documento.apellido || ''}" required>
                    <input id="dni" class="swal2-input" placeholder="DNI" value="${documento.dni || ''}" required>
                    <input id="correoElectronico" class="swal2-input" placeholder="Correo Electrónico" value="${documento.correoElectronico || ''}" required>
                    <input id="contrasenaHash" class="swal2-input" type="password" placeholder="Contraseña" value="${documento.contrasenaHash || ''}" required>
                    <input id="fechaRegistro" class="swal2-input" type="datetime-local" placeholder="Fecha de Registro" value="${formattedDate}" required>
                    <input id="roles" class="swal2-input" placeholder="Roles (Separados por comas)" value="${documento.roles ? documento.roles.join(', ') : ''}" required>
                    <select id="activo" class="swal2-input">
                        <option value="true" ${documento.activo ? 'selected' : ''}>Activo</option>
                        <option value="false" ${!documento.activo ? 'selected' : ''}>Inactivo</option>
                    </select>
                `,
                icon: "info",
                showCancelButton: true,
                confirmButtonText: documentId ? "Guardar" : "Registrar",
                cancelButtonText: "Cancelar",
                preConfirm: () => {
                    const nombreUsuario = document.getElementById("nombreUsuario").value;
                    const nombre = document.getElementById("nombre").value;
                    const apellido = document.getElementById("apellido").value;
                    const dni = document.getElementById("dni").value;
                    const correoElectronico = document.getElementById("correoElectronico").value;
                    const contrasenaHash = document.getElementById("contrasenaHash").value;
                    const fechaRegistro = document.getElementById("fechaRegistro").value;
                    const roles = document.getElementById("roles").value.split(",").map((role) => role.trim());
                    const activoElement = document.getElementById("activo");
                    const activo = activoElement.value === "true";

                    

                    return {
                        _id: documentId ? documento._id.$oid : undefined,
                        nombreUsuario,
                        nombre,
                        apellido,
                        dni,
                        correoElectronico,
                        contrasenaHash,
                        fechaRegistro,
                        roles,
                        activo,
                    };
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const userData = result.value;
                    console.log(JSON.stringify(userData)); // Depurar los datos capturados
                    fetch("/api/usuarios2", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(userData),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        Swal.fire("¡Operación exitosa!", data.mensaje, "success");
                        console.log(data.usuarios)
                        globalUsuarios = data.usuarios;

                        renderTable(data.usuarios);
                    })
                    .catch((error) => {
                        Swal.fire("¡Error!", error.message, "error");
                    });
                }
            });
        }


        function renderTable(users) {
          const userCount = users.length;
          document.getElementById('userCount').textContent = userCount;
          const tableBody = document.querySelector('tbody');
          tableBody.innerHTML = '';
          users.forEach(detalle => {
              const row = document.createElement('tr');
              row.className = 'text-gray-700 dark:text-gray-400';
              row.innerHTML = `
                  <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                          <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                              <img class="object-cover w-full h-full rounded-full" src="https://img.freepik.com/vector-premium/icono-circulo-usuario-anonimo-ilustracion-vector-estilo-plano-sombra_520826-1931.jpg" alt="" loading="lazy" />
                              <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                          </div>
                          <div>
                              <p class="font-semibold">${detalle.nombreUsuario}</p>
                              <p class="text-xs text-gray-600 dark:text-gray-400">Usuario</p>
                          </div>
                      </div>
                  </td>
                  <td class="px-4 py-3">${detalle.nombre}</td>
                  <td class="px-4 py-3">${detalle.apellido}</td>
                  <td class="px-4 py-3">${detalle.dni}</td>
                  <td class="px-4 py-3">${detalle.correoElectronico}</td>
                  <td class="px-4 py-3">${detalle.fechaRegistro}</td>
                  <td class="px-4 py-3">${detalle.roles.join(', ')}</td>
                  <td class="px-4 py-3 text-xs">
                      <span class="px-2 py-1 font-semibold leading-tight ${detalle.activo ? 'text-blue-700 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-700' : 'text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700'}">
                          ${detalle.activo ? 'Activo' : 'Inactivo'}
                      </span>
                  </td>
                  <td class="px-4 py-3">
                      <div class="flex items-center space-x-4 text-sm">
                          <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                              aria-label="Edit"
                              data-document-id="${detalle._id.$oid}"
                              onclick="showDocumentId(this)">
                              <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                              </svg>
                          </button>

                          <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Delete"
                            data-document-id="${detalle._id.$oid}"
                            onclick="eliminarDocumento(this)">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                          </button>

                      </div>
                  </td>
              `;
            tableBody.appendChild(row);
        });
    }
  
</script>








  












<script>
 



  // Otras funciones (guardarCambios, cerrarModal) permanecen sin cambios
</script>
         
        

            <script>
              $(document).ready(function() {
                const detallesListJson = '{{ detalles_list_json | safe }}';
  const detallesList = JSON.parse(detallesListJson);
                const userCount = detallesList.length;
        document.getElementById('userCount').textContent = userCount;

                $('#myTable').DataTable({
                  lengthChange: false, // Deshabilita la opción de cambiar la cantidad de registros mostrados por página
                  searching: false, // Deshabilita la búsqueda en la tabla
                  language: {
                    info: "Mostrando _END_ de _TOTAL_ registros", // Cambia el texto de información de paginación
      infoEmpty: "Mostrando 0 registros", // Cambia el texto cuando no hay registros
      infoFiltered: "(filtrados de _MAX_ registros en total)",
                    paginate: {
                      first: "Primero",
                      last: "Último",
                      next: "Siguiente",
                      previous: "Anterior"
                      
                    }
                  }
                });
              });
            </script>
            
            

            




           
               
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
