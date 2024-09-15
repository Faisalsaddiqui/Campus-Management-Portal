import { mount } from "@vue/test-utils";
import AppTableSearch from "../components/shared/tables/AppTableSearch.vue";
import AppDropdown from "@/components/shared/ui/AppDropdown.vue";
import { expect, test } from "vitest";

const wrapper = mount(AppTableSearch, {
  props: {
    modelValue: null,
    filterable: false
  }
});

test("test mount AppTableSearch component", async () => {
  expect(AppTableSearch).toBeTruthy();
});

test("test AppDropdown component in AppTableSearch", () => {
  expect(wrapper.findComponent(AppDropdown).exists()).toBe(false)
})

test('test AppTableSearch text emit', async () => {
  await wrapper.find('input[type="text"]').setValue('hello!')
  expect(wrapper.emitted()['update:modelValue'][0]).toEqual(['hello!'])
})

test('test AppTableSearch button emit', async () => {
  await wrapper.find('button').trigger('click')
  expect(wrapper.emitted()).toHaveProperty(['reset'])
})

test('test AppTableSearch AppDropdown component renders', async () => {
  await wrapper.setProps({ filterable: true })
  expect(wrapper.findComponent(AppDropdown).exists()).toBe(true)
})
