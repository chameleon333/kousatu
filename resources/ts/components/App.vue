<template>
  <div class="App">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h1>{{ message }}</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component
export default class App extends Vue {
  message = "Laravel + Vue.js + TypeScript";
}
</script>

<style scoped>
h1 {
  text-align: center;
  margin: 4rem 0;
}
</style>
