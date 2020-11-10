<template>
  <div class="">
    <label :for="input" class="block leading-2 ml-r1">
      {{ label }}
    </label>
    <textarea
      :name="input"
      :id="input"
      :value="value"
      :rows="row"
      class="block w-full leading-6 rounded shadow-in my-form-input p-r9 mt-r7 focus:outline-none"
    ></textarea>
  </div>
</template>

<script>
export default {
  props: {
    label: String,
    row: {
      default: 10,
      type: Number,
    },
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