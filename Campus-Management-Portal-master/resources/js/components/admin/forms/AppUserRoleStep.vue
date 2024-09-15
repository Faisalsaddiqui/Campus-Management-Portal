<template>
	<div>
		<component
			v-if="role && role !== 'admin'"
			:is="`app-user-${role}-step`"
			:formStep="formStep"
		></component>
	</div>
</template>

<script>
export default {
	props: {
		formStep: {
			type: Number,
			required: true
		},
		role: {
			type: String,
			required: false
		}
	}
};
</script>