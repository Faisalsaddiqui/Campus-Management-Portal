import { mount } from "@vue/test-utils";
import FormInputText from "../components/shared/form/FormInputText.vue";

const wrapper = mount(FormInputText, {
  props: {
    label: "Form Label",
    modelValue: "test",
    error: "Not found"
  },
});

test("test mount FormInputText component", async () => {
  expect(FormInputText).toBeTruthy();
});

test("test FormInputText props", async () => {
  expect(wrapper.props(['label'])).toContain("Form Label");
  expect(wrapper.props(['modelValue'])).toContain("test");
  expect(wrapper.props(['error'])).toContain("Not found");

  expect(wrapper.find('.form-error').isVisible()).toBe(true)

});

test("test error doesnt exists", async () => {
  await wrapper.setProps({ error: '' })
  expect(wrapper.find('.form-error').exists()).toBe(false)
})

test('test FormInputText emit', async () => {
  await wrapper.find('input[type="text"]').setValue('hello!')
  expect(wrapper.emitted()['update:modelValue'][0]).toEqual(['hello!'])
})
