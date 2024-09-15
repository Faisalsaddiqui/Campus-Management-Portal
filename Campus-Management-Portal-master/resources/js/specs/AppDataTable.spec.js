import { mount } from "@vue/test-utils";
import AppDataTable from "../components/shared/tables/AppDataTable.vue";
import { test } from "vitest";

const wrapper = mount(AppDataTable, {
  props: {
    resourceRoute: null,
    labels: [],
    tableData: []
  }
});

const labels = [
  {
    value: "Name",
    key: "name"
  },
  {
    value: "Email",
    key: "email"
  },
]

const data = [
  {
    name: "Name 1",
    email: "email@mail.com"
  },
  {
    name: "Name 2",
    email: "email2@mail.com"
  },
]

test("test mount AppDataTable component", async () => {
  expect(AppDataTable).toBeTruthy();
});

test("test AppDataTable row generation", async () => {
  expect(wrapper.findAll('.data-row').length).toBe(0)

  await wrapper.setProps({ labels: labels, tableData: data })

  expect(wrapper.findAll(".data-row").length).toBe(data.length)
})
