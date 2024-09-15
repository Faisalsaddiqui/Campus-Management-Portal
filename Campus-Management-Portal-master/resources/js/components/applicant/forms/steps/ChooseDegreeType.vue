<template>
	<div>
		<h1 class="text-center">Select your qualification type</h1>
		<div class="flex justify-center gap-16 mt-8">
			<div
				v-for="(degreeType, index) in degreeTypes"
				:key="index"
				class="bg-white shadow-lg rounded-lg"
				:class="
					form.type === degreeType ? 'opacity-100 shadow-2xl' : 'opacity-80'
				"
			>
				<label
					class="w-44 h-44 cursor-pointer text-2xl capitalize flex justify-center items-center"
					:for="index"
					>{{ degreeType }}</label
				>
				<input
					class="hidden"
					:value="degreeType"
					v-model="form.type"
					name="types"
					type="radio"
					:id="index"
				/>
			</div>
		</div>
		<div v-if="form.type">
			<FormInputSelect
				label="Qualification Title"
				:error="form.errors.title"
				v-model="form.title"
			>
				<option value=""></option>
				<option
					v-for="(title, index) in degreeTitles"
					class="capitalize"
					:key="index"
					:value="title"
					>{{ title }}</option
				>
			</FormInputSelect>
		</div>
	</div>
</template>

<script>
import FormInputSelect from "../../../shared/form/FormInputSelect.vue";
export default {
	data() {
		return {
			degreeTitles: []
		};
	},
	props: {
		form: { required: true },
		degreeTypes: { type: Array, required: true }
	},
	watch: {
		"form.type": function(newValue) {
			this.form.title = "";
			this.setTitles(newValue);
		}
	},
	methods: {
		setTitles(val) {
			if (val === "matric") {
				this.degreeTitles = [
					"Matriculation (Arts)",
					"Matriculation (Science)",
					"O-Levels"
				];
			} else if (val === "intermediate") {
				this.degreeTitles = [
					"FSC (Pre-Medical)",
					"FSC (Pre-Engineering)",
					"ICS"
				];
			}
		}
	},
	components: { FormInputSelect }
};
</script>
