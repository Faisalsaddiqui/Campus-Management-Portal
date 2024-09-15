<template>
	<div class="max-w-3xl">
		<FormInputSelect
			v-model="form.organization"
			label="Organization"
			:error="form.errors.organization"
		>
			<option
				v-for="organization in organizations"
				:key="organization.id"
				:value="organization.id"
				>{{ organization.organization_name }}</option
			>
		</FormInputSelect>
	</div>
</template>

<script>
import FormInputSelect from "../../../shared/form/FormInputSelect.vue";
import FormInputText from "../../../shared/form/FormInputText.vue";
export default {
	props: {
		form: { required: true },
		organizations: { required: true }
	},
	components: { FormInputSelect, FormInputText }
};
</script>

<style>
</style>