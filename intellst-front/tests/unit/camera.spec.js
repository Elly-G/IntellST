import { shallowMount } from "@vue/test-utils";
import VCamera from "@/views/VCamera.vue";
import Vue from "vue";
import Vuetify from "vuetify";

Vue.use(Vuetify);

describe("VCamera", () => {
  it("render toolbar", () => {
    const wrapper = shallowMount(VCamera, {
      mocks: {
        $t: () => {},
      },
    });
    const toolbar = wrapper.find("v-toolbar");
    expect(toolbar.exists()).toBe(false);
  });

  it("render card", () => {
    const wrapper = shallowMount(VCamera, {
      mocks: {
        $t: () => {},
      },
    });
    const card = wrapper.find("v-card");
    expect(card.exists()).toBe(false);
  });

  it("render image", () => {
    const wrapper = shallowMount(VCamera, {
      mocks: {
        $t: () => {},
      },
    });
    const img = wrapper.find("v-img");
    expect(img.exists()).toBe(false);
  });
});
