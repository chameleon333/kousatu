<template>
    <div>
        <vue-tags-input
            v-model="tag"
            :tags="tags"
            :max-tags="maxTags"
            :placeholder="placeholderText"
            @tags-changed="newTags => tags = newTags"
            @before-adding-tag="addTagValue"
            @before-deleting-tag="deleteTagValue"
        />
        <div class="tags"></div>
    </div>
</template>


<script>
import VueTagsInput from '@johmun/vue-tags-input';
export default {
    components: {
        VueTagsInput,
    },
    data(){
        return {
            tag: '',
            tags: [],
            maxTags:5,
            placeholderText:'タグを追加する'
        };
    },
    methods:{
        addTagValue(obj){
            var value = obj.tag.text;
            obj.addTag();
            // 要素が存在しなかった場合、追加する
            if(!($('input[value="'+value+'"][name="tags[]"]').length)){
                console.log("append");
                $('.tags').append('<input type="hidden" name="tags[]" value="'+value+'">');
            }
        },
        deleteTagValue(obj){
            var value = obj.tag.text;
            $('input[value="'+value+'"][name="tags[]"]').remove();
            obj.deleteTag();
        }
    },
};
</script>

<style scoped>
    .vue-tags-input{
        max-width: 100%;
    }

</style>