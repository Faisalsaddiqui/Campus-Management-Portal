import { mount } from "@vue/test-utils";
import FormInputCnic from "../components/shared/form/FormInputCnic.vue";

const wrapper = mount(FormInputCnic, {
  props: {
    label: "Form Label",
    modelValue: "test",
    error: "Not found"
  },
});


test("test mount FormInputCnic component", async () => {
  expect(FormInputCnic).toBeTruthy();
});

test("test FormInputCnic props", async () => {
  expect(wrapper.props(['label'])).toContain("Form Label");
  expect(wrapper.props(['modelValue'])).toContain("test");
  expect(wrapper.props(['error'])).toContain("Not found");

  expect(wrapper.find('.form-error').isVisible()).toBe(true)

});

test("test error doesnt exists", async () => {
  await wrapper.setProps({ error: '' })
  expect(wrapper.find('.form-error').exists()).toBe(false)
})

test('test FormInputCnic emit', async () => {
  await wrapper.find('.form-input').setValue('331-1111-1111-1')
  expect(wrapper.emitted()['update:modelValue'][2]).toEqual(['331111111111'])
})
