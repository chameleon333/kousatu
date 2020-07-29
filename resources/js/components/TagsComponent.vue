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


<script>
import VueTagsInput from "@johmun/vue-tags-input";
export default {
  components: {
    VueTagsInput
  },
  data() {
    //Viewに表示されたタグ名をvueで受け取る
    var tags = new Array();

    tags = $(".parameter_tags")
      .map(function() {
        return { text: $(this).text() };
      })
      .get();

    return {
      tag: "",
      tags: tags,
      maxTags: 5,
      placeholderText: "タグは5つまで登録できます"
    };
  }
};
</script>

<style scoped>
.vue-tags-input {
  max-width: 100%;
}
</style>
