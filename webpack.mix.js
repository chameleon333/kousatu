const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js');
mix.ts('resources/ts/app.ts', 'public/js');
mix.sass('resources/sass/style.scss', 'public/css/');
mix.sass('resources/sass/app.scss', 'public/css/');

// mix.webpackConfig({
//     resolve: {
//         extensions: [".js", ".jsx", ".vue", ".ts", ".tsx"],
//         alias: {
//             'vue$': 'vue/dist/vue.esm.js'
//         }
//     },
//     module: {
//         rules: [
//             {
//                 test: /\.tsx$/,
//                 loader: "ts-loader",
//                 options: { appendTsSuffixTo: [/\.vue$/] },
//                 exclude: /node_modules/
//             }
//         ]
//     }
// })

