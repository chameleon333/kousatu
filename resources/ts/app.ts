import Vue from 'vue'
import bootstrap from './bootstrap';
import VueCompositionApi from '@vue/composition-api';
import AppComponent from './components/App.vue';
import ArticleListComponent from './components/ArticleListComponent.vue';
import FavoriteButtonComponent from './components/FavoriteButtonComponent.vue';
import FollowButtonComponent from './components/FollowButtonComponent.vue';
import PostArticleButtonComponent from './components/PostArticleButtonComponent.vue';
import TagsComponent from './components/TagsComponent.vue';

bootstrap();
Vue.use(VueCompositionApi);

const app: any = new Vue({
    el: '#app',
    components: {
        'article-list-component': ArticleListComponent,
        "post-article-button-component": PostArticleButtonComponent,
        "tags-component": TagsComponent,
        // 'favorite-button-component': FavoriteButtonComponent,
        // 'follow-button-component': FollowButtonComponent,
    },
});
