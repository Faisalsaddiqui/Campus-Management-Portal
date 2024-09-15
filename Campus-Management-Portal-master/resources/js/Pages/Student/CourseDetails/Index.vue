<template>
    <main>
        <TheAdminHead title="Course Details - Student" />

        <section>
            <div v-if="student.program">
                <p>Currently Enrolled in: {{ student.program.program_name }}</p>
            </div>
            <div v-else>
                <h1>Enroll Now</h1>
                <select v-model="selectedProgram">
                    <option value="">Select any program</option>
                    <option
                        v-for="program in programs"
                        :key="program.id"
                        :value="program.id"
                        >{{ program.program_name }}</option
                    >
                </select>
                <button
                    @click="enrollInProgram"
                    class="border-2 border-black p-2 m-2"
                    type="submit"
                >
                    Enroll
                </button>
            </div>
        </section>
    </main>
</template>

<script>
import { router } from "@inertiajs/vue3";
import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
export default {
    data() {
        return {
            selectedProgram: ""
        };
    },
    props: {
        student: {
            type: Object,
            required: true
        },
        programs: {
            required: true
        }
    },
    methods: {
        async enrollInProgram() {
            let result = await axios
                .post("/api/enroll", {
                    program_id: this.selectedProgram
                })
                .catch(e => {
                    console.log("error occured " + e);
                });
            Inertia.reload({ only: ["student"] });
        }
    },
    components: { TheAdminHead }
};
</script>

<style></style>
