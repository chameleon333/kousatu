
import { shallowMount } from '@vue/test-utils';
import ArticleListComponent from '../../resources/js/components/ArticleListComponent.vue';

const wrapper = shallowMount(ArticleListComponent)

describe('ArticleListComponent', () => {

    it('sets the correct default data', () => {
        expect(typeof ArticleListComponent.data).toBe('function')
        const defaultData = ArticleListComponent.data()
        expect(defaultData.page).toBe(1)
    })
})
