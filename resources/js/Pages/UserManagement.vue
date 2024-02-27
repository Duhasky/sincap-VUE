<template>
  <!-- Modal -->
  <Modal :show="modal">
    <template v-if="deleteUserModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          Tem certeza de que deseja excluir esta conta? <br />
          ({{ userNameBeingAction }})
        </h2>
        <div class="mt-6 flex justify-end">
          <form @submit.prevent="deleteUser(userIdBeingAction)">
            <SecondaryButton
              class="mx-2"
              @click.prevent="deleteUserModalShow"
              v-html="'Cancelar'"
            />
            <DangerButton
              type="submit"
              :class="{ 'opacity-25': form.processing }"
              v-html="'Deletar'"
            />
          </form>
        </div>
      </div>
    </template>
    <template v-if="newUserModal">
      <div class="p-6">
        <h2
          class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-4"
          v-html="'Novo Usuário'"
        />

        <form @submit.prevent="newUserSave">
          <div>
            <InputLabel
              for="name"
              value="Nome"
            />
            <TextInput
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              autocomplete="name"
            />
            <InputError
              class="mt-2"
              :message="form.errors.name"
            />
          </div>

          <div class="mt-4">
            <InputLabel
              for="email"
              value="Email"
            />
            <TextInput
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
              autocomplete="username"
            />
            <InputError
              class="mt-2"
              :message="form.errors.email"
            />
          </div>

          <div class="mt-4">
            <InputLabel
              for="password"
              value="Senha"
            />
            <TextInput
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password"
              autocomplete="new-password"
            />
            <InputError
              class="mt-2"
              :message="form.errors.password"
            />
          </div>

          <div class="mt-4">
            <InputLabel
              for="password_confirmation"
              value="Confirmar Senha"
            />
            <TextInput
              id="password_confirmation"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password_confirmation"
              autocomplete="new-password"
            />
            <InputError
              class="mt-2"
              :message="form.errors.password_confirmation"
            />
          </div>

          <div class="flex items-center justify-end mt-4">
            <DangerButton
              @click.prevent="newUserModalShow"
              v-html="'Cancelar'"
            />
            <PrimaryButton
              type="submit"
              class="mx-2"
              :class="{ 'opacity-25': form.processing }"
              v-html="'Salvar'"
            />
          </div>
        </form>
      </div>
    </template>
  </Modal>

  <!-- Content -->
  <div class="flex flex-row items-center pb-4">
    <!-- Form de pesquisa -->
    <div class="w-full lg:w-3/5">
      <form class="flex items-center">
        <div class="relative w-full">
          <label
            for="nameSearch"
            class="sr-only"
            v-html="'Pesquisar'"
          />
          <TextInput
            class="block w-full"
            id="nameSearch"
            type="search"
            v-model="nameSearch"
            autocomplete="current-name"
            placeholder="Pesquisar por nome"
          />
        </div>
      </form>
    </div>
    <!-- Form de pesquisa -->
    <div v-if="auth.abilities.includes('user_create')">
      <PrimaryButton
        @click.prevent="newUserModalShow"
        class="ml-2 justify-end align-middle"
        v-html="'Novo'"
      />
    </div>
  </div>
  <div class="bg-white dark:bg-gray-800 h-full w-full">
    <!-- Tabela -->
    <div
      class="w-full max-w-full overflow-x-auto rounded-md border dark:border-gray-700"
    >
      <table
        class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto border-collapse"
      >
        <thead
          class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white"
        >
          <tr>
            <th
              v-for="tHead in tableHeader"
              scope="col"
              class="px-2 py-3"
              v-html="tHead"
            />
          </tr>
        </thead>
        <tbody>
          <template v-for="user in users.data">
            <tr class="border-b dark:border-gray-700">
              <th
                class="px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                <div
                  class="text-base font-semibold"
                  v-html="user.name"
                />
                <div
                  class="font-normal text-gray-500"
                  v-html="user.email"
                />
              </th>
              <td class="px-2">
                <template v-for="role in user.roles">
                  <div v-text="role.name" />
                </template>
              </td>
              <td class="px-2 align-middle">
                <Toggle
                  v-if="auth.abilities.includes('user_update')"
                  @change="activeUser(user.id)"
                  :active="user.is_active"
                />
                <span
                  class="text-base font-semibold text-white"
                  v-else
                  >{{ user.is_active ? 'Ativo' : 'Inativo' }}</span
                >
              </td>
              <td class="pr-4 py-3">
                <div class="flex flex-row gap-2">
                  <Link
                    v-if="auth.abilities.includes('user_update')"
                    :href="route('user.edit', user.id)"
                  >
                    <i-bxs-edit class="text-2xl flex text-yellow-600" />
                  </Link>
                  <button
                    @click="confirmUserDeletion(user.id, user.name)"
                    v-if="auth.abilities.includes('user_delete')"
                  >
                    <i-ic-outline-delete class="text-2xl flex text-red-600" />
                  </button>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    <!-- Paginação -->
    <div v-if="!shouldHidePagination">
      <Pagination :data="users" />
    </div>
  </div>
</template>

<script setup>
  import debounce from 'lodash/debounce';
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  defineOptions({ layout: Layout });

  const auth = usePage().props.auth;

  const tableHeader = ['Nome', 'Role', 'Status', 'Ações'];
  const modal = ref(false);
  const newUserModal = ref(false);
  const deleteUserModal = ref(false);
  const userIdBeingAction = ref(null);
  const userNameBeingAction = ref(null);

  const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });

  const props = defineProps({
    users: Object,
    active: Number,
    filters: Object,
  });

  const shouldHidePagination = computed(
    () => !props.users.prev_page_url && !props.users.next_page_url,
  );
  const nameSearch = ref(props.filters.search || '');

  const activeUser = (id) => form.put(route('user.active', [id]));

  const modalOpenClose = () => {
    modal.value = !modal.value;
  };

  const newUserModalShow = () => {
    modalOpenClose();
    form.reset();
    newUserModal.value = !newUserModal.value;
  };

  const newUserSave = () => {
    form.post(route('user.create'), {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        newUserModalShow();
      },
    });
  };

  const deleteUserModalShow = () => {
    modalOpenClose();
    deleteUserModal.value = !deleteUserModal.value;
  };

  const confirmUserDeletion = (id, name) => {
    deleteUserModalShow();
    userIdBeingAction.value = id;
    userNameBeingAction.value = name;
  };
  const deleteUser = (id) => {
    form.delete(route('user.delete', id), {
      preserveScroll: true,
      onSuccess: () => {
        deleteUserModalShow();
      },
    });
  };

  watch(
    nameSearch,
    debounce(function (value) {
      router.get(
        route('user.management'),
        { search: value },
        { preserveState: true, replace: true },
      );
    }, 500),
  );
</script>
