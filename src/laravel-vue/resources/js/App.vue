<template>
  <NavBar/>
  <Slider/>
  <RouterView/>
</template>

<script setup>
import { RouterView } from 'vue-router';
import NavBar from './components/bootstrap/NavBar.vue';
import Slider from './components/bootstrap/Slider.vue';
</script>
