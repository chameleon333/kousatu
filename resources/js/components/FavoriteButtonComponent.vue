<template>
    <div class="d-flex align-items-center">
            <button type="submit" class="btn p-0 border-0 text-primary" v-on:click="postFavorite()">
                <i v-if="flag" class="fas fa-thumbs-up"></i>
                <i v-else class="far fa-thumbs-up"></i>
            </button>
        <p class="mb-0 text-secondary">{{ display_favoriteCount }}</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: [
        'favoriteCount',
        'articleId',
        'favoriteId',
    ],

    data() {
        if(!this.favoriteId) {
            var flag = false
        } else {
            var flag = true
        }

        return {
            display_favoriteCount:this.favoriteCount,
            post_favoriteId:this.favoriteId,
            flag: flag,
        };
    },
    methods: {
        postFavorite() {
            if(!this.post_favoriteId) {
                axios.post(`/favorites/`, {
                    article_id: this.articleId,
                }).then(( {data} ) => {
                    this.display_favoriteCount = data["favorited_count"]
                    this.post_favoriteId = data["favorite_id"]
                    this.flag = true
                }).catch(err => {
                    console.log('err', err.response.data)
                });
            } else {
                axios.delete(`/favorites/${this.post_favoriteId}`, {
                }).then(( {data} ) => {
                    this.display_favoriteCount = data["favorited_count"]
                    this.post_favoriteId = data["favorite_id"]
                    this.flag = false
                }).catch(err => {
                    console.log('err', err.response.data)
                });
            }
        },
    },
};

</script>