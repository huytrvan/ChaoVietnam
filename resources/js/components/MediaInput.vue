<template>
  <div class="">
    <label :for="input" class="block leading-2 ml-r1">
      {{ label }}
    </label>
    <input
      type="file"
      :name="input"
      :id="input"
      multiple
      v-on:click="console.log('hello')"
      class="w-60"
    />
    change5
  </div>
</template>

<script>
import "@github/file-attachment-element";
export default {
  props: {
    label: String,
  },
  computed: {
    input: function () {
      return this.label.toLowerCase();
    },
    handle(event, index) {
      console.log(event.target.files);
      for (i = 0; i < event.target.files.length; i++) {
        console.log(event.target.files[i], index);
      }
    },
  },
};
</script>