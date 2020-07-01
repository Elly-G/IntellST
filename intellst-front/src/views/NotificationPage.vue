<template>
  <v-container
    class="notifications notification-page flex-direction: column mt-6"
    width="80%"
  >
    <div class="new_notifications mt-6">
      <h2>{{ $t("notifications.new") }}</h2>
      <div class="new_notifications_list">
        <p>
          <span>{{ $t("notifications.head") }}</span>
          {{ $t("notifications.body1") }} 6/20/2020
          <a>{{ $t("notifications.link") }}</a>
        </p>
        <p>
          <span>{{ $t("notifications.head") }}</span>
          {{ $t("notifications.body2") }} 5/20/2020
          <a>{{ $t("notifications.link") }}</a>
        </p>
        <p>
          <span>{{ $t("notifications.head") }}</span>
          {{ $t("notifications.body2") }} 5/20/2020
          <a>{{ $t("notifications.link") }}</a>
        </p>
      </div>
    </div>
    <div class="old_notifications">
      <h2>{{ $t("notifications.old") }}</h2>
      <div class="older_notifications_list">
        <p>
          <span>{{ $t("notifications.head") }}</span>
          {{ $t("notifications.body2") }} 6/20/2020
          <a>{{ $t("notifications.link") }}</a>
        </p>
        <p>
          <span>{{ $t("notifications.head") }}</span>
          {{ $t("notifications.body2") }} 5/20/2020
          <a>{{ $t("notifications.link") }}</a>
        </p>
        <p>
          <span>{{ $t("notifications.head") }}</span>
          {{ $t("notifications.body2") }} 5/20/2020
          <a>{{ $t("notifications.link") }}</a>
        </p>
      </div>
    </div>
  </v-container>
</template>
