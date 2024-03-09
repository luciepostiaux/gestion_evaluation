<script setup>
import { ref, defineProps } from "vue";
import { Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import html2canvas from "html2canvas";
import jsPDF from "jspdf";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
  lesson: Object,
  student: Object,
  note: String,
});

// Référence pour accéder à l'élément du DOM
const myRef = ref(null);
const generatePDF = () => {
  if (myRef.value) {
    const inputs = myRef.value.querySelectorAll("input, textarea, date");
    const replacements = [];

    inputs.forEach((input) => {
      const replacement = document.createElement("span");
      replacement.style.display = "inline-block"; // Assure que le span remplace fidèlement l'input
      if (
        input.type === "text" ||
        input.tagName.toLowerCase() === "textarea" ||
        input.type === "date"
      ) {
        replacement.textContent = input.value; // Utilisé pour tous les types de texte et date
      } else if (input.type === "checkbox") {
        replacement.textContent = input.checked ? "✓" : "✗";
      }
      replacements.push({ input, replacement });
      input.parentNode.replaceChild(replacement, input);
    });

    html2canvas(myRef.value, { scale: 1 }).then((canvas) => {
      replacements.forEach(({ input, replacement }) => {
        replacement.replaceWith(input);
      });
      const imgData = canvas.toDataURL("image/png");
      // Crée un PDF en format paysage ('l'), format A4 ('a4'), en unités 'mm'
      const pdf = new jsPDF("0", "mm", "a4");
      // Calcule les dimensions pour ajuster l'image au format A4 paysage
      const imgWidth = 210; // Largeur d'une page A4 en mode paysage en mm
      const pageHeight = 297; // Hauteur d'une page A4 en mode paysage en mm
      const imgHeight = (canvas.height * imgWidth) / canvas.width;
      let heightLeft = imgHeight;

      // Position initiale
      let position = 0;

      // Ajoute l'image au PDF. Si l'image est plus haute que la page, ajoute des pages supplémentaires
      pdf.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
      heightLeft -= pageHeight;

      while (heightLeft >= 0) {
        position = heightLeft - imgHeight;
        pdf.addPage();
        pdf.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;
      }

      const fileName = `${props.student.firstname}_${props.student.lastname}_${props.lesson.name}.pdf`.replace(
        /\s+/g,
        "_"
      );
      pdf.save(fileName);
    });
  }
};
const validateResult = () => {
  Inertia.visit(
    route("studentlesson.updateaccept", [props.lesson.id, props.student.id]),
    {
      method: "put",
      data: {
        // Données supplémentaires au besoin
      },
    }
  );
};
</script>
<template>
  <AppLayout title="Fiche d'ajournement">
    <template #header>
      <h2 class="leading-tight">Fiche de réussite</h2>
    </template>
    <Link
      class="cursor-pointer text-white bg-slate-800 p-4 m-4 rounded-lg hover:scale-105"
      :href="route('lessons.index', lesson.id)"
      >{{ lesson.name }}
    </Link>
    <div ref="myRef" class="my-6 border border-black p-4">
      <div class="flex">
        <!-- Rectangle de gauche -->
        <div class="w-1/2 border border-black pr-2 py-2">
          <div class="flex items-center justify-center h-full">
            <Link :href="route('dashboard')" class="flex items-center h-full">
              <ApplicationMark class="block h-full w-auto" />
            </Link>
          </div>
        </div>
        <!-- Rectangle de droite -->
        <div class="w-1/2 border border-black pl-2 py-2 font-bold">
          <p class="text-center">Rue de la Limite 6</p>
          <p class="text-center">1300 Wavre</p>
          <p class="text-center">010 22 20 26</p>
        </div>
      </div>

      <!-- Bloc de données -->
      <div class="border border-black mt-4">
        <!-- Première ligne (contenu existant) -->
        <div class="flex h-12 border-b border-black">
          <div class="w-64 border-r border-black p-2">
            <span class="text-center font-bold">Année académique</span>
          </div>
          <div class="w-3/4 p-2">
            <input type="text" class="border-2 w-full h-full" />
          </div>
        </div>
        <div class="flex h-12 border-b border-black">
          <div class="w-64 border-r border-black p-2">
            <span class="text-center font-bold">Date de l'épreuve</span>
          </div>
          <div class="w-3/4 p-2">
            <input
              type="date"
              id="date-epreuve"
              placeholder="Entrez la date de l'épreuve"
              class="border-2 w-full h-full"
            />
          </div>
        </div>
        <div class="flex h-12 border-b border-black">
          <div class="w-64 border-r border-black p-2">
            <span class="text-center font-bold">Date de délibération</span>
          </div>
          <div class="w-3/4 p-2">
            <input
              type="date"
              id="date-deliberation"
              placeholder="Entrez la date de délibération"
              class="border-2 w-full h-full"
            />
          </div>
        </div>
        <div class="flex h-12 border-b border-black">
          <div class="w-64 border-r border-black p-2">
            <span class="text-center font-bold"
              >UE - Intitulé + Code du DP</span
            >
          </div>
          <div class="w-3/4 p-2">
            <input
              type="text"
              v-model="lesson.name"
              class="border-2 w-full h-full"
            />
          </div>
        </div>
        <div class="flex h-12 border-b border-black">
          <div
            class="w-64 flex items-center justify-center border-r border-black"
          >
            <input type="checkbox" class="mr-2" />
            <p class="text-center">UE Déterminante</p>
          </div>
          <div
            class="w-64 flex items-center justify-center border-r border-black"
          >
            <input type="checkbox" class="mr-2" />
            <p class="text-center">Épreuve intégrée</p>
          </div>
          <div class="w-64 flex items-center justify-center border-black">
            <input type="checkbox" class="mr-2" />
            <p class="text-center">Autre</p>
          </div>
        </div>
        <div class="flex h-12 border-b border-black">
          <div class="w-48 border-r border-black p-2">
            <span class="text-center font-bold">Prénom de l'étudiant.e</span>
          </div>
          <div class="w-3/4 p-2">
            <input
              type="text"
              v-model="student.firstname"
              class="border-2 w-full h-full"
            />
          </div>
        </div>
        <div class="flex h-12 border-b border-black">
          <div class="w-48 border-r border-black p-2">
            <span class="text-center font-bold">Nom de l'étudiant.e</span>
          </div>
          <div class="w-3/4 p-2">
            <input
              type="text"
              v-model="student.lastname"
              class="border-2 w-full h-full"
            />
          </div>
        </div>
      </div>

      <!-- Paragraphe avec une phrase en italique -->
      <p class="italic mt-4 mb-4 text-center">
        L'étudiant.e a
        <span class="font-bold underline">réussi</span> avec une note de
        {{ props.note }} %
      </p>
    </div>
    <button
      @click="generatePDF"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
    >
      Enregistrer comme PDF
    </button>
    <form @submit.prevent="validateResult">
      <input type="hidden" name="_method" value="PUT" />
      <!-- Autres champs cachés au besoin -->
      <button
        type="submit"
        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-4"
      >
        Valider le résultat
      </button>
    </form>
  </AppLayout>
</template>
