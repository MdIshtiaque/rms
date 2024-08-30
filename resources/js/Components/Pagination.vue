<script setup>
import { ChevronDoubleLeftIcon, ChevronDoubleRightIcon, ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline';
import { Link } from "@inertiajs/vue3";

defineProps({
  links: Object,
});
</script>

<template>
  <div>
    <div class="flex flex-col md:flex-row items-center gap-4 justify-between">
      <div class="text-sm text-gray-700 text-center md:text-left">
        Showing <span class="font-medium">{{ links.from }}</span> to <span class="font-medium">{{ links.to }}</span> of <span class="font-medium">{{ links.total }}</span> results
      </div>
      <nav class="flex items-center justify-center space-x-1 w-full md:w-auto" aria-label="Pagination">
        <template v-if="links.first_page_url">
          <Link
            :href="links.first_page_url"
            :class="[
              'p-2 rounded-md transition-colors duration-200',
              links.current_page !== 1 ? 'text-gray-500 hover:bg-gray-100' : 'text-gray-300 cursor-not-allowed'
            ]"
            :tabindex="links.current_page !== 1 ? 0 : -1"
          >
            <span class="sr-only">First</span>
            <ChevronDoubleLeftIcon class="h-5 w-5" aria-hidden="true" />
          </Link>
        </template>
        <template v-else>
          <span class="p-2 rounded-md text-gray-300 cursor-not-allowed">
            <ChevronDoubleLeftIcon class="h-5 w-5" aria-hidden="true" />
          </span>
        </template>

        <template v-if="links.prev_page_url">
          <Link
            :href="links.prev_page_url"
            class="p-2 rounded-md transition-colors duration-200 text-gray-500 hover:bg-gray-100"
          >
            <span class="sr-only">Previous</span>
            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
          </Link>
        </template>
        <template v-else>
          <span class="p-2 rounded-md text-gray-300 cursor-not-allowed">
            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
          </span>
        </template>

        <div class="hidden md:flex items-center space-x-1">
          <template v-for="(link, key) in links.links.slice(1, -1)" :key="key">
            <Link
              v-if="link.url"
              :href="link.url"
              v-html="link.label"
              :class="[
                'px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200',
                link.active ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100'
              ]"
            />
            <span
              v-else
              v-html="link.label"
              class="px-3 py-1 rounded-md text-sm font-medium text-gray-300 cursor-not-allowed"
            />
          </template>
        </div>

        <span class="md:hidden text-sm text-gray-700">
          Page {{ links.current_page }} of {{ links.last_page }}
        </span>

        <template v-if="links.next_page_url">
          <Link
            :href="links.next_page_url"
            class="p-2 rounded-md transition-colors duration-200 text-gray-500 hover:bg-gray-100"
          >
            <span class="sr-only">Next</span>
            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
          </Link>
        </template>
        <template v-else>
          <span class="p-2 rounded-md text-gray-300 cursor-not-allowed">
            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
          </span>
        </template>

        <template v-if="links.last_page_url">
          <Link
            :href="links.last_page_url"
            :class="[
              'p-2 rounded-md transition-colors duration-200',
              links.current_page !== links.last_page ? 'text-gray-500 hover:bg-gray-100' : 'text-gray-300 cursor-not-allowed'
            ]"
            :tabindex="links.current_page !== links.last_page ? 0 : -1"
          >
            <span class="sr-only">Last</span>
            <ChevronDoubleRightIcon class="h-5 w-5" aria-hidden="true" />
          </Link>
        </template>
        <template v-else>
          <span class="p-2 rounded-md text-gray-300 cursor-not-allowed">
            <ChevronDoubleRightIcon class="h-5 w-5" aria-hidden="true" />
          </span>
        </template>
      </nav>
    </div>
  </div>
</template>
