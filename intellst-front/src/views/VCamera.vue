<template>
  <v-flex cols="12">
    <v-toolbar dense color="gradient" height="80" class="mr-2 ml-2 mt-2 mb-2">
      <v-toolbar-title>
        <h1>Live stream video</h1>
      </v-toolbar-title>
    </v-toolbar>
    <v-col class="d-flex" cols="12">
      <v-col cols="8">
        <v-card>
          <v-col class="d-flex child-flex">
            <v-card flat tile class="d-flex">
              <v-img
                src="https://www.oasisscientific.com/uploads/3/0/7/1/3071815/s902975211958334_p539_i16_w640.jpeg"
              ></v-img>
            </v-card>
          </v-col>
        </v-card>
      </v-col>
      <v-col cols="4">
        <v-select :items="items" label="Choose camera" solo></v-select>
      </v-col>
    </v-col>
  </v-flex>
</template>

<script>
export default {
  data: () => ({
    items: ["Camera 1", "Camera 2"],
  }),
};
</script>
