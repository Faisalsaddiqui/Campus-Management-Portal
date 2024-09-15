<template>
	<button class=" text-white inline px-4 py-2 cursor-pointer rounded-md">
		{{ text }}
	</button>
</template>

<script>
export default {
	name: "AppButton",
	props: {
		text: {
			required: true,
			type: String
		}
	}
};
</script>