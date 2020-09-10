<template>
  <v-app id="inspire">
    <div>
      <v-alert
        v-if="show"
        color="red"
        border="left"
        elevation="2"
        colored-border
        type="error"
      >
        Invalid email and/or password.
      </v-alert>
    </div>
    <v-container class="fill-height" fluid @keyup.enter="loginUser()">
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="elevation-12">
            <v-toolbar class="gradient" dark flat>
              <v-toolbar-title>{{ $t("login.title") }}</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-tooltip bottom>
                <span>Source</span>
              </v-tooltip>
            </v-toolbar>
            <v-card-text>
              <v-form>
                <v-text-field
                  label="Login"
                  name="login"
                  v-model="user.username"
                  prepend-icon="mdi-account"
                  color="red"
                  type="text"
                  :rules="[rules.requiredMail, rules.email]"
                ></v-text-field>
                <v-text-field
                  id="password"
                  label="Password"
                  v-model="user.password"
                  prepend-icon="mdi-lock"
                  color="red"
                  name="password"
                  :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                  :rules="[rules.required]"
                  :type="showPassword ? 'text' : 'password'"
                  @click:append="showPassword = !showPassword"
                >
                </v-text-field>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="red" @click="loginUser(user)">
                {{ $t("login.entry") }}
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>
<script>
import { mapActions } from "vuex";

export default {
  data: () => ({
    status: null,
    user: {
      username: "",
      password: "",
    },
    showPassword: false,
    rules: {
      requiredMail: (value) => !!value || "Please insert your email",
      required: (value) => !!value || "Please insert your password",
      email: (value) => {
        if (value.length > 0) {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || "Invalid e-mail.";
        }
      },
    },
  }),
  computed: {
    show() {
      return this.status === 401;
    },
  },
  methods: {
    ...mapActions("login", ["signInAction"]),
    loginUser() {
      this.signInAction(this.user);
      setTimeout(() => {
        this.status = 401;
      }, 2000);
    },
  },
};
</script>
