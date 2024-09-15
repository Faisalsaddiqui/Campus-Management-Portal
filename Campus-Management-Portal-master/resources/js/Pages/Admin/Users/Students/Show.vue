<template>
    <main>
        <TheAdminHead :title="`${user.name}`" />
        <h1 class="mb-8 font-bold text-3xl">{{ user.name }}</h1>

        <ProfileCard :image="user.avatar">
            <div class="px-4">
                <p><span class="font-bold">Name:</span> {{ user.name }}</p>
                <p>
                    <span class="font-bold">Father Name:</span>
                    {{ user.father_name }}
                </p>
                <p><span class="font-bold">Gender: </span> {{ user.gender }}</p>
                <p>
                    <span class="font-bold">Date of birth:</span>
                    {{ user.date_of_birth }}
                </p>
                <p>
                    <span class="font-bold">Registration No:</span>
                    {{ user.enrollments[0].registration_number }}
                </p>
                <p>
                    <span class="font-bold">Student Session:</span>
                    {{ user.enrollments[0].session_duration }}
                </p>
                <p>
                    <span class="font-bold">Session Type:</span>
                    {{ user.enrollments[0].session_type }}
                </p>
                <p>
                    <span class="font-bold">Admission Year:</span>
                    {{ user.enrollments[0].admission_year }}
                </p>
            </div>
        </ProfileCard>
        <!-- <div v-if="permissions.edit" class="py-4 my-4  max-w-3xl">
			<Link :href="route(`admin.users.student.edit`, user.id)" class="btn-main">
			Edit
			</Link>
		</div> -->
    </main>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link
    },
    props: {
        user: {
            required: true,
            type: Object
        },
        permissions: {
            type: Object,
            required: false
        }
    }
};
</script>
