<template>
  <v-menu transition="slide-y-transition" bottom>
    <template v-slot:activator="{ on, attrs }">
      <v-chip
        pill
        color="transparent"
        dark
        v-bind="attrs"
        v-on="on"
        style="text-transform: uppercase;"
      >
        {{ $i18n._vm.locale }}
      </v-chip>
    </template>
    <v-list class="language">
      <v-list-item>
        <v-list-item-title @click="setLocale('en')"
          ><flag class="mr-2" iso="us"></flag>EN</v-list-item-title
        >
      </v-list-item>
      <v-list-item>
        <v-list-item-title @click="setLocale('fr')"
          ><flag class="mr-2" iso="fr"></flag>FR</v-list-item-title
        >
      </v-list-item>
      <v-list-item>
        <v-list-item-title @click="setLocale('ro')"
          ><flag class="mr-2" iso="ro"></flag>RO</v-list-item-title
        >
      </v-list-item>
      <v-list-item>
        <v-list-item-title @click="setLocale('ru')"
          ><flag class="mr-2" iso="ru"></flag>RU</v-list-item-title
        >
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  methods: {
    setLocale(locale) {
      this.$i18n.locale = locale;
    },
  },
};
</script>
