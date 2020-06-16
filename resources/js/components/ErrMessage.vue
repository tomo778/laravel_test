<template>
  <div v-if="errors" class="err">
    <span>{{ mes }}</span>
  </div>
</template>

<script>
export default {
  props: {
    errors: {
      type: Object,
      required: false,
      default: null
    },
    name: {
      type: String,
      required: true,
    }
  },
  computed: {
    mes() {
      if (this.errors[this.name]) {
        return this.errors[this.name][0];
      }
    }
  }
};
</script>
