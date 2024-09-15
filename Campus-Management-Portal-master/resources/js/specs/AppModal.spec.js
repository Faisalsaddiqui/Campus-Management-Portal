import { mount } from "@vue/test-utils";
import AppModal from "../components/shared/modals/AppModal.vue";

const wrapper = mount(AppModal, {
  props: {
    modalWidth: "w-4xl"
  },
  slots: {
    default: '<div class="modal-content"></div>',
  }
});

test("test mount AppModal component", async () => {
  expect(AppModal).toBeTruthy();
});

test("test AppModal slot renders", () => {
  expect(wrapper.find('.modal-content').html()).toBe('<div class="modal-content"></div>')
})

test("test AppModal props", async () => {
  expect(wrapper.props(['modalWidth'])).toContain("w-4xl");
});

test('test AppModal overlay emit', async () => {
  await wrapper.find('#overlay').trigger('click')
  expect(wrapper.emitted()).toHaveProperty('close')
})

test('test AppModal close emit', async () => {
  await wrapper.find('#btn-close').trigger('click')
  expect(wrapper.emitted()).toHaveProperty('close')
})
