<script setup>
//import Layout from '../Components/Layout.vue';

// Set specific layout or just use the default Layout setted in app.js
//defineOptions({ layout: Layout });

// Set dynamically page's title
//<Head :title="` | ${$page.component}`"/>


</script>

<template>
  <Head :title="` | Inicio`"/>
      <h1 class="title">Bienvenido {{ $page.props.auth.user.name }}</h1>
      <div v-if="$page.props.count > 0">
        <p class="flex justify-center items-center">
          Haz creado {{ $page.props.count }} registros de llamadas 😃
        </p>
      </div>
      <div v-else>
        <p class="flex justify-center items-center">
          No haz creado ningun registro de llamadas, pero descuida, todavia estas a tiempo 🍃
        </p>
      </div>
</template>