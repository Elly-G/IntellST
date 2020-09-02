import { shallowMount } from "@vue/test-utils";
import Dashboard from "@/views/Dashboard.vue";
import Vue from "vue";
import Vuetify from "vuetify";
import VueRouter from "vue-router";

Vue.use(Vuetify);
Vue.use(VueRouter);

describe("Dashboard", () => {
  it("render menu", () => {
    const wrapper = shallowMount(Dashboard, {
      mocks: {
        $t: () => {},
      },
    });
    const menu = wrapper.find("v-menu");
    expect(menu.exists()).toBe(false);
  });

  it("render logo", () => {
    const wrapper = shallowMount(Dashboard, {
      mocks: {
        $t: () => {},
      },
    });
    const img = wrapper.find("img");
    expect(img.exists()).toBe(true);
  });

  it("render language switcher", () => {
    const wrapper = shallowMount(Dashboard, {
      mocks: {
        $t: () => {},
      },
    });
    const switcher = wrapper.find("language-switcher");
    expect(switcher.exists()).toBe(false);
  });

  it("render user", () => {
    const wrapper = shallowMount(Dashboard, {
      mocks: {
        $t: () => {},
      },
    });
    const user = wrapper.find("v-user");
    expect(user.exists()).toBe(false);
  });

  it("render content", () => {
    const wrapper = shallowMount(Dashboard, {
      mocks: {
        $t: () => {},
      },
    });
    const content = wrapper.find("v-main");
    expect(content.exists()).toBe(false);
  });

  it("render buttons", () => {
    const wrapper = shallowMount(Dashboard, {
      mocks: {
        $t: () => {},
      },
    });
    const buttons = wrapper.find("v-btn");
    expect(buttons.exists()).toBe(false);
  });

  it("render footer", () => {
    const wrapper = shallowMount(Dashboard, {
      mocks: {
        $t: () => {},
      },
    });
    const footer = wrapper.find("v-footer");
    expect(footer.exists()).toBe(false);
  });
});
