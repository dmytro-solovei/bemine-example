<template>
  <div id="product-descriptions" class="tab-panel">
    <p>{{description}}</p>
  </div>
</template>

<script>
export default {
  name: "Description",
  props: {
    description: String
  }
}
</script>