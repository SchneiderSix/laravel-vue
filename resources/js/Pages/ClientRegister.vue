<script setup>
import { useForm } from '@inertiajs/vue3';
import CustomInput from '../Components/CustomInputText.vue';

const form = useForm({
  cliente_nombre: null,
  cliente_correo: null
});

const submit = () => {
  form.post(route('client'), {
    onError: () => {

      // Set input errors in spanish
      for (const field in form.errors) {
        const re_field = field == 'cliente_nombre' ? 'nombre' : field == 'cliente_correo' ? 'correo' : field;
        const error = form.errors[field];
        if (error.includes('must not be greater than')) {
          form.errors[field] = 'El campo ' +re_field+ ' no puede tener mas de 255 caracteres.';
        }else if (error.includes('is required')) {
          form.errors[field] = 'El campo ' +re_field+ ' es necesario.';
        }
      }
    }
  });
}

</script>

<template>
  <Head title=" | Clientes"/>

  <h1 class="title">Clientes</h1>

  <div class="items-center w-2/4 mx-auto">

    <form @submit.prevent="submit">

      <CustomInput
        name="Nombre"
        v-model="form.cliente_nombre"
        type="text"
        :messageHelper="form.errors.cliente_nombre"
      />

      <CustomInput
        name="Email"
        v-model="form.cliente_correo"
        type="email"
        :messageHelper="form.errors.cliente_correo"
      />
      
      <div>
        <button class="primary-btn" :disabled="form.processing">
          Registrar cliente
        </button>
      </div>
    </form>
  </div>
</template>