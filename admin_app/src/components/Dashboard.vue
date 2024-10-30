<script setup>
import Skeleton from './../components/Skeleton.vue'
defineProps({
  icon: {
    type: String,
    required: false
  }, 
  iconclass: {
    type: String,
    required: false
  },  
})

import { defineEmits } from 'vue'

const emit = defineEmits(['changeColumn'])

// Function to emit the column change event
function changeColumn(newColumn) {
  emit('changeColumn', newColumn)
}

</script>

<template>
  <div>

    <div v-if="dashboardData" class="flex flex-wrap items-start">

            <div class="w-full p-2 mr-4" >

                <div class="flex items-left mb-4">
                    <span v-html="icon" class="mr-2"></span>
                    <h5 class="text-xl font-bold leading-none text-raisin dark:text-white">Dashboard</h5>
                </div>
                <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
            </div>

            <div class="w-full max-w-lg p-4 ml-2 mr-4 mb-4 bg-white border border-gray-200 rounded-lg shadow" >

                <div class="flow-root">                  

                  <div class="" v-if="dashboardData.cache_data">

                    <div class="flex items-left mb-4">
                      <svg :class="iconclass" class="mr-2"
                          viewBox="-31.872 -3.842 64.203 26.304" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs>
                              <linearGradient id="gradient_ucss" x1="0%" y1="0%" x2="100%" y2="0%">
                                  <stop offset="0%" style="stop-color:#06b6d4;stop-opacity:1" />
                                  <stop offset="100%" style="stop-color:#3f83f8;stop-opacity:1" />
                              </linearGradient>
                          </defs>                  
                          <g stroke-miterlimit="10" stroke-width="2">
                            <path d="m-29.704 9.172c0-2.688 0.839-4.932 2.515-6.739 1.678-1.805 3.52-3.011 5.533-3.612 0.462-0.161 0.926-0.277 1.389-0.348 0.46-0.071 0.912-0.104 1.352-0.104l24.561-0.034v2.704h-23.834c-2.797 0.277-4.925 1.251-6.382 2.914-1.457 1.664-2.199 3.469-2.222 5.412v0.102c0 0.441 0.06 0.972 0.176 1.598s0.321 1.259 0.625 1.908c0.507 1.158 1.368 2.22 2.582 3.179 1.218 0.96 2.957 1.433 5.223 1.433h2.462v2.639h-3.918c-3.215-0.093-5.696-1.18-7.441-3.265-1.748-2.082-2.62-4.668-2.62-7.75v-0.037z"/>
                            <path d="m-6.46 17.551c0.97 0.023 1.75-0.159 2.339-0.553 0.59-0.396 0.943-1.018 1.058-1.875 0-0.74-0.243-1.422-0.728-2.045-0.486-0.626-1.214-1.184-2.186-1.67-0.186-0.091-0.378-0.181-0.573-0.271-0.198-0.096-0.397-0.193-0.607-0.283-0.022-0.022-0.054-0.039-0.088-0.05-0.033-0.012-0.065-0.028-0.087-0.051-1.711-0.835-3.277-1.728-4.7-2.688-1.42-0.958-2.132-2.269-2.132-3.937 0.023-0.07 0.035-0.127 0.035-0.175 0-0.045 5e-3 -0.079 0.016-0.104 0.012-0.023 0.018-0.046 0.018-0.069 0-1.605 0.458-2.816 1.373-3.63 0.911-0.816 1.911-1.349 2.997-1.606 0.165-0.047 0.331-0.082 0.505-0.104 0.173-0.026 0.339-0.048 0.503-0.071l7.63-0.034v2.704h-7.145c-0.811 0.023-1.457 0.275-1.941 0.746-0.486 0.474-0.788 1.002-0.904 1.578 0 0.093-6e-3 0.181-0.017 0.262-0.012 0.08-0.017 0.155-0.017 0.224 0 0.325 0.082 0.642 0.242 0.954 0.161 0.313 0.381 0.564 0.658 0.745 0.949 0.672 1.84 1.219 2.672 1.632 0.833 0.417 1.607 0.795 2.324 1.145 0.209 0.112 0.409 0.226 0.607 0.328 0.194 0.102 0.386 0.213 0.573 0.327 0.161 0.096 0.328 0.193 0.503 0.301 0.172 0.102 0.341 0.209 0.501 0.327 0.718 0.536 1.381 1.203 1.997 2.016 0.612 0.807 0.917 1.812 0.917 3.015 0 0.305-0.017 0.632-0.05 1.004-0.035 0.373-0.111 0.745-0.226 1.113-0.253 0.896-0.781 1.714-1.577 2.444-0.799 0.726-2.053 0.811-3.764 0.811h-0.104-0.104-0.034c-0.048 0-0.093-0.011-0.141-0.022-0.045-0.012-0.079-0.012-0.103-0.012l-8.118-0.038v-2.388h7.878z"/>
                            <path d="m9.634 17.551c0.971 0.023 1.751-0.159 2.337-0.553 0.594-0.396 0.948-1.018 1.062-1.875 0-0.74-0.243-1.422-0.729-2.045-0.484-0.626-1.213-1.184-2.185-1.67-0.184-0.091-0.377-0.181-0.571-0.271-0.199-0.096-0.398-0.193-0.607-0.283-0.023-0.022-0.055-0.039-0.087-0.05-0.035-0.012-0.066-0.028-0.088-0.051-1.711-0.835-3.277-1.728-4.701-2.688-1.419-0.959-2.131-2.269-2.131-3.937 0.022-0.07 0.034-0.128 0.034-0.175 0-0.045 6e-3 -0.079 0.017-0.104 0.012-0.023 0.017-0.046 0.017-0.069 0-1.605 0.458-2.816 1.371-3.63 0.912-0.816 1.911-1.349 2.999-1.606 0.162-0.048 0.33-0.083 0.505-0.104 0.172-0.026 0.337-0.048 0.5-0.071l7.631-0.034v2.704h-7.144c-0.81 0.023-1.457 0.275-1.942 0.746-0.484 0.474-0.786 1.002-0.903 1.578 0 0.093-6e-3 0.181-0.016 0.262-0.012 0.08-0.018 0.155-0.018 0.224 0 0.325 0.083 0.642 0.243 0.954 0.16 0.313 0.381 0.564 0.658 0.745 0.949 0.672 1.84 1.219 2.674 1.632 0.832 0.417 1.606 0.795 2.322 1.145 0.209 0.112 0.412 0.226 0.605 0.328 0.197 0.102 0.389 0.213 0.576 0.327 0.158 0.096 0.327 0.193 0.502 0.301 0.174 0.102 0.343 0.209 0.502 0.327 0.717 0.536 1.377 1.203 2 2.016 0.607 0.807 0.914 1.812 0.914 3.015 0 0.305-0.018 0.632-0.052 1.004-0.033 0.373-0.107 0.745-0.225 1.113-0.255 0.897-0.785 1.715-1.576 2.445-0.803 0.726-2.054 0.811-3.766 0.811h-0.107-0.102-0.035c-0.044 0-0.088-0.011-0.14-0.022-0.044-0.012-0.078-0.012-0.102-0.012l-8.119-0.038v-2.388h7.877z"/>
                            <path d="m30.159 9.208c0 3.083-0.87 5.669-2.62 7.749-1.743 2.084-4.225 3.17-7.441 3.264h-33.84v-2.639h32.384c2.264 0 4.004-0.473 5.222-1.432 1.214-0.957 2.078-2.02 2.586-3.174 0.299-0.651 0.507-1.286 0.622-1.912 0.119-0.626 0.174-1.156 0.174-1.598v-0.102c-0.023-1.943-0.762-3.748-2.218-5.412-1.458-1.663-3.592-2.637-6.386-2.914h-11.012v-2.704l11.313 0.034c0.441 0 1.319 0.033 1.777 0.104 0.462 0.071 0.926 0.187 1.389 0.348 2.013 0.601 3.861 1.807 5.538 3.612 1.676 1.807 2.513 4.051 2.513 6.739v0.037z"/>
                          </g>
                      </svg>
                      <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">Unused CSS Mode - 
                        <span v-if="mode == 'disabled'" class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Disabled</span>
                        <span v-if="mode == 'enabled'" class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Enabled</span>
                        <span v-if="mode == 'preview'" class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-700 dark:text-yellow-300">Preview Mode</span>
                        <span v-if="mode == 'stats'" class="bg-indigo-200 text-indigo-900 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-800 dark:text-indigo-300">Stats Only</span>
                      </h5>
                    </div>
                    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

                    <div class="grid grid-cols-[20px_1fr] gap-4">

                        <div class="w-[20px]">
                          <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-blue-500 bg-blue-100 rounded-lg dark:text-blue-300 dark:bg-blue-900">
                              <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g><path d="M0 0h24v24H0z" fill="none"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11v6h2v-6h-2zm0-4v2h2V7h-2z"/></g></svg>
                              <span class="sr-only">Info icon</span>
                          </div>
                        </div>
                        <div class="flex-1 ms-3 text-sm font-normal">
                            <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">
                                <span v-if="mode == 'enabled'">Complete functionality enabled</span>
                                <span v-if="mode == 'preview'">Just enabled for admins</span>
                                <span v-if="mode == 'stats'">Will just gather stats</span>
                                <span v-if="mode == 'disabled'">No replacements are made, you can just view existing stats</span>
                            </span>
                            <div class="mb-2 text-sm font-normal" v-if="mode == 'enabled'">Every new page view will generate unused CSS. Subsequent page views will use new CSS.</div> 
                            <div class="mb-2 text-sm font-normal" v-if="mode == 'preview'">As an admin you can view pages, test CSS and adjust. Users will get normal CSS.</div> 
                            <div class="mb-2 text-sm font-normal" v-if="mode == 'stats'">Plugin is just gathering stats. <a href="#" @click.prevent="changeColumn('Stats')">View them here.</a></div> 
                            <div class="mb-2 text-sm font-normal" v-if="mode == 'disabled'">Plugin will not change CSS in any way</div> 
                        </div>
                        <div class="w-[200px]">
                            <a 
                            @click.prevent="changeColumn('Settings')"
                            href="#" 
                            class="inline-flex justify-center w-xs px-2 py-1.5 text-xs font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white hover:shadow-md"
                            >
                              <svg class="flex-shrink-0 w-4 h-4 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white no-gradient mr-1" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h48v48H0z" fill="none"></path><path d="M38.86 25.95c.08-.64.14-1.29.14-1.95s-.06-1.31-.14-1.95l4.23-3.31c.38-.3.49-.84.24-1.28l-4-6.93c-.25-.43-.77-.61-1.22-.43l-4.98 2.01c-1.03-.79-2.16-1.46-3.38-1.97L29 4.84c-.09-.47-.5-.84-1-.84h-8c-.5 0-.91.37-.99.84l-.75 5.3c-1.22.51-2.35 1.17-3.38 1.97L9.9 10.1c-.45-.17-.97 0-1.22.43l-4 6.93c-.25.43-.14.97.24 1.28l4.22 3.31C9.06 22.69 9 23.34 9 24s.06 1.31.14 1.95l-4.22 3.31c-.38.3-.49.84-.24 1.28l4 6.93c.25.43.77.61 1.22.43l4.98-2.01c1.03.79 2.16 1.46 3.38 1.97l.75 5.3c.08.47.49.84.99.84h8c.5 0 .91-.37.99-.84l.75-5.3c1.22-.51 2.35-1.17 3.38-1.97l4.98 2.01c.45.17.97 0 1.22-.43l4-6.93c.25-.43.14-.97-.24-1.28l-4.22-3.31zM24 31c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7z"></path></svg> Change Settings
                            </a> 
                        </div>                      

                    </div>


                  </div>
                  <!-- Loading skeleton -->
                  <div class="flex flex-wrap mt-4" v-else>

                      <Skeleton />

                  </div>                  


                </div>
            </div>        
        
            <div class="w-full max-w-sm p-4 ml-2 mr-4 mb-4 bg-white border border-gray-200 rounded-lg shadow " >
                <div class="flex items-left mb-4">
                    <svg :class="iconclass" class="mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19,12 L19,8.62081119 C17.3445598,9.50508911 14.8145288,10 12,10 C9.18547122,10 6.65544022,9.50508911 5,8.62081119 L5,12.0000003 C5,12.8370203 8.10127922,14 12,14 C15.8987208,14 19,12.8370203 19,12 Z M19,14.6208112 C17.3445598,15.5050891 14.8145288,16 12,16 C9.18547122,16 6.65544022,15.5050891 5,14.6208112 L5,18 C5,18.8370203 8.10127922,20 12,20 C15.8987208,20 19,18.8370203 19,18 L19,14.6208112 Z M3,6 C3,3.52331179 7.06216478,2 12,2 C16.9378352,2 21,3.52331179 21,6 L21,18 C21,20.4766882 16.9378352,22 12,22 C7.06216478,22 3,20.4766882 3,18 L3,6 Z M12,8 C15.8987208,8 19,6.83702029 19,6 C19,5.16297971 15.8987208,4 12,4 C8.10127922,4 5,5.16297971 5,6 C5,6.83702029 8.10127922,8 12,8 Z" fill-rule="evenodd"/></svg>
                    <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">Cache Status</h5>
                    <svg @click="refreshCache" v-if="!refreshing" class="flex-shrink-0 w-4 h-4 inline-block mt-[-1px] cursor-pointer ml-auto no-gradient" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 3v2a5 5 0 0 0-3.54 8.54l-1.41 1.41A7 7 0 0 1 10 3zm4.95 2.05A7 7 0 0 1 10 17v-2a5 5 0 0 0 3.54-8.54l1.41-1.41zM10 20l-4-4 4-4v8zm0-12V0l4 4-4 4z"/></svg>
                    <svg v-if="refreshing" class="flex-shrink-0 w-4 h-4 inline-block mt-[-1px] animate-spin ml-auto no-gradient" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 3v2a5 5 0 0 0-3.54 8.54l-1.41 1.41A7 7 0 0 1 10 3zm4.95 2.05A7 7 0 0 1 10 17v-2a5 5 0 0 0 3.54-8.54l1.41-1.41zM10 20l-4-4 4-4v8zm0-12V0l4 4-4 4z"/></svg>
                </div>
                 <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="flow-root">                  

                  <div class="ml-0" v-if="dashboardData.cache_data">
                    <p>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tr>
                                <td>Unique CSS files</td>
                                <td class="text-right">{{ dashboardData.cache_data.num_css_files }}</td>
                            </tr>
                            <tr>
                                <td>Number of pages</td>
                                <td class="text-right">{{ dashboardData.cache_data.num_lookup_files }}</td>
                            </tr>
                        </table>
                    </p>
                    <button @click="clearCache" type="submit" class="mt-4 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg bg-gradient-to-br from-cyan-500 to-blue-500 hover:bg-gradient-to-bl hover:shadow-md">
                      <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md text-cyan-700">
                        <svg v-if="clearing.spinner" aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin mt-[-3px]" viewBox="0 0 100 101" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" />
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" />
                        </svg>                        
                        <transition
                          enter-active-class="transition-opacity duration-700 ease-out"
                          enter-from-class="opacity-0"
                          enter-to-class="opacity-100"
                          leave-active-class="transition-opacity duration-0"
                          leave-from-class="opacity-100"
                          leave-to-class="opacity-0"
                          mode="out-in"
                        >                          
                          <svg v-if="clearing.success" class="inline w-4 h-4 me-3 text-white mt-[-3px] no-gradient" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g><polygon class="st0" points="434.8,49 174.2,309.7 76.8,212.3 0,289.2 174.1,463.3 196.6,440.9 196.6,440.9 511.7,125.8 434.8,49" fill="#41AD49" /></g>
                          </svg> 
                          <svg v-if="clearing.failure" class="inline w-4 h-4 me-3 text-white mt-[-3px] no-gradient" viewBox="0 0 612 792" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g><polygon class="st0" points="382.2,396.4 560.8,217.8 484,141 305.4,319.6 126.8,141 50,217.8 228.6,396.4 50,575 126.8,651.8    305.4,473.2 484,651.8 560.8,575 382.2,396.4  " fill="#E44061"/></g>
                          </svg>                                                                     
                        </transition>
                        <span v-if="clearing.text">Clearing</span><span v-else>Clear Cache</span>
                        
                      </span>
                    </button>

                  </div>
                  <!-- Loading skeleton -->
                  <div class="flex flex-wrap mt-4" v-else>

                      <Skeleton />

                  </div>                  


                </div>
            </div>  

            <div class="w-full max-w-lg p-4 ml-2 mr-4 mb-4 bg-white border border-gray-200 rounded-lg shadow " >
                <div class="flex items-left mb-4">                    
                    <svg :class="iconclass" class="mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11v6h2v-6h-2zm0-4v2h2V7h-2z"></path></g></svg>
                    <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">Documentation</h5>
                </div>
                 <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="flow-root p-2">                                                   
                 <p class="text-sm font-normal">Learn best practices on how to use this plugin in our  <a @click.prevent="changeColumn('How to use')" href="">how to use guide.</a></p>
                </div>
            </div>                      

            <div class="w-full max-w-sm p-4 ml-2 mr-4 mb-4 bg-white border border-gray-200 rounded-lg shadow " >
                <div class="flex items-left mb-4">                    
                    <svg :class="iconclass" class="mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11v6h2v-6h-2zm0-4v2h2V7h-2z"></path></g></svg>
                    <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">Get Help</h5>
                </div>
                 <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                <div class="flow-root">                                                   
                    <p class="text-sm font-normal">Want to talk to someone? <a href="#" @click.prevent="openLiveChat()">Click here</a> to chat</p>
                </div>
            </div>           

    </div>
    
    <!-- Loading skeleton -->
    <div class="flex flex-wrap" v-else>

        <Skeleton mr="4" width="max-w-lg" />
        <Skeleton width="max-w-sm" />

    </div>        


  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      dashboardData: null,
      loading: false,
      clearing:{},
      refreshing:false,
      livechat_loaded:false,
      mode: (window.ucss_namespace.config.speed_css.css_mode.value),
      include_patterns: (window.ucss_namespace.config.speed_css.include_patterns.value),
      include_patterns_helper: (window.ucss_namespace.config.speed_css.include_patterns.helper),
    };
  },
  mounted() {
    this.fetchData();
    this.setupLivechat();
    setInterval(() => {
      if((window.ucss_namespace.activeItem.name ?? false) == "Dashboard") {        
        this.refreshCache();
      }
    }, 10000);
    window.addEventListener('beforeunload', this.clearLocalStorage);
  },
  beforeDestroy() {
    window.removeEventListener('beforeunload', this.clearLocalStorage);
  },  
  methods: {
    setupLivechat() {

      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/671a26b52480f5b4f5932801/1iav2edi4';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();

      this.checkTawkBranding();

    },
    checkTawkBranding() {
      let attempts = 0;
      const maxAttempts = 10; // This gives 10 seconds (one attempt per second)
      const interval = 1000; // Interval in milliseconds

      const checkInterval = setInterval(() => {

        for(let i = 0; i < 10; i++) {          
         const iframe = document.querySelectorAll("iframe[title='chat widget']")[i] ?? false;

          if (iframe && iframe.contentDocument) {
            const brandingLink = iframe.contentDocument.querySelector("a.tawk-branding");
            if (brandingLink) {
              iframe.contentDocument.querySelectorAll('a.tawk-branding').forEach(element => {
                element.style.display = 'none';
              });
              clearInterval(checkInterval); // Stop the checking once found
            } 
          } 
        }
        attempts++;
        if (attempts >= maxAttempts) {
          clearInterval(checkInterval); // Stop checking after 10 seconds
        }
      }, interval);
    },    
    openLiveChat() {

      Tawk_API.toggle();
      this.checkTawkBranding();

    },
    fetchData() {
      const cachedData = localStorage.getItem('dashboardData');
      if (cachedData) {
        this.dashboardData = JSON.parse(cachedData);
        return;
      }
      axios.get('/wp-json/unused-css/get_dashboard_data')
        .then(response => {
          this.dashboardData = response.data;
          this.clearing = {};
          this.refreshing = false;
          localStorage.setItem('dashboardData', JSON.stringify(response.data));
        })
        .catch(error => {
          console.error(error);
        });
    },
    clearCache(event) {
      this.clearing.spinner = true;
      this.clearing.text = true;
      axios.get('/wp-json/unused-css/clear_css_cache')
        .then(response => {
          this.setButton('clearing','success');         
          localStorage.removeItem('dashboardData');
          //this.fetchData();          
        })
        .catch(error => {
          this.setButton('clearing','failure');            
          console.error(error);
        });
    }, 
    setButton(button_name, type) {

      const button = this[button_name];

      if(type == "success") {
      
        button.spinner = false;
        button.success = true;
        setTimeout(() => {
          button.text = false;
          button.success = false;
        }, 1000);

      } else if(type == "failure") {
      
        button.spinner = false;
        button.failure = true;
        setTimeout(() => {
          button.text = false;
          button.failure = false;
        }, 1000);         
      }

    },
    refreshCache() {
      this.refreshing = true;
      localStorage.removeItem('dashboardData');
      this.fetchData(); 
    },        
    submitForm(event) {
      
      event.preventDefault();

      this.loading = true; // Set loading to true
      const formData = new FormData(this.$refs.speedForm);
      const formElements = this.$refs.speedForm.elements;

      let formDataJson = {};
      //Force the correct value for checboxed
      Array.from(formElements).forEach((element) => {        
        if (element.type === 'checkbox') {
          formDataJson[element.name] = element.checked;
        } else if (element.type === 'radio') {
          if(element.checked === true) {
            formDataJson[element.name] = element.value;
          }
        } else {
          formDataJson[element.name] = element.value;
        }
      });

      // Encode the values using btoa()
      for (let key in formDataJson) {
        formDataJson[key] = btoa(formDataJson[key]);
      }    

      // Make your AJAX POST request here
      axios.post('/wp-json/unused-css/update_config', formDataJson )
        .then(response => {
          // Handle the response here
          console.log(response.data);
        })
        .catch(error => {
          // Handle any errors here
          console.error(error);
        })
        .finally(() => {
          this.loading = false; // Reset loading state after request completion
        });
    },    
    clearLocalStorage() {
      localStorage.removeItem('dashboardData');
    },    
  },
};
</script>