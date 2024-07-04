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

    <link rel="stylesheet" href="{{url_for('static', filename='nuevoup.css')}}">

<script src="{{url_for('static', filename='script2.js')}}"></script>
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
              Datos Seleccionados:
            </h2>
            
            <div id="dataCards">
              <!-- Aquí se agregarán las tarjetas de datos dinámicamente con JavaScript -->
          </div>
          
          <script>
              // Supongamos que selected_row y all_data son los objetos JSON que obtienes desde el servidor
              var selectedRow = {{ selected_row | safe }};
              var dataCardsDiv = document.getElementById('dataCards');
          
              // Supongamos que titles es la lista de títulos que quieres mostrar
              var titles = [
                  "ORDEN_COMPRA", "CATALOGO", "TIPO_COMPRA", "RUC_ENTIDAD", "ENTIDAD",
                  "RUC_PROVEEDOR", "PROVEEDOR", "FECHA_COMPRA", "ESTADO_ORDEN",
                  "DEPARTAMENTO", "PROVINCIA", "DISTRITO", "NOMBRE", "MARCA",
                  "PRECIO_UNITARIO", "PRECIO_TOTAL", "anomalia_etiqueta"
              ];
          
              // Crear tarjetas de datos dinámicamente
              for (var i = 0; i < selectedRow.length; i++) {
                  var card = document.createElement('div');
                  card.className = 'data-card';
                  card.innerHTML = '<strong>' + titles[i] + ':</strong> ' + selectedRow[i];
                  dataCardsDiv.appendChild(card);
              }
          </script>
            <BR>


            

            <!-- New Table -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              PREDICION
            </h4>
            <p>Predicción: {{ prediction }}</p>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

<style>
  /* Estilo personalizado para el botón */
.custom-button {
    background-color: #4CAF50; /* Verde */
    border: none;
    color: white;
    padding: 10px 20px; /* Tamaño más pequeño */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px; /* Tamaño de fuente más pequeño */
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px; /* Bordes redondeados */
    width: 200px; /* Ancho del botón ajustado */
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.custom-button:hover {
    background-color: #45a049; /* Verde más oscuro al pasar el ratón */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Sombra */
}

.custom-button:active {
    background-color: #3e8e41; /* Verde aún más oscuro al hacer clic */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3) inset; /* Sombra interna al hacer clic */
    transform: translateY(2px); /* Efecto de botón presionado */
}


</style>
            <button id="openModalBtn" onclick="addAnomalia()" class="custom-button btn btn-primary">Agregar</button>

            
            <h2>ID Data JSON:</h2>
    <p>{{ id_datajson }}</p>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
              
              
              function addAnomalia() {
                var idDataJson = "{{ id_datajson }}";
                var selectedRow = {{ selected_row | safe }};
                console.log(idDataJson)
                  Swal.fire({
                    
                      title: "Registrar Anomalía",
                      html: `
                          <style>
                              .swal2-popup {
                                  width: 80% !important;
                                  max-width: none !important;
                              }
                              .swal2-content {
                                  display: flex;
                                  flex-direction: column;
                                  align-items: flex-start;
                                  width: 100%;
                              }
                              .form-group {
                                  width: 100%;
                                  margin-bottom: 15px;
                              }
                              .form-group label {
                                  font-weight: bold;
                                  margin-bottom: 5px;
                                  display: block;
                              }
                              .form-group input, .form-group select, .form-group textarea {
                                  width: 100%;
                                  padding: 8px;
                                  border: 1px solid #ccc;
                                  border-radius: 4px;
                                  box-sizing: border-box;
                              }
                              .form-group textarea {
                                  resize: vertical;
                                  height: 100px;
                              }
                              .form-row {
                                  display: flex;
                                  flex-wrap: wrap;
                                  justify-content: space-between;
                              }
                              .form-column {
                                  flex: 1;
                                  margin-right: 10px;
                              }
                              .form-column:last-child {
                                  margin-right: 0;
                              }
                          </style>
                          <div class="form-row">
                              <div class="form-column">
                                  <div class="form-group">
                                      <label for="prioridadAnomalia">Prioridad de la Anomalía:</label>
                                      <select id="prioridadAnomalia" required>
                                        <option value="" disabled selected>Seleccione una opción</option>
                                        <option value="baja">Baja</option>
                                        <option value="media">Media</option>
                                        <option value="alta">Alta</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-column">
                                  <div class="form-group">
                                      <label for="estadoAnomalia">Estado de Anomalia:</label>
                                      <select id="estadoAnomalia" disabled>
                                        <option value="pendiente" selected>Pendiente</option>
                                        <option value="en_revision">En Revisión</option>
                                        <option value="resuelta">Resuelta</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="asunto">Asunto (*):</label>
                              <input id="asunto" type="text" placeholder="Asunto del Trámite" required>
                          </div>
                          <div class="form-group">
                              <label for="contenidoSolicitud">Respetuosamente expongo: (*):</label>
                              <textarea id="contenidoSolicitud" placeholder="Contenido de solicitud"></textarea>
                          </div>
                      `,
                      showCancelButton: true,
                      confirmButtonText: "Registrar",
                      cancelButtonText: "Cancelar",
                      preConfirm: () => {
                        
                          const prioridadAnomalia = document.getElementById("prioridadAnomalia").value;
                          const estadoAnomalia = document.getElementById("estadoAnomalia").value;
                          const asunto = document.getElementById("asunto").value;
                          const contenidoSolicitud = document.getElementById("contenidoSolicitud").value;

                          var selectedRow = {{ selected_row | safe }};
                          var allData = {{ all_data | safe }};

                          function arraysEqual(arr1, arr2) {
                            if (arr1.length !== arr2.length) return false;
                            for (let i = 0; i < arr1.length; i++) {
                                if (String(arr1[i]).trim() !== String(arr2[i]).trim()) return false;
                            }
                            return true;
                          }

                          // Buscar el índice de la fila seleccionada en allData.data
                          let rowIndex = -1;
                          for (let i = 0; i < allData.data.length; i++) {
                              if (arraysEqual(allData.data[i], selectedRow)) {
                                  rowIndex = i;
                                  break;
                              }
                          }

                          // Mostrar el índice de la fila en la consola
                          if (rowIndex !== -1) {
                              console.log("Row Index:", rowIndex);

                              // Modificar la fila en el índice encontrado
                              allData.data[rowIndex][16] = 9;

                              // Mostrar el objeto allData modificado en la consola
                              console.log("Modified All Data:", allData);
                          } else {
                              console.error("Selected Row not found in All Data.");
                          }
            
                          return {
                              prioridadAnomalia,
                              estadoAnomalia,
                              asunto,
                              contenidoSolicitud,
                              idDataJson,
                              selectedRow,
                              allData,
                              rowIndex
                          };
                      },
                  }).then((result) => {
                      if (result.isConfirmed) {
                          const tramiteData = result.value;
                          fetch("/api/registrar_tramite", {
                              method: "POST",
                              headers: {
                                  "Content-Type": "application/json",
                              },
                              body: JSON.stringify(tramiteData),
                          })
                          .then((response) => response.json())
                          .then((data) => {
                              Swal.fire("¡Registro exitoso!", data.mensaje, "success");
                              // Actualiza la tabla o realiza las acciones necesarias con la respuesta
                          })
                          .catch((error) => {
                              Swal.fire("¡Error!", error.message, "error");
                          });
                      }
                  });
              }
            </script>


            







              
            <style>
                #myTable2 th,
                #myTable2 td {
                    font-size: 12px;
                    min-width: 100px;
                }
            
                .anomalia-cero td {
                    background-color: green; /* Color verde para anomalia_etiqueta igual a 0 */
                }
            
                .anomalia-uno td {
                    background-color: red; /* Color rojo para anomalia_etiqueta igual a 1 */
                }
            </style>
            
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Tabla de Anomalias
            </h2>
            <div class="results w-full overflow-hidden rounded-lg shadow-xs w-full overflow-x-auto dataTables_wrapper no-footer" id="myTable_wrapper">
                <!-- Aquí se mostrará la tabla -->
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="table" id="myTable2" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- Cabeceras de columna se agregarán dinámicamente aquí -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Agrega las filas y celdas aquí -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<!-- Resto del HTML ... -->

<!-- Agrega un contenedor div para el gráfico -->
<div id="scatterPlot" style="width: 100%; height: 400px;"></div>


<script>
    // Supongamos que selected_row y all_data son los objetos JSON que obtienes desde el servidor
    // Supongamos que selected_row y all_data son los objetos JSON que obtienes desde el servidor
var selectedRow = {{ selected_row | safe }};
var allData = {{ all_data | safe }};

try {
  console.log("Selected Row:", selectedRow);
        console.log("All Data:", allData);

        // Función para comparar dos arrays
        



    var table = $('#myTable2');

    // Limpiar la tabla antes de agregar filas
    table.find('thead tr').empty();
    table.find('tbody').empty();

    // Agregar las cabeceras de columna basadas en las claves del objeto "columns"
    var columns = allData.columns;
    for (var i = 0; i < columns.length; i++) {
        // Omitir la columna 'anomalia_etiqueta'
        if (columns[i] !== 'anomalia_etiqueta') {
            table.find('thead tr').append('<th>' + columns[i] + '</th>');
        }
    }

    // Filtrar las filas basadas en la categoría y marca seleccionadas
    var filteredRows = allData.data.filter(function (rowData) {
        return (
            rowData[13] === selectedRow[13] ||  // Ajusta el índice según la estructura real de tus datos
            rowData[14] === selectedRow[14]  // Ajusta el índice según la estructura real de tus datos
        );
    });

    // Agregar filas y celdas basadas en los datos JSON filtrados
    for (var i = 0; i < filteredRows.length; i++) {
        var rowHtml = '<tr class="';
        // Añadir clase CSS según el valor de anomalia_etiqueta
        rowHtml += filteredRows[i][16] === 0 ? "anomalia-cero" : "anomalia-uno";
        rowHtml += '">';
        for (var j = 0; j < filteredRows[i].length; j++) {
            // Omitir la columna 'anomalia_etiqueta'
            if (j !== 16) {
                rowHtml += '<td>' + filteredRows[i][j] + '</td>';
            }
        }
        rowHtml += '</tr>';
        table.find('tbody').append(rowHtml);
    }

    // Inicializar la tabla DataTable después de agregar las filas
    var dataTable = table.DataTable({
        select: true,
    });
    var indexAndPrecioUnitarioData = filteredRows.map(function (rowData, index) {
        return {
            index: index + 1, // Utiliza el índice actual + 1 como valor de "index"
            precio_unitario: rowData[14], // Asumiendo que el precio_unitario está en la posición [14]
        };
    });

    // Muestra los datos en la consola
    console.log(indexAndPrecioUnitarioData);
    // Configura los datos para el gráfico de puntos
    var scatterData = {
    x: indexAndPrecioUnitarioData.map(function (data) {
        return data.index;
    }),
    y: indexAndPrecioUnitarioData.map(function (data) {
        return data.precio_unitario;
    }),
    mode: 'markers+lines', // Cambiado a 'markers+lines'
    type: 'scatter'
};

        // Configura el diseño del gráfico de dispersión
        var scatterLayout = {
            title: 'Precio Unitario vs Índice',
            xaxis: {
                title: 'Índice'
            },
            yaxis: {
                title: 'Precio Unitario'
            },
            margin: {
                l: 50,
                r: 50,
                b: 50,
                t: 50
            }
        };

        // Crea el gráfico de dispersión
        Plotly.newPlot('scatterPlot', [scatterData], scatterLayout);

    } catch (error) {
        console.error("Error al procesar los datos:", error);
    }
</script>
            
            
            
            
            
            
        
          
            



            

        
            <!-- Resultados de la Carga de Archivos -->
            
            

           
            

           
            
            

            




            
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>