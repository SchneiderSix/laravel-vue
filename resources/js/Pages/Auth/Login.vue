<script setup>
import { useForm } from '@inertiajs/vue3';
import CustomInput from '../../Components/CustomInputText.vue';

const form = useForm({
  email: null,
  password: null,
  remember: null
});

const submit = () => {
  form.post(route('login'), {
    onError: () => {
      form.reset('password', 'remember');

      // Set input errors in spanish
      for (const field in form.errors) {
        const spanish_field = field.includes('password') ? 'contraseña' : field;
        const error = form.errors[field];
        if (error.includes('must not be greater than')) {
          form.errors[field] = 'El campo ' +spanish_field+ ' no puede tener mas de 255 caracteres.';
        } else if (error.includes('is required')) {
          form.errors[field] = 'El campo ' +spanish_field+ ' es necesario.';
        }
      }
    }
  });
};

</script>

<template>
  <Head title=" | Login"/>

  <h1 class="title">Logueate con tu cuenta</h1>

  <div class="items-center w-2/4 mx-auto">

    <form @submit.prevent="submit">

      <CustomInput
        name="Email"
        v-model="form.email"
        type="email"
        :messageHelper="form.errors.email"
      />

      <CustomInput
        name="Contraseña"
        v-model="form.password"
        type="password"
        :messageHelper="form.errors.password"
      />

      
      <div class="flex items-center justify-between p-1">
        <div class="flex space-x-3">
          <input id="remember" type="checkbox" v-model="form.remember">
          <label for="remember">Recuerdame</label>
        </div>
        <p class="mb-2">Puedes
        <a class="text-link" :href="route('register')">Registrarte</a>
      </p>
      </div>
      <div>
        <button class="primary-btn" :disabled="form.processing">
          Login
        </button>
      </div>
    </form>
  </div>
</template>
