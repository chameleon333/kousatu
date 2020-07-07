<template>
  <div>
    <button v-if="is_follow" type="submit" class="btn btn-danger" v-on:click="postFollow()">フォロー解除</button>
    <button v-else type="submit" class="btn btn-primary" v-on:click="postFollow()">フォロー</button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["isFollow", "userId"],

  data() {
    return {
      user_id: this.userId,
      is_follow: this.isFollow
    };
  },
  methods: {
    postFollow() {
      if (this.is_follow === undefined) {
        location.href = `/login`;
      } else {
        if (!this.is_follow) {
          axios
            .post(`/users/${this.user_id}/follow`, {})
            .then(({ data }) => {
              this.is_follow = true;
            })
            .catch(err => {
              // console.log("err", err.response.data);
            });
        } else {
          axios
            .delete(`/users/${this.user_id}/unfollow`, {})
            .then(({ data }) => {
              this.is_follow = false;
            })
            .catch(err => {
              // console.log("err", err.response.data);
            });
        }
      }
    }
  }
};
</script>
