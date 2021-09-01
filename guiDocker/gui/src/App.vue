<template>
  <v-app>
    <v-app-bar
      app
      color="black"
      dark
    >
      <div class="d-flex align-center">
      
      </div>

      <v-spacer></v-spacer>

    
    </v-app-bar>

    <v-main>
      <websiteGenerator/>
    </v-main>
  </v-app>
</template>

<script>
import websiteGenerator from './components/website_generator';

export default {
  name: 'App',

  components: {
    websiteGenerator,
  },

  data: () => ({
    //
  }),
};
</script>

