<template>
  <div class="max-w-screen-xl mx-auto">
    <div class="pb-4 flex justify-center">
      <secondaryButton
        class="mx-4"
        @click.prevent="voltar"
        v-text="'Voltar'"
      />
      <h5
        class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center"
        v-text="'Perfil: ' + role.name.toUpperCase()"
      />
      <div class="text-center mx-2">
        <Checkbox
          :id="'ability_' + 4"
          v-model:checked="form.user_delete"
          @change="activeAbility(role.id, 4)"
        />
        <label
          :for="'ability_' + 4"
          class="pl-1 dark:text-white"
          v-text="'Administrador'"
        />
      </div>
    </div>
    <div class="flex flex-wrap gap-3 px-4">
      <div
        class="pl-4 max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
      >
        <h5
          class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center"
          v-text="'Usuários'"
        />
        <p class="py-1">
          <Checkbox
            :id="'ability_' + 1"
            v-model:checked="form.user_create"
            @click="activeAbility(role.id, 1)"
          />
          <label
            :for="'ability_' + 1"
            class="pl-3 dark:text-white"
            v-text="'Criar'"
          />
        </p>
        <p class="py-1">
          <Checkbox
            :id="'ability_' + 2"
            v-model:checked="form.user_read"
            @click="activeAbility(role.id, 2)"
          />
          <label
            :for="'ability_' + 2"
            class="pl-3 dark:text-white"
            v-text="'Ver'"
          />
        </p>
        <p class="py-1">
          <Checkbox
            :id="'ability_' + 3"
            v-model:checked="form.user_update"
            @click="activeAbility(role.id, 3)"
          />
          <label
            :for="'ability_' + 3"
            class="pl-3 dark:text-white"
            v-text="'Editar'"
          />
        </p>
        <p class="py-1">
          <Checkbox
            :id="'ability_' + 4"
            v-model:checked="form.user_delete"
            @change="activeAbility(role.id, 4)"
          />
          <label
            :for="'ability_' + 4"
            class="pl-3 dark:text-white"
            v-text="'Deletar'"
          />
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue';
  defineOptions({ layout: Layout });

  const form = useForm({
    user_create: false,
    user_read: false,
    user_update: false,
    user_delete: false,
    role_admin: false,
  });

  const props = defineProps({
    role: Object,
  });

  function activeAbility(role_id, ability_id) {
    router.post(route('ability.create.delete', [role_id, ability_id]));
  }

  onMounted(() => {
    props.role.abilities.forEach((ability) => {
      if (form[ability.name] !== undefined) {
        form[ability.name] = true;
      }
    });
  });
  const voltar = () => {
    router.get(route('role.management'));
  };
</script>
