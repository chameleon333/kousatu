
import { shallowMount } from '@vue/test-utils';
import MyComponent from '../../resources/js/components//MyComponent.vue';

const wrapper = shallowMount(MyComponent)

describe('MyComponent', () => {
    it('has a created hook', () => {
        expect(typeof MyComponent.created).toBe('function')
    })

    it('sets the correct default data', () => {
        expect(typeof MyComponent.data).toBe('function')
        const defaultData = MyComponent.data()
        expect(defaultData.message).toBe('hello!')
    })

    it('correctly sets the message when created', () => {
        expect(wrapper.vm.$data.message).toBe('bye!')
    })

    it('render the correct message', () => {
        expect(wrapper.text()).toBe('bye!')
    })
})
