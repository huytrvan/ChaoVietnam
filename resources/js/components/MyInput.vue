<template>
  <div class="">
    <label :for="input" class="block leading-2 ml-r1">
      {{ label }}
    </label>
    <input
      type="text"
      :name="input"
      :id="input"
      :value="value"
      class="block w-full rounded shadow-in my-form-input p-r9 mt-r7 focus:outline-none"
    />
  </div>
</template>
<script>
export default {
  props: {
    label: String,
    value: {
      default: "",
      type: String,
    },
  },
  computed: {
    input: function () {
      return this.label.toLowerCase();
    },
  },
};
</script>