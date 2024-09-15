<template>
	<div class="tooltip">
		<span>{{ tooltip }}</span>

		<span class="tooltiptext">
			<slot />
		</span>
	</div>
</template>

<script>
export default {
	props: {
		tooltip: {
			type: String,
			required: true
		}
	}
};
</script>


<style>
.tooltip {
	position: relative;
	display: inline-block;
	border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
	visibility: hidden;
	width: 120px;
	background-color: black;
	color: #fff;
	text-align: center;
	padding: 5px 0;
	border-radius: 6px;

	position: absolute;
	z-index: 1;
}

.tooltip:hover .tooltiptext {
	visibility: visible;
}

.tooltip .tooltiptext {
	width: 120px;
	bottom: 100%;
	left: 50%;
	margin-left: -60px; /* Use half of the width (120/2 = 60), to center the tooltip */
}

.tooltip .tooltiptext::after {
	content: " ";
	position: absolute;
	top: 100%;
	left: 50%;
	margin-left: -5px;
	border-width: 5px;
	border-style: solid;
	border-color: black transparent transparent transparent;
}
</style>