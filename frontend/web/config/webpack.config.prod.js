const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
//const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const autoprefixer = require('autoprefixer');
const config = require('./config');

const env = {
  mode: "production",
  key: Number(new Date()),
  proxy: config.proxyHost
};

let fs = require('fs');
fs.writeFile("config/env.json", JSON.stringify(env), function (err) {
  if (err) {
    console.log(err);
  }
});

module.exports = {
  entry: ['./source/app.js'],
  mode: 'production',
  output: {
    filename: 'js/app.js',
    publicPath: '/',
    path: config.paths.bundle,
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: [/node_modules/],
        use: [
          {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env']
            }
          }
        ]
      },
      {
        test: /\.scss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: '../'
            }
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: false
            }
          },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  [
                    'autoprefixer',
                    {
                      overrideBrowserslist: ['last 2 versions'],
                      cascade: false
                    },
                  ],
                ],
              },
              sourceMap: false
            }
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: false
            }
          },
        ],
      },
      {
        test: /\.css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: '../'
            }
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: false
            }
          },
        ],
      },
      {
        test: /\.(gif|png|jpe?g|webp)$/i,
        type: 'asset/resource',
        generator: {
          filename: 'images/[name][ext]'
        }
      },
      {
        test: /\.(svg)$/i,
        type: 'asset/resource',
        generator: {
          filename: 'svgs/[name][ext]'
        }
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        type: 'asset/resource',
        generator: {
          filename: 'fonts/[name][ext]'
        }
      }
    ]
  },
  optimization: {
    minimize: false,
  },
  plugins: [
    new CleanWebpackPlugin(),
    new CopyWebpackPlugin({
      patterns: [
        {
          from: './source/favicons', to: './favicons',
        },
      ]
    }),
    new MiniCssExtractPlugin({
      filename: "css/app.css"
    })
  ],
};
