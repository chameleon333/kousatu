// webpack.config.js
var HardSourceWebpackPlugin = require('hard-source-webpack-plugin');

module.exports = {
//   context: // ...
//   entry: // ...
//   output: // ...
  plugins: [
    new HardSourceWebpackPlugin()
  ]
}