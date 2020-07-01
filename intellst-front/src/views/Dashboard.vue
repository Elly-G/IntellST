<template>
  <v-app id="inspire">
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

    <v-app-bar app color="grey darken-4" clipped-left>
      <img
        :src="require('@/assets/logo.svg')"
        class="mt-2 mr-1"
        height="100"
        @click="home"
      />
      <v-spacer></v-spacer>
      <LanguageSwitcher />
      <v-btn icon class="mr-2" link to="/notifications" @click="messages = 0">
        <v-badge color="red" dot :content="messages" :value="messages">
          <v-icon>mdi-bell</v-icon>
        </v-badge>
      </v-btn>

      <v-menu bottom right transition="scale-transition" origin="top left">
        <template v-slot:activator="{ on }">
          <v-chip pill v-on="on" color="transparent">
            <v-avatar left>
              <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
            </v-avatar>
            John Leider
          </v-chip>
        </template>
        <v-card width="300">
          <v-list dark>
            <v-list-item>
              <v-list-item-avatar>
                <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
              </v-list-item-avatar>
              <v-list-item-content>
                <v-list-item-title>John Leider</v-list-item-title>
                <v-list-item-subtitle>john@vuetifyjs.com</v-list-item-subtitle>
              </v-list-item-content>
              <v-list-item-action>
                <v-btn icon>
                  <v-icon>mdi-close-circle</v-icon>
                </v-btn>
              </v-list-item-action>
            </v-list-item>
          </v-list>
          <v-list>
            <v-list-item @click="() => {}">
              <v-list-item-action>
                <v-icon>mdi-briefcase</v-icon>
              </v-list-item-action>
              <v-list-item-subtitle>john@gmail.com</v-list-item-subtitle>
            </v-list-item>
          </v-list>
        </v-card>
      </v-menu>
      <v-btn text @click="logout"><v-icon>mdi-exit-to-app</v-icon></v-btn>
    </v-app-bar>

    <v-content><router-view /></v-content>

    <v-footer app padless>
      <v-card-text class="py-2 white--text text-center">
        Copyright &copy; {{ new Date().getFullYear() }}
        <strong>IntellST.</strong> All Rights Reserved
      </v-card-text>
    </v-footer>
  </v-app>
</template>

<script>
import LanguageSwitcher from "../components/LanguageSwitcher";
export default {
  components: {
    LanguageSwitcher,
  },
  data() {
    return {
      messages: [],
      show: false,
    };
  },
  props: {
    source: String,
  },
  methods: {
    home() {
      this.$router.push("/");
    },
    logout() {
      this.$router.push("/login");
      //TODO call mutation with empty tokens
      //TODO after it redirect it to auth page
    },
    open() {
      console.log("open");
      this.$refs.userForm.open();
      // call mutation with empty tokens
      // after it redirect it to auth page
    },
  },
};
</script>
