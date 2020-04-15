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
            <input type="hidden" name="tags[]" v-for="parameter_tag in parameter_tags" v-bind:value="parameter_tag.name">
        </div>
    </div>
</template>


<script>
import VueTagsInput from '@johmun/vue-tags-input';
export default {
    components: {
        VueTagsInput,
    },
    data(){
        //Viewに表示されたタグ名をvueで受け取る
        var parameter_tags = new Array();
        var $display_tags = new Array();
        $('.parameter_tags').each(function() {
            $display_tags.push({text:$(this).text()});
            parameter_tags.push({name: $(this).text()});
        });
        return {
            tag: '',
            tags:$display_tags,
            parameter_tags: parameter_tags,
            maxTags:5,
            placeholderText:'タグは5つまで登録できます'
        };
    },
    watch: {
        tags: function(tags) {
            var parameter_tags = new Array();
            tags.forEach(function(tag){
                parameter_tags.push({name: tag.text}); 
            });
            this.parameter_tags = parameter_tags;
        },
    },
};
</script>

<style scoped>
    .vue-tags-input{
        max-width: 100%;
    }

</style>