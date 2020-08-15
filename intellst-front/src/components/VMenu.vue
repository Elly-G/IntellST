<template>
  <v-navigation-drawer
    app
    clipped
    width="200"
    permanent
    expand-on-hover
    color="grey darken-4"
    class="transparent"
  >
    <v-list dense class="tile">
      <v-list-item link to="/">
        <v-icon>mdi-home</v-icon>
        <v-list-item-action class="mt-5">
          <v-list-item-title>{{ $t("menu.home") }}</v-list-item-title>
        </v-list-item-action>
      </v-list-item>
      <v-list-item link to="/cases">
        <v-icon>mdi-folder-open</v-icon>
        <v-list-item-action class="mt-5">
          <v-list-item-title>{{ $t("menu.cases") }}</v-list-item-title>
        </v-list-item-action>
      </v-list-item>
      <v-list-item link to="/settings">
        <v-icon>mdi-cog</v-icon>
        <v-list-item-action class="mt-5">
          <v-list-item-title>{{ $t("menu.settings") }}</v-list-item-title>
        </v-list-item-action>
      </v-list-item>
      <v-list-item link to="/FAQ">
        <v-icon>mdi-help-circle</v-icon>
        <v-list-item-action class="mt-5">
          <v-list-item-title>{{ $t("menu.faq") }}</v-list-item-title>
        </v-list-item-action>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>
