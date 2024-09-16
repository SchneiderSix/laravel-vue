<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import CustomInput from '../Components/CustomInputText.vue';


// Here you can set a random id from clients object or the user can choose an id (current option)
defineProps({
  clients: Object,
  count: Number
});

const form = useForm({
  cliente_id: null,
  user_id: usePage().props.auth.user.id,
  llamada_telefono: null,
  llamada_fecha: null,
  llamada_observacion: null
});

const submit = () => {
  form.post(route('call'), {
    onError: () => {
      // Set input errors in spanish
      for (const field in form.errors) {
        const re_field = field.includes('llamada') ? field.substring(8) : field.includes('cliente') ? 'id' : field;
        const error = form.errors[field];
        if (error.includes('must not be greater than')) {
          form.errors[field] = 'El campo ' +re_field+ ' no puede tener mas de 255 caracteres.';
        }else if (error.includes('is required')) {
          form.errors[field] = 'El campo ' +re_field+ ' es necesario.';
        }
      }
    }
  })
}

</script>

<template>
  <Head title =" | Llamadas"/>

  <h1 v-if="$page.props.count == 0" class="title">No hay clientes a quien llamar</h1>

  <div v-else>
    <h1 class="title">Llamadas</h1>

    <div class="items-center w-2/4 mx-auto">

      <form @submit.prevent="submit">

        <div class="mb-6">
          <label>ID de cliente</label>
          <select v-model="form.cliente_id">
          <option v-for="client in clients?.values()" :key="client.cliente_id" :value="client.cliente_id">{{ client.cliente_id }}</option>
          </select>
          <small class="error" v-if="form.errors.cliente_id">{{ form.errors.cliente_id }}</small>
        </div>

        <CustomInput
          name="Telefono"
          v-model="form.llamada_telefono"
          type="text"
          :messageHelper="form.errors.llamada_telefono"
        />

        <CustomInput
          name="Fecha"
          v-model="form.llamada_fecha"
          type="datetime-local"
          :messageHelper="form.errors.llamada_fecha"
        />

        <div class="mb-6">
          <label>Observacion</label>
          <textarea
            v-model="form.llamada_observacion"
          ></textarea>
          <small class="error" v-if="form.errors.llamada_observacion">{{ form.errors.llamada_observacion }}</small>
        </div>
        
        <div>
          <button class="primary-btn" :disabled="form.processing">
            Registrar llamada
          </button>
        </div>
      </form>
    </div>
  </div>
</template>