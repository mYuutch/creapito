<template>
    <button @click="applyFilter" :class="badgeClass">
      {{ label }}
    </button>
  </template>
  
  <script setup>
  import { defineProps, computed } from 'vue';
  
  const props = defineProps({
    label: {
      type: String,
      required: true,
    },
    filterKey: {
      type: String,
      required: true,
    },
    filterValue: {
      type: [String, Number],
      required: true,
    },
    selected: {
      type: Boolean,

    },
  });

  const emit = defineEmits(['filter']);
  
  function applyFilter() {
    emit('filter', { key: props.filterKey, value: props.filterValue });
  }
  
  const badgeClass = computed(() => {
    return props.selected ? 'text-white bg-[#C3A181] px-6 py-4 rounded-full' : 'text-[#C3A181] border-2 border-[#C3A181] px-6 py-4 rounded-full';
  });
  </script>
  
  <style scoped>
  .filter-badge {
    /* Add your common styling here */
    @apply px-4 py-2 rounded-md;
  }
  </style>
  