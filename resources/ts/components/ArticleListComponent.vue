<template>
  <div>
    <div class="row">
      <div class="p-3 col-sm-6" v-for="article in list" :key="article.index">
        <div class="card">
          <a v-bind:href="`/articles/${article.id}`">
            <div class="header-image-wrapper">
              <div
                class="header-image-content"
                v-bind:style="{ 'background-image':'url(' + article.header_image + ')' }"
              ></div>
            </div>
          </a>
          <div class="card-haeder w-100 d-flex p-3">
            <div class="ml-2 d-flex flex-column">
              <div class="w-100 d-inline-flex">
                <a v-bind:href="`/users/${article.user_id}`" class="text-secondary">
                  <img
                    v-bind:src="`${article.user.profile_image}`"
                    class="rounded"
                    width="39"
                    height="39"
                  />
                </a>
                <a v-bind:href="`/articles/${article.id}`">
                  <p class="px-1">{{ article.title }}</p>
                </a>
              </div>
              <p class="mb-0">
                <a
                  class="text-secondary"
                  v-bind:href="`/tags/${ tags.id }`"
                  v-for="tags in article.tags"
                  :key="tags.index"
                >
                  <span class="tag-mark">{{ tags.name }}</span>
                </a>
              </p>
              <p class="mb-0 text-secondary">
                <span>by &#064;{{ article.user.screen_name }}</span>
                <span>{{ article.created_at }}</span>
                <span>
                  <i class="far fa-thumbs-up"></i>
                  {{ article.favorites.length }}
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <infinite-loading @infinite="infiniteHandler">
      <div slot="no-more">これ以上記事はありません</div>
      <div slot="no-results">該当する記事がありません</div>
    </infinite-loading>
  </div>
</template>

<script lang="ts">
import {defineComponent} from '@vue/composition-api';
import InfiniteLoading from "vue-infinite-loading";
import axios from "axios";

type Props = {
  api: string,
  page: number,
  list: object[],
}

export default defineComponent({
  components: {
    InfiniteLoading
  },
  props: {
    api: {type: String, required: false, default: "/fetch"},
    list: {type: Array, required: false, default: () => ([])},
    page: {type: Number, required: false, default: 1},
  },
  setup(props:Props) {
    var page = props.page;
    var list = props.list;

    function infiniteHandler($state: {
      loaded: any;
      complete: any;
      reset: any;
      error: any;
    }) {
      axios
      .get(props.api, {
        params: {
          page,
          per_page: 1
        }
      })
      .then(({ data }) => {
        if (props.page <= data.data.length) {
          list.push(...data.data);
          page += 1;
          $state.loaded();
        } else {
          $state.complete();
        }
      });
    }

    return {
      infiniteHandler,
    }
  }
})

</script>
