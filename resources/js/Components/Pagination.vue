<script setup>
import { Link } from "@inertiajs/vue3";
import { ChevronLeftIcon, ChevronRightIcon, ChevronDoubleLeftIcon, ChevronDoubleRightIcon } from '@heroicons/vue/24/outline';

defineProps({
  links: Object,
});
</script>

<template>
  <div class="mt-8">
    <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-between">
      <div class="text-sm text-gray-700 text-center sm:text-left">
        Showing <span class="font-medium">{{ links.from }}</span> to <span class="font-medium">{{ links.to }}</span> of <span class="font-medium">{{ links.total }}</span> results
      </div>
      <nav class="flex items-center justify-center space-x-1 w-full sm:w-auto" aria-label="Pagination">
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
        <Link
          :href="links.prev_page_url"
          :class="[
            'p-2 rounded-md transition-colors duration-200',
            links.prev_page_url ? 'text-gray-500 hover:bg-gray-100' : 'text-gray-300 cursor-not-allowed'
          ]"
          :tabindex="links.prev_page_url ? 0 : -1"
        >
          <span class="sr-only">Previous</span>
          <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
        </Link>
        <div class="hidden sm:flex items-center space-x-1">
          <Link
            v-for="(link, key) in links.links.slice(1, -1)"
            :key="key"
            :href="link.url"
            v-html="link.label"
            :class="[
              'px-3 py-1 rounded-md text-sm font-medium transition-colors duration-200',
              link.active ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100'
            ]"
          />
        </div>
        <span class="sm:hidden text-sm text-gray-700">
          Page {{ links.current_page }} of {{ links.last_page }}
        </span>
        <Link
          :href="links.next_page_url"
          :class="[
            'p-2 rounded-md transition-colors duration-200',
            links.next_page_url ? 'text-gray-500 hover:bg-gray-100' : 'text-gray-300 cursor-not-allowed'
          ]"
          :tabindex="links.next_page_url ? 0 : -1"
        >
          <span class="sr-only">Next</span>
          <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
        </Link>
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
      </nav>
    </div>
  </div>
</template>
