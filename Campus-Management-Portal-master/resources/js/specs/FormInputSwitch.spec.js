
import { mount } from "@vue/test-utils";
import FormInputSwitch from "../components/shared/form/FormInputSwitch.vue";
import { it } from "vitest";

const wrapper = mount(FormInputSwitch, {
  props: {
    modelValue: false,
  },
});


test("test mount FormInputSwitch component", async () => {
  expect(FormInputSwitch).toBeTruthy();
});

test("test FormInputSwitch props", async () => {
  expect(wrapper.props(['modelValue'])).toBe(false);
});


test('test FormInputSwitch emit', async () => {
  await wrapper.find('input[type="checkbox"]').setValue(true)

  expect(wrapper.emitted()['update:modelValue'][0]).toEqual([true])
})
