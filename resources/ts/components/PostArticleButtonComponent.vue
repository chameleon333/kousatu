<template>
  <div class="btn-group">
    <button
      id="post-article-button"
      type="submit"
      class="btn btn-primary"
      onclick="callBody();"
    >{{ status_text }}</button>
    <button
      type="button"
      class="btn btn-light dropdown-toggle dropdown-toggle-split"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <span class="sr-only">ドロップダウンの切替</span>
    </button>
    <input type="hidden" name="article_status_id" v-bind:value="status_num" />
    <div class="dropdown-menu dropdown-menu-right">
      <span
        class="dropdown-item"
        v-for="(status_text,index) in statusTexts"
        :key="status_text"
        v-on:click="changePostArticleStatus(status_text,index)"
      >{{ status_text }}</span>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Emit, Prop, Vue } from "vue-property-decorator";

@Component
export default class PostArticleButtonComponent extends Vue {
  @Prop({ default: "" })
  statusTexts: string[];

  public status_text: string = this.statusTexts[0];
  public status_num: number = 0;

  @Emit("changePostArticleStatus")
  changePostArticleStatus(status_text: string, index: number) {
    $("#post-article-button").text(status_text);
    $("input[name='article_status_id'").val(index);
  }
}
</script>
