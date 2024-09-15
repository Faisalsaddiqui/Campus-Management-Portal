import { mount } from "@vue/test-utils";
import FormInputSelect from "../components/shared/form/FormInputSelect.vue";

const wrapper = mount(FormInputSelect, {
  props: {
    label: "Form Label",
    modelValue: "test",
    error: "Not found"
  },
  slots: {
    default: '<option value="first" selected>First</option>',
  }
});

test("test mount FormInputSelect component", async () => {
  expect(FormInputSelect).toBeTruthy();
});


test("test FormInputSelect slot renders", () => {
  expect(wrapper.find('select option').html()).toBe('<option selected="" value="first">First</option>')
})

test("test FormInputSelect props", async () => {
  expect(wrapper.props(['label'])).toContain("Form Label");
  expect(wrapper.props(['modelValue'])).toContain("test");
  expect(wrapper.props(['error'])).toContain("Not found");

  expect(wrapper.find('.form-error').isVisible()).toBe(true)

});

test("test error doesnt exists", async () => {
  await wrapper.setProps({ error: '' })
  expect(wrapper.find('.form-error').exists()).toBe(false)
})

test('test FormInputSelect emit', async () => {
  await wrapper.find('select').setValue('first')

  expect(wrapper.emitted()['update:modelValue'][0]).toEqual(['first'])
})
