<template>
	<div class="form-row">
		<div>
			<label class="block">Student Name: </label>
			<input type="text" v-model="form.name" class="form-input" />
			<div class="text-red-600" v-if="form.errors.name">
				{{ form.errors.name }}
			</div>
		</div>
		<div>
			<label class="block">Email: </label>
			<input type="text" v-model="form.email" class="form-input" />
			<div class="text-red-600" v-if="form.errors.email">
				{{ form.errors.email }}
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		form: {
			type: Object,
			required: true
		}
	}
};
</script>