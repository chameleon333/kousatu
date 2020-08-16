<template>
  <div>
    <button v-if="is_follow" type="submit" class="btn btn-danger" v-on:click="postFollow()">フォロー解除</button>
    <button v-else type="submit" class="btn btn-primary" v-on:click="postFollow()">フォロー</button>
  </div>
</template>

<script lang="ts">
import {computed,defineComponent,reactive} from '@vue/composition-api';
import axios from "axios";

type Props = {
  isFollow: Boolean,
  userId: String,
}

export default defineComponent({
  props: {
    isFollow: {type: Boolean, required: false},
    userId: {type: String, required: false},
  },
  setup(props: Props){
    const state = reactive<{
      is_follow: Boolean,
    }>({
      is_follow: props.isFollow,
    })
    var is_follow = computed(()=>state.is_follow);
    var userId = props.userId;

    function postFollow(){
      if (state.is_follow === undefined) {
        location.href = `/login`;
      } else {
        if (!state.is_follow) {
          axios
            .post(`/users/${userId}/follow`, {})
            .then(({ data }) => {
              state.is_follow = data;
            })
            .catch(err => {
              console.log("err", err.response.data);
            });
        } else {
          axios
            .delete(`/users/${userId}/unfollow`, {})
            .then(({ data }) => {
              state.is_follow = data;
            })
            .catch(err => {
              console.log("err", err.response.data);
            });
        }
      }
    }
    return {
      postFollow,
      is_follow,
    }
  }
})
</script>
