<template>
  <v-container class="fill-height" fluid>
    <ValidationObserver ref="observer" class="mx-auto">
      <v-card class="mx-auto" max-width="520" outlined>
        <v-form>
          <v-list-item two-line>
            <v-list-item-content>
              <div class="row" style="height: 70px; margin: auto;">
                <div>
                  <v-list-item-subtitle class="mt-3">{{
                    $t("settings.allowed")
                  }}</v-list-item-subtitle>
                </div>
                <v-col cols="3" style="margin-left: auto;">
                  <ValidationProvider
                    rules="between:35,38"
                    name="Temperature"
                    v-slot="{ errors }"
                  >
                    <v-text-field
                      v-model="temperature"
                      required
                      :error-messages="errors"
                      step=".1"
                      label=""
                      outlined
                      dense
                    ></v-text-field>
                  </ValidationProvider>
                </v-col>
              </div>
              <div class="row" style="height: 80px; margin: auto;">
                <div>
                  <v-list-item-subtitle class="mt-3">{{
                    $t("settings.restriction")
                  }}</v-list-item-subtitle>
                </div>
                <v-col cols="3" style="margin-left: auto;">
                  <ValidationProvider
                    rules="max:2"
                    name="Days"
                    v-slot="{ errors }"
                  >
                    <v-text-field
                      v-model="days"
                      required
                      :error-messages="errors"
                      label=""
                      outlined
                      dense
                    ></v-text-field>
                  </ValidationProvider>
                </v-col>
              </div>
            </v-list-item-content>
          </v-list-item>
          <v-card-actions>
            <v-col class="text-center">
              <v-btn @click="submit" color="red">{{
                $t("settings.save")
              }}</v-btn>
            </v-col>
          </v-card-actions>
        </v-form>
      </v-card>
    </ValidationObserver>
  </v-container>
</template>

<script>
import { between, max } from "vee-validate/dist/rules";
import {
  extend,
  ValidationObserver,
  ValidationProvider,
  setInteractionMode,
} from "vee-validate";
setInteractionMode("eager");

extend("max", {
  ...max,
  message: "Invalid data",
});

extend("between", {
  ...between,
  message: "Invalid data",
});

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data: () => ({
    days: "",
    temperature: "",
  }),
  methods: {
    submit() {
      this.$refs.observer.validate();
    },
  },
};
</script>
