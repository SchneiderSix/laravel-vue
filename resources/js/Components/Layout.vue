<script setup>
import { Link, Head } from '@inertiajs/vue3';

</script>

<template>
  <Head>
    <title>My app</title>
    <meta name="description" content="Custom description">
  </Head>
  <div>
    <header>
      <nav>
        <div class="space-x-6" v-if="$page.props.auth.user">
          <Link 
          class="nav-link" :href="route('home')"
          :class="{'bg-slate-700' : $page.component === 'Home'}"
          >Inicio</Link>
        </div>
        <div v-else class="space-x-6"></div>
        <div v-if="$page.props.auth.user">
          <Link 
          class="nav-link" :href="route('client')"
          :class="{'bg-slate-700' : $page.component === 'ClientRegister'}"
          >Registro de clientes</Link>
          <Link 
          class="nav-link" :href="route('call')"
          :class="{'bg-slate-700' : $page.component === 'CallRegister'}"
          >Registro de llamadas</Link>
          <Link 
          method="post" as="button" type="button" class="nav-link" :href="route('logout')"
          >Logout</Link>
        </div>
        <div v-else class="space-x-6">
          <Link 
          class="nav-link" :href="route('login')"
          :class="{'bg-slate-700' : $page.component === 'Auth/Login'}"
          >Login</Link>
          <Link 
          class="nav-link" :href="route('register')"
          :class="{'bg-slate-700' : $page.component === 'Auth/Register'}"
          >Registro</Link>
        </div>
      </nav>
    </header>

    <main class="p-4">
      <slot />
    </main>
  </div>
</template>