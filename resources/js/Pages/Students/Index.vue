<script setup>
import { computed, ref } from 'vue';
import DangerButton from "@/Components/DangerButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps(["students"]);

const form = useForm({
    firstname: "",
    lastname: "",
});

const deleteStudent = (studentId) => {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet élève ?")) {
        Inertia.delete(route("students.destroy", studentId), {
            onSuccess: () => {
                props.students = props.students.filter(
                    (student) => student.id !== studentId
                );
            },
        });
    }
};

const searchQuery = ref("");

const filteredStudents = computed(() => {
    if (!searchQuery.value) {
        return props.students;
    } else {
        const query = searchQuery.value.toLowerCase();
        return props.students.filter(student =>
            student.firstname.toLowerCase().includes(query) ||
            student.lastname.toLowerCase().includes(query)
        );
    }
});

const editingStudentId = ref(null);

const startEditing = (student) => {
    editingStudentId.value = student.id;
    form.firstname = student.firstname;
    form.lastname = student.lastname;
};

const stopEditing = () => {
    editingStudentId.value = null;
};

const saveStudent = (studentId) => {
    if (form.firstname.trim() === "" || form.lastname.trim() === "") {
        return;
    }

    Inertia.put(route("students.update", studentId), form.data, {
        onSuccess: () => {
            stopEditing();
        },
    });
};
</script>

<template>
    <AppLayout title="Liste des élèves">
        <template #header>
            <h2 class="leading-tight">Liste des élèves</h2>
        </template>
        <div class="flex items-center mb-4">
            <p class="italic text-gray-400 ml-4 flex-grow">
                Retrouvez ci-dessous la liste des élèves :
            </p>
            <input
                v-model="searchQuery"
                type="text"
                class="input rounded border-[#1F2D55] w-64"
                placeholder="Rechercher un élève"
            />
        </div>
        <div class="mb-4">
            <Link
                :href="route('students.create')"
                class="flex items-center justify-center transition duration-300 ease-in-out px-6 py-3 mb-8 border-[#1F2D55]/25 border-2 rounded-lg hover:bg-[#1F2D55]/10 hover:border-transparent text-center text-white shadow-sm bg-[#1F2D55]"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="white"
                    class="size-6 mr-2"
                >
                    <path
                        d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                    ></path>
                </svg>
                Ajouter un élève
            </Link>
        </div>
        <div class="md:grid md:grid-cols-2 md:gap-6 space-y-4 md:space-y-0">
            <ul
                class="grid grid-cols-2 divide-y divide-x bg-white shadow sm:rounded-md md:col-span-2"
            >
                <li
                    class="flex items-center justify-between p-4 sm:p-6 hover:bg-[#1F2D55]/10"
                    v-for="student in filteredStudents"
                    :key="student.id"
                >
                    <div class="flex items-center">
                        <!-- Nom et prénom centrés -->
                        <p class="text-center" v-if="editingStudentId !== student.id">{{ student.firstname }} {{ student.lastname }}</p>
                    </div>
                    <div class="flex items-center">
                        <!-- Boutons alignés à la même hauteur -->
                        <template v-if="editingStudentId === student.id">
                            <div class="flex items-center space-x-2">
                                <input
                                    v-model="form.firstname"
                                    type="text"
                                    class="input rounded border-[#62BFC1]"
                                    placeholder="Prénom"
                                />
                                <input
                                    v-model="form.lastname"
                                    type="text"
                                    class="input rounded border-[#62BFC1]"
                                    placeholder="Nom"
                                />
                                <button
                                    @click="saveStudent(student.id)"
                                    class="btn font-semibold text-xl text-white px-4 py-1.5 rounded bg-[#62BFC1]"
                                >
                                    ✓
                                </button>
                                <button
                                    @click="stopEditing"
                                    class="btn font-semibold text-xl text-white px-4 py-1.5 rounded bg-red-600"
                                >
                                    ×
                                </button>
                            </div>
                        </template>
                        <template v-else>
                            <div class="flex items-center space-x-2">
                                <button
                                    @click="startEditing(student)"
                                    class="btn font-semibold text-xl text-white px-4 py-1.5 rounded bg-[#62BFC1]"
                                >
                                    ✎
                                </button>
                                <DangerButton @click="deleteStudent(student.id)">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="#FFFFFF"
                                        class="size-6"
                                    >
                                        <path
                                            d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z"
                                        ></path>
                                    </svg>
                                </DangerButton>
                            </div>
                        </template>
                    </div>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
