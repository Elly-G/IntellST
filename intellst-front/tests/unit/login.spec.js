import Login from "@/views/Login.vue";
import { shallowMount } from "@vue/test-utils";
import Vue from "vue";
import Vuetify from "vuetify";

Vue.use(Vuetify);

describe("Login.vue", () => {
  it("render a alert", () => {
    const wrapper = shallowMount(Login, {
      mocks: {
        $t: () => {},
      },
    });
    const alert = wrapper.find("v-alert");
    expect(alert.exists()).toBe(false);
  });

  it("render a form", () => {
    const wrapper = shallowMount(Login, {
      mocks: {
        $t: () => {},
      },
    });
    const form = wrapper.find("v-form");
    expect(form.exists()).toBe(false);
  });

  it("render a button", () => {
    const wrapper = shallowMount(Login, {
      mocks: {
        $t: () => {},
      },
    });
    const button = wrapper.find("v-btn");
    expect(button.exists()).toBe(false);
  });

  it("render a container", () => {
    const wrapper = shallowMount(Login, {
      mocks: {
        $t: () => {},
      },
    });
    const container = wrapper.find("v-container");
    expect(container.exists()).toBe(false);
  });

  it("render a text fields", () => {
    const wrapper = shallowMount(Login, {
      mocks: {
        $t: () => {},
      },
    });
    const field = wrapper.find("v-text-field");
    expect(field.exists()).toBe(false);
  });

  it("render card actions", () => {
    const wrapper = shallowMount(Login, {
      mocks: {
        $t: () => {},
      },
    });
    const actions = wrapper.find("v-card-actions");
    expect(actions.exists()).toBe(false);
  });
});
