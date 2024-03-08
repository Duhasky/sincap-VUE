<template>
  <div>
    <nav
      class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50"
    >
      <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">
          <button
            aria-controls="drawer-navigation"
            class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            @click="toggleDrawer"
          >
            <i-ph-list-dashes-bold
              aria-hidden="true"
              class="w-6 h-6"
              fill="currentColor"
            />

            <svg
              aria-hidden="true"
              class="hidden w-6 h-6"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
              ></path>
            </svg>
            <span class="sr-only">Abrir Menu</span>
          </button>

          <Link
            :href="route('home')"
            class="flex items-center justify-between mr-4"
          >
            <ApplicationLogo
              class="mr-3 h-8 block w-auto fill-current text-gray-800 dark:text-gray-200"
            />
            <span
              class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
              >Actrum</span
            >
          </Link>
        </div>
      </div>
    </nav>

    <!-- Sidebar -->

    <aside
      class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
      aria-label="Sidenav"
      id="drawer-navigation"
      ref="drawerNavigationRef"
    >
      <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-2">
          <li>
            <Link
              :href="route('dashboard')"
              class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            >
              <i-ic-round-dashboard-customize
                class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                aria-hidden="true"
                fill="currentColor"
              />
              <span class="ml-3">Painel de Controle</span>
            </Link>
          </li>

          <!-- Persons options -->
          <li>
            <button
              type="button"
              class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
              @click.prevent="togglePersonDropdown"
            >
              <i-mdi-pirate
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
              />
              <span
                class="flex-1 ml-3 text-left whitespace-nowrap"
                v-text="'Gestão de Pessoas'"
              />
              <i-material-symbols-arrow-downward-rounded
                aria-hidden="true"
                class="w-6 h-6"
                :class="{ 'transform rotate-180': showingPersonDropdown }"
                fill="currentColor"
              />
            </button>
            <ul
              id="dropdown-pages"
              v-show="showingPersonDropdown"
              class="py-2 space-y-2"
            >
              <li
                class="pl-4"
                v-if="auth.abilities.includes('person_read')"
              >
                <Link
                  :href="route('person.management')"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-500 group"
                >
                  <i-game-icons:pirate-flag
                    class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true"
                    fill="currentColor"
                  />
                  <span class="ml-3">TAN</span>
                </Link>
              </li>
              <li
                class="pl-4"
                v-if="auth.abilities.includes('city_read')"
              >
                <Link
                  :href="route('city.management')"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-500 group"
                >
                  <i-arcticons:city-transit
                    class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true"
                    fill="currentColor"
                  />
                  <span class="ml-3">Cidades</span>
                </Link>
              </li>
              <li
                v-if="auth.abilities.includes('group_read')"
                class="pl-4"
              >
                <Link
                  :href="route('group.management')"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-500 group"
                >
                  <i-fluent-emoji-high-contrast:pirate-flag
                    class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor"
                    aria-hidden="true"
                  />
                  <span class="ml-3">Facções</span>
                </Link>
              </li>
            </ul>
          </li>

          <li>
            <button
              type="button"
              class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
              @click.prevent="toggleUserDropdown"
            >
              <i-fa6-solid-users
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
              />
              <span
                class="flex-1 ml-3 text-left whitespace-nowrap"
                v-text="'Gestão de Equipe'"
              />
              <i-material-symbols-arrow-downward-rounded
                aria-hidden="true"
                class="w-6 h-6"
                :class="{ 'transform rotate-180': showingUserDropdown }"
                fill="currentColor"
              />
            </button>
            <ul
              id="dropdown-pages"
              v-show="showingUserDropdown"
              class="py-2 space-y-2"
            >
              <li
                class="pl-4"
                v-if="auth.abilities.includes('user_read')"
              >
                <Link
                  :href="route('user.management')"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-500 group"
                >
                  <i-ph-users-fill
                    class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true"
                    fill="currentColor"
                  />
                  <span class="ml-3">Usuários</span>
                </Link>
              </li>
              <li
                v-if="auth.abilities.includes('role_admin')"
                class="pl-4"
              >
                <Link
                  :href="route('role.management')"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-500 group"
                >
                  <i-mdi-key
                    class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="currentColor"
                    aria-hidden="true"
                  />
                  <span class="ml-3">Permissões</span>
                </Link>
              </li>
            </ul>
          </li>
        </ul>
        <ul
          class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700"
        >
          <li>
            <div
              class="ml-3 flex items-center p-2 font-medium text-base text-gray-800 dark:text-gray-200"
              v-text="auth.user.name.toUpperCase()"
            />
            <div
              class="ml-3 flex items-center p-2 font-medium text-sm text-gray-500"
              v-text="auth.user.email"
            />
          </li>
          <li>
            <Link
              :href="route('profile.edit')"
              class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group"
            >
              <span class="ml-3">Perfil</span>
            </Link>
          </li>
          <li>
            <button
              @click="sair"
              class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            >
              <span class="ml-3">Sair</span>
            </button>
          </li>
        </ul>
      </div>
    </aside>
  </div>
</template>
<script setup>
  const auth = usePage().props.auth;

  const sair = () => {
    router.post(route('logout'));
  };

  //abertura do menu haburguer
  const drawerNavigationRef = ref(null);

  const toggleDrawer = () => {
    if (drawerNavigationRef.value) {
      drawerNavigationRef.value.classList.toggle('md:translate-x-0');
      drawerNavigationRef.value.classList.toggle('-translate-x-full');
    }
  };

  //abertura das opções de usuário
  const showingUserDropdown = ref(false);

  const toggleUserDropdown = () => {
    showingUserDropdown.value = !showingUserDropdown.value;
  };

  //abertura das opções de usuário
  const showingPersonDropdown = ref(false);

  const togglePersonDropdown = () => {
    showingPersonDropdown.value = !showingPersonDropdown.value;
  };
</script>
<style scoped>
  .transform {
    transition: transform 0.3s ease;
  }
</style>
