<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
</script>

<template>
  <AppLayout title="Accueil">
    <template #header>
      <h2 class="leading-tight">Accueil</h2>
    </template>
    <div class="grid grid-cols-3 gap-4 mx-auto p-6 w-full">
      <div class="flex flex-col items-center justify-center w-full h-full">
        <ul
          class="list-none m-0 bg-slate-50 shadow-lg p-8 space-y-8 rounded-2xl"
        >
          <p class="text-center mb-4 text-xl font-bold">Cours</p>
          <li class="mb-2">
            <Link
              :href="route('lessons.index')"
              class="flex flex-col items-center justify-center transition duration-300 ease-in-out p-2 border-[#1F2D55]/25 border-2 rounded-2xl hover:scale-105 text-center hover:shadow-md bg-white"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="#1F2D55"
                class="size-5 mb-2"
              >
                >
                <path
                  d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM19 20V4H5V20H19ZM8 7H16V9H8V7ZM8 11H16V13H8V11ZM8 15H13V17H8V15Z"
                ></path>
              </svg>
              <p class="text-xs font-bold italic">Mes cours</p>
            </Link>
          </li>
          <li class="mb-2">
            <Link
              :href="route('lessons.create')"
              class="flex flex-col items-center justify-center transition duration-300 ease-in-out p-2 border-[#1F2D55]/25 border-2 rounded-2xl hover:scale-105 text-center hover:shadow-md bg-white"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="#1F2D55"
                class="size-5 mb-2"
              >
                >
                <path
                  d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                ></path>
              </svg>
              <p class="text-xs font-bold italic">Ajouter un cours</p>
            </Link>
          </li>
        </ul>
      </div>

      <div class="flex flex-col items-center justify-center w-full h-full">
        <ul
          class="list-none m-0 bg-slate-50 shadow-lg p-8 space-y-8 rounded-2xl"
        >
          <p class="text-center mb-4 text-xl font-bold">Élèves</p>

          <li class="mb-2">
            <Link
              :href="route('students.index')"
              class="flex flex-col items-center justify-center transition duration-300 ease-in-out p-2 border-[#1F2D55]/25 border-2 rounded-2xl hover:scale-105 text-center hover:shadow-md bg-white"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="#1F2D55"
                class="size-5 mb-2"
              >
                >
                <path
                  d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM19 20V4H5V20H19ZM8 7H16V9H8V7ZM8 11H16V13H8V11ZM8 15H13V17H8V15Z"
                ></path>
              </svg>
              <p class="text-xs font-bold italic">Liste des élèves</p>
            </Link>
          </li>
          <li class="mb-2">
            <Link
              :href="route('students.create')"
              class="flex flex-col items-center justify-center transition duration-300 ease-in-out p-2 border-[#1F2D55]/25 border-2 rounded-2xl hover:scale-105 text-center hover:shadow-md bg-white"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="#1F2D55"
                class="size-5 mb-2"
              >
                >
                <path
                  d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                ></path>
              </svg>
              <p class="text-xs font-bold italic">Ajouter des élèves</p>
            </Link>
          </li>
        </ul>
      </div>

      <div class="flex flex-col items-center justify-center w-full h-full">
        <ul
          class="list-none m-0 bg-slate-50 shadow-lg p-8 space-y-8 rounded-2xl"
        >
          <p class="text-center mb-4 text-xl font-bold">Sections</p>

          <li class="mb-2">
            <Link
              :href="route('sections.index')"
              class="flex flex-col items-center justify-center transition duration-300 ease-in-out p-2 border-[#1F2D55]/25 border-2 rounded-2xl hover:scale-105 text-center hover:shadow-md bg-white"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="#1F2D55"
                class="size-5 mb-2"
              >
                >
                <path
                  d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM19 20V4H5V20H19ZM8 7H16V9H8V7ZM8 11H16V13H8V11ZM8 15H13V17H8V15Z"
                ></path>
              </svg>
              <p class="text-xs font-bold italic">Liste des sections</p>
            </Link>
          </li>
          <li class="mb-2">
            <Link
              :href="route('sections.create')"
              class="flex flex-col items-center justify-center transition duration-300 ease-in-out p-2 border-[#1F2D55]/25 border-2 rounded-2xl hover:scale-105 text-center hover:shadow-md bg-white"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="#1F2D55"
                class="size-5 mb-2"
              >
                >
                <path
                  d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                ></path>
              </svg>
              <p class="text-xs font-bold italic">Ajouter une section</p>
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </AppLayout>
</template>
