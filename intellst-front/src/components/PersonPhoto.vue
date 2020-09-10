<template>
  <v-row>
    <v-col
      cols="1"
      sm="3"
      v-for="(post, index) in casesDataByWeek"
      :key="index"
    >
      <v-img
        @click="
          setDescription(post);
          dialog = !dialog;
        "
        :src="require('@/assets/person.png')"
      />
    </v-col>

    <v-dialog
      id="item-description"
      :value="dialog"
      v-model="dialog"
      width="500"
    >
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
            {{ $t("cases.popup.temperature") }} : {{ currentTemperature }}°С
          </v-card>
          <v-card class="pa-2" tile>
            {{ $t("cases.popup.face") }} : {{ currentPhoto }}
          </v-card>
          <v-card class="pa-2" tile>
            {{ $t("cases.popup.date") }} : {{ currentDate }}
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
            <v-btn @click="submit()" depressed small color="error">
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
import { mapState, mapActions } from "vuex";
import moment from "moment";

export default {
  data() {
    return {
      dialog: false,
      currentId: null,
      currentTemperature: null,
      currentPhoto: null,
      currentDate: null,
    };
  },
  props: {
    currentWeekDate: {
      type: String,
      default: moment().format("MM/DD/YYYY"),
    },
  },

  methods: {
    setDescription(item) {
      this.currentId = item.id;
      this.currentTemperature = item.temperature;
      this.currentPhoto = moment(item.datePhoto.date).format(
        "MM/DD/YYYY HH:MM"
      );
      this.currentDate = moment(item.firstDate.date).format("MM/DD/YYYY HH:MM");
    },
    submit() {
      this.allowEntrance({ id: this.currentId });
      setTimeout(() => {
        this.dialog = false;
      }, 700);
    },
    ...mapActions("login", ["allowEntrance"]),
  },
  computed: {
    ...mapState("login", ["userToken", "casesData"]),
    casesDataByWeek() {
      const dateFilter = (value) =>
        moment(value.firstDate.date).isSame(
          moment(this.currentWeekDate, "MM/DD/YYYY"),
          "day"
        );
      return Object.values(this.casesData).filter(dateFilter) || {};
    },
  },
};
</script>
