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
import { Component, Vue } from "vue-property-decorator";
const VueTagsInput = require("@johmun/vue-tags-input").default;
@Component({
  components: {
    VueTagsInput
  }
})
export default class TagsComponent extends Vue {
  public tag: string = "";
  public tags: object;
  public maxTags: number = 5;
  public placeholderText: string = "タグは5つまで登録できます";

  created() {
    this.tags = $(".parameter_tags")
      .map(function() {
        return { text: $(this).text() };
      })
      .get();
  }
}
</script>

<style scoped>
.vue-tags-input {
  max-width: 100%;
}
</style>
