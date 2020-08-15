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
import {defineComponent} from '@vue/composition-api';
type Props = {
  statusTexts: string[],
  status_num: number,
}

export default defineComponent({
  props: {
    statusTexts: {type: Array, required: true, default: []},
    status_num: {type: Number,required: false, default: 0},
  },

  setup(props: Props) {
    var status_text: string = props.statusTexts[0];

    function changePostArticleStatus(status_text: string, index: number) {
      $("#post-article-button").text(status_text);
      $("input[name='article_status_id'").val(index);
    }

    return {
      changePostArticleStatus,
      status_text,
    };
  }
})

</script>
