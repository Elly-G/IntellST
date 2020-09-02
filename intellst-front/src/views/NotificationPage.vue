<template>
  <v-container
    class="notifications notification-page flex-direction: column mt-6"
    width="80%"
  >
    <div class="mt-6">
      <h2>{{ $t("notifications.case") }}</h2>
      <div class="new_notifications_list">
        <p v-for="(item, i) in notificationsData" :key="i">
          <span>{{ $t("notifications.head") }}</span>
          {{ $t("notifications.body2") }} {{ item.temperature }}°С
          {{ $t("notifications.at") }}
          {{ item.firstDate.date.substring(0, 19) }}
          <button>
            <router-link to="/cases">{{
              $t("notifications.link")
            }}</router-link>
          </button>
        </p>
      </div>
    </div>
    <div class="mt-6">
      <h2>{{ $t("notifications.attempt") }}</h2>
      <div class="older_notifications_list">
        <p v-for="(item, i) in attemptsData" :key="i">
          <span>{{ $t("notifications.head") }}</span>
          {{ $t("notifications.body1") }} {{ item.temperature }}°С
          {{ $t("notifications.at") }}
          {{ item.firstDate.date.substring(0, 19) }}
          <button>
            <router-link to="/cases">{{
              $t("notifications.link")
            }}</router-link>
          </button>
        </p>
      </div>
    </div>
  </v-container>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  notificationsData: [],
  mounted() {
    this.notificationsCases();
    this.notificationsAttempts();
  },
  computed: {
    ...mapState("login", ["userToken", "notificationsData"]),
    ...mapState("login", ["userToken", "attemptsData"]),
  },
  methods: {
    ...mapActions("login", ["notificationsCases"]),
    ...mapActions("login", ["notificationsAttempts"]),
  },
};
</script>
