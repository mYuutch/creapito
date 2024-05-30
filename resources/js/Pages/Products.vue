<template>
  <AppLayout title="Products">
    <div class="max-w-7xl mx-auto flex gap-4 gap-y-2 flex-wrap py-12">
      <FilterBadge
        v-for="type in types"
        :key="type.id"
        :label="type.name"
        filterKey="type_id"
        :filterValue="type.id"
        :selected="isSelectedFilter(type.id)"
        @filter="handleFilter"
      />
      {{console.log(products)}}
    </div>
    <div>
      <ProductList v-if="filteredProducts.length" :products="filteredProducts" :links="products.links"/>
      <p v-else>No products found.</p>
      <Pagination v-if="products.links" :links="products.links" class="mx-auto"/>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import ProductList from '../Components/ProductList.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import FilterBadge from '../Components/FilterBadge.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
  products: {
    type: Object,
    required: true,
  },
  types: {
    type: Array,
    required: true,
  },
});

const selectedFilter = ref(null);

const filteredProducts = computed(() => {
  let productsToFilter = props.products;

  // Check if products are paginated
  if (Array.isArray(productsToFilter.data)) {
    productsToFilter = productsToFilter.data; // Assuming 'data' contains the array of products
  }

  if (!selectedFilter.value) {
    return productsToFilter;
  }

  return productsToFilter.filter(product => product[selectedFilter.value.key] === selectedFilter.value.value);
});

function handleFilter(filter) {
  if (selectedFilter.value && selectedFilter.value.key === filter.key && selectedFilter.value.value === filter.value) {
    selectedFilter.value = null; // Reset filter
  } else {
    selectedFilter.value = filter;
  }
}

function isSelectedFilter(filterValue) {
  return selectedFilter.value && selectedFilter.value.key === 'type_id' && selectedFilter.value.value === filterValue;
}
</script>
