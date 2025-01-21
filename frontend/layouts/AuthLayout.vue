<template>
    <v-app id="inspire" class="bg-gray-100">
    <v-navigation-drawer
    model-value
      class="pt-4"
      color="grey-lighten-3"
    >
      <v-list rounded="xl" class="pa-2" variant="tonal">
        <v-list-item 
            
            title="Home"
            :to="{name: 'home'}"
            rounded="xl"
            color="dark"
            append-icon="mdi-chevron-right"
            prepend-icon="mdi-home"
            class="pa-4 mb-2"
        />
      </v-list>
    </v-navigation-drawer>

    <v-main class="container">
      <slot />
    </v-main>
  </v-app>
</template>