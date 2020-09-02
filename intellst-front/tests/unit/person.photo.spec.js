import { mount } from "@vue/test-utils";
import PersonPhoto from "@/components/PersonPhoto.vue";
import Vue from "vue";
import Vuetify from "vuetify";

Vue.use(Vuetify);

describe("PersonPhoto", () => {
  it("render row", () => {
    const wrapper = mount(PersonPhoto, {
      mocks: {
        $t: () => {},
      },
    });
    const row = wrapper.find("v-row");
    expect(row.exists()).toBe(false);
  });

  it("render dialog", () => {
    const wrapper = mount(PersonPhoto, {
      mocks: {
        $t: () => {},
      },
    });
    const dialog = wrapper.find("v-dialog");
    expect(dialog.exists()).toBe(false);
  });

  it("render card", () => {
    const wrapper = mount(PersonPhoto, {
      mocks: {
        $t: () => {},
      },
    });
    const card = wrapper.find("v-card");
    expect(card.exists()).toBe(false);
  });
});
