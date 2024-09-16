<script setup>
import { useForm } from '@inertiajs/vue3';
import CustomInput from '../../Components/CustomInputText.vue';

const form = useForm({
  name: null,
  email: null,
  password: null, 
  password_confirmation: null
});

const submit = () => {
  form.post(route('register'), {
    onError: () => {
      form.reset('password', 'password_confirmation');

      // Set input errors in spanish
      for (const field in form.errors) {
        const spanish_field = field == 'name' ? 'nombre' : field.includes('password') ? 'contraseña' : field;
        const error = form.errors[field];
        if (error.includes('must not be greater than')) {
          form.errors[field] = 'El campo ' +spanish_field+ ' no puede tener mas de 255 caracteres.';
        } else if (error.includes('is required')) {
          form.errors[field] = 'El campo ' +spanish_field+ ' es necesario.'
        } else if (error.includes('has already been taken')) {
          form.errors[field] = 'El ' +spanish_field+ ' ya ha sido registrado.'
        } else if (error.includes('field confirmation does not match')) {
          form.errors[field] = 'La ' +spanish_field+ ' debe ser identica en ambos campos.'
        }
      }
    }
  });
};

</script>

<template>
  <Head title=" | Registro"/>

  <h1 class="title">Registrar nuevo usuario</h1>

  <div class="items-center w-2/4 mx-auto">

    <form @submit.prevent="submit">

      <CustomInput
        name="nombre"
        v-model="form.name"
        type="text"
        :messageHelper="form.errors.name"
      />

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

      <CustomInput
        name="Repetir contraseña"
        v-model="form.password_confirmation"
        type="password"
      />

      <div>
        <p class="mb-2">Puedes
          <a class="text-link" :href="route('login')">Loguearte</a>
        </p>
        <button class="primary-btn" :disabled="form.processing">
          Registrarse
        </button>
      </div>
    </form>
  </div>
</template>