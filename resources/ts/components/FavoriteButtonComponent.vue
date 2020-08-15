<template>
  <div class="d-flex align-items-center">
    <button type="submit" class="btn p-0 border-0 text-primary" v-on:click="postFavorite()">
      <i v-if="flag" class="fas fa-thumbs-up"></i>
      <i v-else class="far fa-thumbs-up"></i>
    </button>
    <p class="mb-0 text-secondary">{{ display_favoriteCount }}</p>
  </div>
</template>

<script lang="ts">
import {computed,defineComponent,reactive} from '@vue/composition-api';
import axios from "axios";

type Props = {
  favoriteCount: number,
  articleId: number,
  favoriteId: number,
}

export default defineComponent({
  props: {
    favoriteCount: {type: String, required: true },
    articleId: {type: String, required: true },
    favoriteId: {type: String, required: false },
  },

  setup(props: Props) {

    const state = reactive<{
      display_favoriteCount: number,
      flag: boolean,
    }>({
      display_favoriteCount: props.favoriteCount,
      flag: false,
    })

    state.flag = function() {
      if(!props.favoriteId) {
        return false;
      } else {
        return true;
      }
    }();

    var display_favoriteCount = computed(()=> state.display_favoriteCount);
    var flag = computed(()=> state.flag);
    var post_favoriteId: number = props.favoriteId;

    function postFavorite() {
      if (!state.flag) {
        axios
          .post(`/favorites/`, {
            article_id: props.articleId
          })
          .then(({ data }) => {
            state.display_favoriteCount = data["favorited_count"];
            state.flag = true;
            post_favoriteId = data["favorite_id"];
          })
          .catch(err => {
            console.log("err", err.response.data);
          });
      } else {
        axios
          .delete(`/favorites/${post_favoriteId}`, {})
          .then(({ data }) => {
            state.display_favoriteCount = data["favorited_count"];
            state.flag = false;
            post_favoriteId = data["favorite_id"];
          })
          .catch(err => {
            console.log("err", err.response.data);
          });
      }
    }

    return {
      display_favoriteCount,
      flag,
      postFavorite,
    }
  }

})

</script>
