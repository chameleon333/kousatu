module.exports = {
    moduleFileExtensions: ['js', 'jsx', 'json', 'vue'],
    transform: {
        '^.+\.js$': '<rootDir>/node_modules/babel-jest',
        '.*\.(vue)$': '<rootDir>/node_modules/vue-jest'
    },
}
