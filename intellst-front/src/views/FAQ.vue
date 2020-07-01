<template>
  <v-flex xs12>
    <v-container class="justify-content-center">
      <v-toolbar dense color="gradient" height="80">
        <v-toolbar-content>
          <text-field>
            <h1>{{ $t("faq.title1") }}</h1>
          </text-field>
        </v-toolbar-content>
      </v-toolbar>
      <v-expansion-panels v-model="panel" :disabled="disabled" multiple>
        <v-expansion-panel v-for="(item, i) in $t('faq.items')" :key="i">
          <v-expansion-panel-header
            class="font-weight-bold"
            v-text="item.title"
          ></v-expansion-panel-header>
          <v-expansion-panel-content>
            <text-field v-text="item.text"></text-field>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-container>
  </v-flex>
</template>
