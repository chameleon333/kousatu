import ArticleListComponent from './components/ArticleListComponent.vue';
import bootstrap from './bootstrap';
import FavoriteButtonComponent from './components/FavoriteButtonComponent.vue';
import FollowButtonComponent from './components/FollowButtonComponent.vue';
import PostArticleButtonComponent from './components/PostArticleButtonComponent.vue';
import TagsComponent from './components/TagsComponent.vue';
import Vue from 'vue'
import VueCompositionApi from '@vue/composition-api';

bootstrap();
Vue.use(VueCompositionApi);

const app: any = new Vue({
    el: '#app',
    components: {
        'article-list-component': ArticleListComponent,
        'favorite-button-component': FavoriteButtonComponent,
        'follow-button-component': FollowButtonComponent,
        "post-article-button-component": PostArticleButtonComponent,
        "tags-component": TagsComponent,
    },
});
