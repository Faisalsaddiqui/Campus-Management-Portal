<script setup>
import TheApplicantHead from "@/components/applicant/meta/TheApplicantHead.vue";
import AppNotificationCard from "../../components/shared/cards/AppNotificationCard.vue";

const props = defineProps({
    notifications: {
        required: false
    }
});
</script>

<template>
    <TheApplicantHead title="Test" />
    <div>
        <p>
            Dashboard
        </p>
        <div v-if="notifications">
            <div v-for="(notification, index) in notifications" :key="index">
                <AppNotificationCard :url="route('applicant.dashboard')">
                    {{ notification.text }}
                </AppNotificationCard>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>
