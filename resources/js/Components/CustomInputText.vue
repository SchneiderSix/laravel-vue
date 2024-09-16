<script setup>
const model = defineModel({
  type: null,
  required: true
});


defineProps({
  name: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    default: 'text',
  },
  messageHelper: String
});
</script>

<template>
  <div class="mb-6">
    <label>{{ name }}</label>
    <input v-model="model" :type="type" :class="{'!ring-red-400' : messageHelper}">
    <small class="error" v-if="messageHelper">{{ messageHelper }}</small>
  </div>
</template>