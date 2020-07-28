import Vue from 'vue'
import bootstrap from './bootstrap';
import AppComponent from './components/App.vue';
import ArticlListComponent from './components/ArticleListComponent.vue';
import TagsComponent from './components/TagsComponent.vue';
import PostArticleButtonComponent from './components/PostArticleButtonComponent.vue';
import ArticleListComponent from './components/ArticleListComponent.vue';
import FavoriteButtonComponent from './components/FavoriteButtonComponent.vue';
import FollowButtonComponent from './components/FollowButtonComponent.vue';

bootstrap();

const app: any = new Vue({
    el: '#app',
    // render: h => h(AppComponent)
    components: {
        'article-list-component': ArticleListComponent,
        // "tags-component": TagsComponent,
        // "post-article-button-component": PostArticleButtonComponent,
        // 'favorite-button-component': FavoriteButtonComponent,
        // 'follow-button-component': FollowButtonComponent,
    },
});
