<template>
	<div>
		<img
			class=""
			width="200"
			height="200"
			:src="'/storage/users/' + avatar"
			alt=""
		/>
	</div>
</template>

<script>
export default {
	props: {
		avatar: {
			required: true
		}
	}
};
</script>

<style>
</style>