import { shallowMount } from "@vue/test-utils";
import NotFound from "@/views/NotFound.vue";
import Vue from "vue";
import Vuetify from "vuetify";
import VueRouter from "vue-router";

Vue.use(VueRouter);
Vue.use(Vuetify);

describe("NotFound", () => {
  it("render card", () => {
    const wrapper = shallowMount(NotFound, {
      mocks: {
        $t: () => {},
      },
    });
    const card = wrapper.find("v-card");
    expect(card.exists()).toBe(false);
  });

  it("render div", () => {
    const wrapper = shallowMount(NotFound, {
      mocks: {
        $t: () => {},
      },
    });
    const div = wrapper.find("v-div");
    expect(div.exists()).toBe(false);
  });

  it("render a button", () => {
    const wrapper = shallowMount(NotFound, {
      mocks: {
        $t: () => {},
      },
    });
    const button = wrapper.find("v-btn");
    expect(button.exists()).toBe(false);
  });
});
