var webpack = require('webpack');
var path = require('path');

const VueLoaderPlugin = require('vue-loader/lib/plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

// Naming and path settings
var appName = 'build';
var entryPoint = './app.js';
var exportPath = path.resolve(__dirname, './../../../../web/js');

// Enviroment flag
//var plugins = [];
//var env = process.env.WEBPACK_ENV;

//// Differ settings based on production flag
//if (env === 'production') {
//  var UglifyJsPlugin = webpack.optimize.UglifyJsPlugin;
//
//  plugins.push(new UglifyJsPlugin({minimize: true}));
//  plugins.push(new webpack.DefinePlugin({
//    'process.env': {
//      NODE_ENV: '"production"'
//    }
//  }
//  ));
//
//  appName = appName + '.min.js';
//} else {
//  appName = appName + '.js';
//}

  appName = appName + '.js';
// Main Settings config
module.exports = {
  entry: entryPoint,
  output: {
    path: exportPath,
    filename: appName
  },
  module: {
    rules: [
      {
        test: /app\.css$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [{
              loader: 'css-loader',
              options: {
                url: true
              }
            }
          ],
        }),
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              publicPath: '/css/fonts',
              outputPath: '../css/fonts'
            }
          }
        ]
      },
      {
        test: /\.(jpg|png|gif)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              publicPath: '/img/',
              outputPath: '../img/'
            }
          }
        ]
      },      
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader"
        },
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
      {
        test: /\.css$/,
        exclude: /app\.css$/,
        use: [
          'vue-style-loader',
          {
            loader: 'css-loader',
            options: {
              // enable CSS Modules
              modules: true,
              // customize generated class names
              localIdentName: '[local]'
            }
          }
        ]
      }
    ]
  },
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    }
  },
  plugins: [
    // make sure to include the plugin for the magic
    new VueLoaderPlugin(),
    new ExtractTextPlugin({
      filename: '../css/build.css'
    })
  ]
};