<template>
  <div>
    <vue-tags-input
      v-model="tag"
      :tags="tags"
      :max-tags="maxTags"
      :placeholder="placeholderText"
      @tags-changed="newTags => tags = newTags"
    />
    <div class="tags">
      <input type="hidden" name="tags[]" v-for="tag in tags" v-bind:value="tag.text" />
    </div>
  </div>
</template>


<script lang="ts">
import {defineComponent,reactive} from '@vue/composition-api';
const VueTagsInput = require("@johmun/vue-tags-input").default;

export default defineComponent({
  components: {
    VueTagsInput,
  },

  setup(){
    var tag: string = "";
    var tags: object = [];
    const maxTags: number = 5;
    const placeholderText: string = "タグは5つまで登録できます";

    tags = $(".parameter_tags")
      .map(function() {
        return { text: $(this).text() };
      })
      .get();

    return {
      tag,
      tags,
      maxTags,
      placeholderText,
    }
  }
})

</script>

<style scoped>
.vue-tags-input {
  max-width: 100%;
}
</style>
