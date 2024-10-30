<script setup>

//Set icon class
const iconClass = 'flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white';

import Dashboard from './components/Dashboard.vue'
import Settings from './components/Settings.vue'
import Stats from './components/Stats.vue'
import Howtouse from './components/Howtouse.vue'

//Define the items here
const admin_items = [
    { name: 'Dashboard', component: Dashboard, icon: '<svg class="' + iconClass + '" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M4 13h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1zm-1 7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v4zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v7zm1-10h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1z"/></svg>'},
    { name: 'Settings', component: Settings, icon: '<svg class="' + iconClass + '" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h48v48H0z" fill="none"/><path d="M38.86 25.95c.08-.64.14-1.29.14-1.95s-.06-1.31-.14-1.95l4.23-3.31c.38-.3.49-.84.24-1.28l-4-6.93c-.25-.43-.77-.61-1.22-.43l-4.98 2.01c-1.03-.79-2.16-1.46-3.38-1.97L29 4.84c-.09-.47-.5-.84-1-.84h-8c-.5 0-.91.37-.99.84l-.75 5.3c-1.22.51-2.35 1.17-3.38 1.97L9.9 10.1c-.45-.17-.97 0-1.22.43l-4 6.93c-.25.43-.14.97.24 1.28l4.22 3.31C9.06 22.69 9 23.34 9 24s.06 1.31.14 1.95l-4.22 3.31c-.38.3-.49.84-.24 1.28l4 6.93c.25.43.77.61 1.22.43l4.98-2.01c1.03.79 2.16 1.46 3.38 1.97l.75 5.3c.08.47.49.84.99.84h8c.5 0 .91-.37.99-.84l.75-5.3c1.22-.51 2.35-1.17 3.38-1.97l4.98 2.01c.45.17.97 0 1.22-.43l4-6.93c.25-.43.14-.97-.24-1.28l-4.22-3.31zM24 31c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7z"/></svg>'},
    { name: 'Stats', component: Stats, icon: '<svg class="' + iconClass + '" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><title/><path d="M104,496H72a24,24,0,0,1-24-24V328a24,24,0,0,1,24-24h32a24,24,0,0,1,24,24V472A24,24,0,0,1,104,496Z"/><path d="M328,496H296a24,24,0,0,1-24-24V232a24,24,0,0,1,24-24h32a24,24,0,0,1,24,24V472A24,24,0,0,1,328,496Z"/><path d="M440,496H408a24,24,0,0,1-24-24V120a24,24,0,0,1,24-24h32a24,24,0,0,1,24,24V472A24,24,0,0,1,440,496Z"/><path d="M216,496H184a24,24,0,0,1-24-24V40a24,24,0,0,1,24-24h32a24,24,0,0,1,24,24V472A24,24,0,0,1,216,496Z"/></svg>'},
    { name: 'How to use', component: Howtouse, icon: '<svg class="' + iconClass + '" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path d="M0 0h24v24H0z" fill="none"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11v6h2v-6h-2zm0-4v2h2V7h-2z"/></g></svg>'},
];
const admin = ref(admin_items);

import { onMounted, ref, computed, watch } from 'vue'
import { initFlowbite } from 'flowbite'

//For showing/hiding columns
const currentColumn = ref(admin_items[0].name);

// Dynamically determine which component to show based on currentColumn
const currentComponent = computed(() => {
  const activeItem = admin.value.find(item => item.name === currentColumn.value)
  window.ucss_namespace.activeItem = activeItem;//save active item globally
  return activeItem ? activeItem.component : null
})

//Get current component icon
const currentIcon = computed(() => {
  const activeItem = admin.value.find(item => item.name === currentColumn.value)
  return activeItem ? activeItem.icon : null
})

// initialize flowbite on mount
onMounted(() => {
    initFlowbite();
})

/**
 * Allows column changes from within components
 *
 * @param {string} newColumn The name of the new column to show.
 */
function handleColumnChange(newColumn) {
  currentColumn.value = newColumn;  
}

</script>

<template>

  <div class="tailwind">

    <div class="flex flex-col md:flex-row md:gap-4 mt-4">

      <!-- Navigation Column -->
      <div class="">

        <aside id="default-sidebar" class="md:w-64 rounded-lg shadow" aria-label="Sidebar">
          <div class="h-full px-3 pt-4 pb-2 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <p>
              <svg class="flex-shrink-0 w-5 h-5 inline-block mt-[-3px] hover-gradient-ucss fill-raisin" 
                  viewBox="-31.872 -3.842 64.203 26.304" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <defs>
                      <linearGradient id="gradient_ucss" x1="0%" y1="0%" x2="100%" y2="0%">
                          <stop offset="0%" style="stop-color:#06b6d4;stop-opacity:1" />
                          <stop offset="100%" style="stop-color:#3f83f8;stop-opacity:1" />
                      </linearGradient>
                  </defs>                  
                  <g fill="url(#gradient_ucss)" stroke-miterlimit="10" stroke-width="2">
                    <path d="m-29.704 9.172c0-2.688 0.839-4.932 2.515-6.739 1.678-1.805 3.52-3.011 5.533-3.612 0.462-0.161 0.926-0.277 1.389-0.348 0.46-0.071 0.912-0.104 1.352-0.104l24.561-0.034v2.704h-23.834c-2.797 0.277-4.925 1.251-6.382 2.914-1.457 1.664-2.199 3.469-2.222 5.412v0.102c0 0.441 0.06 0.972 0.176 1.598s0.321 1.259 0.625 1.908c0.507 1.158 1.368 2.22 2.582 3.179 1.218 0.96 2.957 1.433 5.223 1.433h2.462v2.639h-3.918c-3.215-0.093-5.696-1.18-7.441-3.265-1.748-2.082-2.62-4.668-2.62-7.75v-0.037z"/>
                    <path d="m-6.46 17.551c0.97 0.023 1.75-0.159 2.339-0.553 0.59-0.396 0.943-1.018 1.058-1.875 0-0.74-0.243-1.422-0.728-2.045-0.486-0.626-1.214-1.184-2.186-1.67-0.186-0.091-0.378-0.181-0.573-0.271-0.198-0.096-0.397-0.193-0.607-0.283-0.022-0.022-0.054-0.039-0.088-0.05-0.033-0.012-0.065-0.028-0.087-0.051-1.711-0.835-3.277-1.728-4.7-2.688-1.42-0.958-2.132-2.269-2.132-3.937 0.023-0.07 0.035-0.127 0.035-0.175 0-0.045 5e-3 -0.079 0.016-0.104 0.012-0.023 0.018-0.046 0.018-0.069 0-1.605 0.458-2.816 1.373-3.63 0.911-0.816 1.911-1.349 2.997-1.606 0.165-0.047 0.331-0.082 0.505-0.104 0.173-0.026 0.339-0.048 0.503-0.071l7.63-0.034v2.704h-7.145c-0.811 0.023-1.457 0.275-1.941 0.746-0.486 0.474-0.788 1.002-0.904 1.578 0 0.093-6e-3 0.181-0.017 0.262-0.012 0.08-0.017 0.155-0.017 0.224 0 0.325 0.082 0.642 0.242 0.954 0.161 0.313 0.381 0.564 0.658 0.745 0.949 0.672 1.84 1.219 2.672 1.632 0.833 0.417 1.607 0.795 2.324 1.145 0.209 0.112 0.409 0.226 0.607 0.328 0.194 0.102 0.386 0.213 0.573 0.327 0.161 0.096 0.328 0.193 0.503 0.301 0.172 0.102 0.341 0.209 0.501 0.327 0.718 0.536 1.381 1.203 1.997 2.016 0.612 0.807 0.917 1.812 0.917 3.015 0 0.305-0.017 0.632-0.05 1.004-0.035 0.373-0.111 0.745-0.226 1.113-0.253 0.896-0.781 1.714-1.577 2.444-0.799 0.726-2.053 0.811-3.764 0.811h-0.104-0.104-0.034c-0.048 0-0.093-0.011-0.141-0.022-0.045-0.012-0.079-0.012-0.103-0.012l-8.118-0.038v-2.388h7.878z"/>
                    <path d="m9.634 17.551c0.971 0.023 1.751-0.159 2.337-0.553 0.594-0.396 0.948-1.018 1.062-1.875 0-0.74-0.243-1.422-0.729-2.045-0.484-0.626-1.213-1.184-2.185-1.67-0.184-0.091-0.377-0.181-0.571-0.271-0.199-0.096-0.398-0.193-0.607-0.283-0.023-0.022-0.055-0.039-0.087-0.05-0.035-0.012-0.066-0.028-0.088-0.051-1.711-0.835-3.277-1.728-4.701-2.688-1.419-0.959-2.131-2.269-2.131-3.937 0.022-0.07 0.034-0.128 0.034-0.175 0-0.045 6e-3 -0.079 0.017-0.104 0.012-0.023 0.017-0.046 0.017-0.069 0-1.605 0.458-2.816 1.371-3.63 0.912-0.816 1.911-1.349 2.999-1.606 0.162-0.048 0.33-0.083 0.505-0.104 0.172-0.026 0.337-0.048 0.5-0.071l7.631-0.034v2.704h-7.144c-0.81 0.023-1.457 0.275-1.942 0.746-0.484 0.474-0.786 1.002-0.903 1.578 0 0.093-6e-3 0.181-0.016 0.262-0.012 0.08-0.018 0.155-0.018 0.224 0 0.325 0.083 0.642 0.243 0.954 0.16 0.313 0.381 0.564 0.658 0.745 0.949 0.672 1.84 1.219 2.674 1.632 0.832 0.417 1.606 0.795 2.322 1.145 0.209 0.112 0.412 0.226 0.605 0.328 0.197 0.102 0.389 0.213 0.576 0.327 0.158 0.096 0.327 0.193 0.502 0.301 0.174 0.102 0.343 0.209 0.502 0.327 0.717 0.536 1.377 1.203 2 2.016 0.607 0.807 0.914 1.812 0.914 3.015 0 0.305-0.018 0.632-0.052 1.004-0.033 0.373-0.107 0.745-0.225 1.113-0.255 0.897-0.785 1.715-1.576 2.445-0.803 0.726-2.054 0.811-3.766 0.811h-0.107-0.102-0.035c-0.044 0-0.088-0.011-0.14-0.022-0.044-0.012-0.078-0.012-0.102-0.012l-8.119-0.038v-2.388h7.877z"/>
                    <path d="m30.159 9.208c0 3.083-0.87 5.669-2.62 7.749-1.743 2.084-4.225 3.17-7.441 3.264h-33.84v-2.639h32.384c2.264 0 4.004-0.473 5.222-1.432 1.214-0.957 2.078-2.02 2.586-3.174 0.299-0.651 0.507-1.286 0.622-1.912 0.119-0.626 0.174-1.156 0.174-1.598v-0.102c-0.023-1.943-0.762-3.748-2.218-5.412-1.458-1.663-3.592-2.637-6.386-2.914h-11.012v-2.704l11.313 0.034c0.441 0 1.319 0.033 1.777 0.104 0.462 0.071 0.926 0.187 1.389 0.348 2.013 0.601 3.861 1.807 5.538 3.612 1.676 1.807 2.513 4.051 2.513 6.739v0.037z"/>
                  </g>
              </svg>
              <span class="text-[#1B1725] inline-block ml-1">Speedify CSS</span> <small>v{{ version }}</small>
            </p>
          </div>
          <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
              <ul class="space-y-2 font-medium">

                <li v-for="(doc, index) in admin" :key="index">
                  <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group" 
                    :class="(currentColumn === doc.name ? 'bg-gray-100' : '')"
                    @click.prevent="currentColumn = doc.name" 
                    >
                    <span v-html="doc.icon"></span>
                    <span class="ml-3">{{ doc.name }}</span>
                  </a>
                </li>

              </ul>
          </div>
        </aside>

      </div>

      <!-- Content Column -->
      <div class="w-full shadow bg-white content-column">

          <transition
            enter-active-class="transition-all duration-200 ease-out"
            enter-from-class="opacity-0 transform translate-x-2"
            enter-to-class="opacity-100 transform translate-x-0"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 transform translate-x-0"
            leave-to-class="opacity-0 transform translate-x-2"
            mode="out-in"
          >             
          
          <!-- Display only the current component -->
          <component
            :is="currentComponent"
            :currentColumn="currentColumn"
            class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 text-left"
            :iconclass="iconClass"
            :icon="currentIcon"
            @changeColumn="handleColumnChange"
            >
          </component>                                                   

        </transition>

      </div>

    </div>

    
  </div>

</template>

<script>
export default {
  data() {
    return {
      version: window.ucss_namespace.version,
    }
  }
}
</script>


