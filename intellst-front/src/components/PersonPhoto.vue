<template>
  <v-row>
    <v-col cols="1" sm="3" v-for="(item, i) in 4" :key="i">
      <v-img
        @click="dialog = !dialog"
        src="https://cdn.vuetifyjs.com/images/john.png"
      />
    </v-col>
    <v-dialog :value="dialog" v-model="dialog" width="500">
      <v-card>
        <v-toolbar
          class="headline grey lighten-5 lighten-1 gradient"
          primary-title
        >
          {{ $t("cases.popup.title") }}
          <v-spacer></v-spacer>
          <v-btn icon dark @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-toolbar>

        <div class="d-flex flex-column mb-6">
          <v-card class="pa-2" tile>
            {{ $t("cases.popup.temperature") }} : 38 C
          </v-card>
          <v-card class="pa-2" tile>
            {{ $t("cases.popup.date") }} : 5/10/2020
          </v-card>
          <v-card class="pa-2" tile>
            {{ $t("cases.popup.return") }} : 5/20/2020
          </v-card>
        </div>
        <v-card-actions class="justify-center">
          <button>
            <router-link to="/FAQ">{{
              $t("cases.popup.instructions")
            }}</router-link>
          </button>
        </v-card-actions>
        <v-card-actions>
          <v-spacer></v-spacer>
          <div class="my-2">
            <v-btn @click="dialog = false" depressed small color="error">
              <v-icon dark left>mdi-arrow-left</v-icon
              >{{ $t("cases.popup.allow") }}
            </v-btn>
          </div>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
  }),
};
</script>
