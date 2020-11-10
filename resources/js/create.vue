<template>
  <div class="mt-6 bg-white rounded-md shadow-out mx-r8 px-r01 pt-r8 pb-r02">
    <!-- <div class="mt-r18">
      <my-input label="Title"></my-input>
    </div>
    <div class="mt-r18">
      <my-textarea label="Description"></my-textarea>
    </div> -->
    <file-attachment class="mt-18">
      <input type="file" name="upload" id="upload" multiple />
    </file-attachment>
  </div>
</template>

<script>
import "@github/file-attachment-element";
export default {};
</script>