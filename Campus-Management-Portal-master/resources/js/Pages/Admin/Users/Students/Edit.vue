<template>
	<div>
		{{ permissions }}
		{{ user }}
	</div>
</template>

<script>
export default {
	props: {
		user: {
			required: true,
			type: Object
		},
		permissions: {
			Object,
			required: false
		}
	}
};
</script>

<style>

</style>