<script setup>
import { ref, defineProps } from "vue";
import { Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import html2canvas from "html2canvas";
import jsPDF from "jspdf";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  lesson: Object,
  student: Object,
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
    route("studentlesson.updaterefuse", [props.lesson.id, props.student.id]),
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
  <Link
    class="cursor-pointer text-white bg-[#1F2D55] p-4 m-4 rounded-lg hover:scale-105"
    :href="route('lessons.index', lesson.id)"
    >{{ lesson.name }}
  </Link>
  <div ref="myRef" class="my-6 border border-black mt-4 p-4">
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
      <!-- Première ligne -->
      <div class="flex border-b border-black h-12">
        <div class="w-full border-r border-black p-2 text-center">
          <p class="text-black font-bold text-poppins text-xl">
            Motivation d'une décision de refus
          </p>
        </div>
      </div>
      <!-- Lignes suivantes -->
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
          <span class="text-center font-bold">UE - Intitulé + Code du DP</span>
        </div>
        <div class="w-3/4 p-2">
          <input
            type="text"
            v-model="lesson.name"
            class="border-2 w-full h-full"
          />
        </div>
      </div>
      <!-- 6ème ligne -->
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
      <!-- 7ème ligne -->
      <div class="flex h-12 border-b border-black">
        <div class="w-48 border-r border-black p-2">
          <span class="text-center font-bold pr-10">Étudiant.e </span>
        </div>
        <div class="w-3/4 p-2 border-b border-black">
          <input
            type="text"
            v-model="student.firstname"
            class="border-2 w-full h-full"
          />
        </div>
      </div>
      <div class="flex h-12 border-b border-black">
        <div class="w-48 border-r border-black p-2">
          <span class="text-center font-bold pr-10"> </span>
        </div>
        <div class="w-3/4 p-2 border-b border-black">
          <input
            type="text"
            v-model="student.lastname"
            class="border-2 w-full h-full"
          />
        </div>
      </div>
    </div>

    <!-- Paragraphe avec une phrase en italique -->
    <p class="italic mt-4 mb-4">
      L'étudiant.e est
      <span class="font-bold underline">refusé.e</span> pour le(s) motif(s)
      suivant(s) ¹ :
    </p>

    <div class="border border-black">
      <!-- Lignes 1 à 5 -->
      <div class="flex border-b border-black" style="height: 200px;">
        <!-- Modification de h-12 à h-16 -->
        <div class="w-4/5 border-r border-black p-2 flex-grow">
          <p class="text-sm">
            - Fraude, plagiat où non-citation des sources dans une épreuve
            certificative de 2ème session
          </p>
          <p class="italic text-sm underline">
            Justification et explication :
            <textarea
              id="justification-explication1"
              placeholder="Entrez votre justification et explication ici"
              class="border-2 w-full mt-2"
              rows="4"
            ></textarea>
          </p>
        </div>
        <div class="w-24 p-2 border-b border-black">
          <input type="checkbox" class="mr-2" />
        </div>
      </div>
      <div class="flex border-b border-black" style="height: 200px;">
        <!-- Modification de h-12 à h-16 -->
        <div class="w-4/5 border-r border-black p-2 flex-grow">
          <p class="text-sm">
            - Fraude, plagiat où non-citation des sources dans une épreuve
            certificative de 1ère session
          </p>
          <p class="italic text-sm underline">
            Justification et explication :
            <textarea
              id="justification-explication2"
              placeholder="Entrez votre justification et explication ici"
              class="border-2 w-full mt-2"
              rows="4"
            ></textarea>
          </p>
        </div>
        <div class="w-24 p-2 border-b border-black">
          <input type="checkbox" class="mr-2" />
        </div>
      </div>
      <!-- 6ème ligne -->
      <div class="flex h-12 border-b border-black">
        <div class="w-4/5 border-r border-black p-2 h-full flex-grow">
          <p class="text-sm">
            Absence(s) à l' (aux) épreuve(s) de 2ème session
          </p>
        </div>
        <div class="w-24 p-2 border-b h-full border-black">
          <input type="checkbox" class="mr-2" />
        </div>
      </div>
      <div class="flex h-12 border-b border-black">
        <div class="w-4/5 border-r h-full border-black p-2 flex-grow">
          <p class="text-sm">
            Non-justification de l'absence à l'épreuve de 1ère session
          </p>
        </div>
        <div class="w-24 p-2 border-b h-full border-black">
          <input type="checkbox" class="mr-2" />
        </div>
      </div>
      <div class="flex h-12 border-b border-black mb-4">
        <div class="w-4/5 border-r border-black p-2 flex-grow">
          <p class="text-sm">
            Acquis d'apprentissage non atteint(s)
          </p>
        </div>
        <div class="w-24 p-2 border-b border-black">
          <input type="checkbox" class="mr-2" />
        </div>
      </div>
    </div>
    <div class="border-t border-black my-4"></div>

    <div class="w-full">
      <!-- Utilisation de w-full pour correspondre à la largeur des conteneurs précédents -->
      <p class="text-sm italic">
        ¹ : Base légale : Décret du 16/1991 organisant l'enseignement de
        promotion sociale - AGCF portant règlement général des études de
        l'enseignement secondaire de promotion sociale du 02/09/2015 - AGCF
        portant règlement général des études de l'enseignement supérieur de
        promotion sociale de type court et de régime 1 du 20/07/1993 -
        Circulaire n°4711 du 09/05/2019 - ROI de l'IFOSUP
      </p>
    </div>
  </div>
  <div class="my-6 border border-black p-4">
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
  </div>

  <div class="border border-black">
    <!-- Lignes 1 à 5 -->
    <div class="flex" style="height: 200px;">
      <!-- Modification de h-12 à h-16 -->
      <div class="w-4/5 border-r border-black p-2 flex-grow">
        <p class="italic text-sm underline">
          Justification et explication : (+joindre la grille d'évaluation)
          <textarea
            id="justification-explication-final"
            placeholder="Entrez votre justification et explication ici"
            class="border-2 w-full mt-2"
            rows="4"
          ></textarea>
        </p>
      </div>
      <div class="w-24 p-2"></div>
    </div>
  </div>

  <div>
    <!-- Utilisation de w-full pour correspondre à la largeur des conteneurs précédents -->
    <p class="my-4 underline">Voies de recours interne² :</p>
    <p class="italic">
      Tout élève a le droit d'introduire un recours écrit contre les décisons de
      fefus prises à son égard par le conseil des études. Ce recours doit
      impérativement mentionner les irrégularités précises qui le motivent.
    </p>
    <p class="italic">
      L'introduction d'un recours interne ne peut se faire que sur base d'une
      plainte écrite adressée par pli recommandé au chef d'établissement ou
      réceptionné(e) par celui-ci contre accusé de réception. Cette plainte doit
      être déposée au plus tard le 4ème jour calendrier qui suit la publication
      des résultats.
    </p>
    <p class="unerline italic">
      L'adresse où la plainte doit être expédiée ou déposée est la suivante :
    </p>
    <div>
      <!-- Lignes 1 à 5 -->
      <div class="flex justify-between items-center h-12 px-40 pt-10 pb-60">
        <p class="font-bold">Le Conseil des Études (nom + titre)</p>
        <p class="font-bold">La Direction</p>
      </div>
    </div>
  </div>
  <div class="border border-black"></div>
  <p class="text-sm italic">
    ² : Uniquement en cas de refus dans une unité d'enseignement ou à
    <span class="font-bold">l'épreuve intégrée</span> (cfr. Base légale)
  </p>
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
</template>
