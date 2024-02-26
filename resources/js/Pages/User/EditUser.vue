<template>
  <div
    class="mx-auto max-w-screen-xl p-4 lg:p-12 bg-white dark:bg-gray-800 rounded-2xl m-4 w-full"
  >
    <div class="p-2">
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 pb-4">
        Editar Usuário
      </h2>
      <form @submit.prevent="form.put(route('user.update', form.id))">
        <div class="relative flex flex-row gap-2">
          <TextInput
            class="w-full"
            type="text"
            id="name"
            v-model="form.name"
          />
          <label
            for="name"
            class="absolute text-sm text-gray-500 dark:text-white duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1"
            v-text="'Nome'"
          />
          <InputError
            class="mt-2"
            :message="form.errors.name"
          />
        </div>

        <div class="relative flex flex-row mt-4">
          <TextInput
            class="w-full"
            type="text"
            id="email"
            v-model="form.email"
          />
          <label
            for="email"
            class="absolute text-sm text-gray-500 dark:text-white duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1"
            v-text="'E-Mail'"
          />
          <InputError
            class="mt-2"
            :message="form.errors.email"
          />
        </div>

        <div class="flex items-center justify-end mt-4">
          <SecondaryButton
            @click.prevent="cancel"
            v-html="'Voltar'"
          />
          <PrimaryButton
            type="submit"
            class="mx-2"
            :class="{ 'opacity-25': form.processing }"
            v-html="'Editar'"
          />
        </div>
      </form>
      <section>
        <div class="pt-3 w-full">
          <div
            class="pl-4 p-4 bg-white border-4 border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
          >
            <h5
              class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center border-b-2"
              v-text="'Funções'"
            />
            <div class="flex flex-wrap gap-3">
              <template v-for="role in roles">
                <div>
                  <Checkbox
                    :id="'role_' + role.id"
                    :checked="statusRoleUser(role.id, user)"
                    @change="userRole(user.id, role.id)"
                  />
                  <label
                    :for="'role_' + role.id"
                    class="pl-2 dark:text-white"
                    v-text="role.name.toUpperCase()"
                  />
                </div>
              </template>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  defineOptions({ layout: Layout });
  const props = defineProps({
    user: Object,
    roles: Object,
  });

  const form = useForm(props.user);

  const cancel = () => router.get(route('user.management'));

  const statusRoleUser = (role_id, user) => {
    return user.roles.some((e) => e.id === role_id);
  };

  const userRole = (user_id, role_id) => {
    router.post(route('role.user.create.delete', [user_id, role_id]));
  };
</script>
