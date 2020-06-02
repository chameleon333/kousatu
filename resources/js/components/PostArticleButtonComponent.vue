<template>
    <div class="btn-group">
        <button id="post-aritcle-button" type="submit" class="btn btn-primary" onclick="callBody();">{{ status_text }}</button>
        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">ドロップダウンの切替</span>
        </button>
        <input type="hidden" name="article_status_id" v-bind:value="status_num">
        <div class="dropdown-menu dropdown-menu-right">
            <span class="dropdown-item" v-for="(status_text,index) in statusTexts" :key="status_text" v-on:click="changePostArticleStatus(status_text,index)">
                {{ status_text }}
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['statusTexts'],
        methods: {
            changePostArticleStatus(status_text,index) {
                $("#post-aritcle-button").text(status_text);
                $('input[name="article_status_id"]').val(index);
            }
        },
        data() {
            return {
                status_text: this.statusTexts[0],
                status_num: 0
            }
        }
    }
</script>