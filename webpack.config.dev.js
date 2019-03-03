const webpack = require('webpack');
const path = require('path');
const StyleLintPlugin = require('stylelint-webpack-plugin');

module.exports = {
  devServer: {
    contentBase: path.join(__dirname, '/frontend/web/bundle'),
    host: 'localhost',
    hot: true,
    inline: true,
    overlay: true,
    port: 8080,
    proxy: {
      '/': {
        target: {
          host: 'codesweet.loc',
          protocol: "http:"
        },
        changeOrigin: true,
        secure: false
      }
    },
  },
  devtool: 'source-map',
  entry: ['./frontend/web/source/js/app.js'],
  mode: 'development',
  module: {
    rules: [
      {
        test: /\.s[c|a]ss$/,
        use: ['style-loader', 'css-loader', 'sass-loader'],
      },
      {
        test: /\.svg$/,
        use: {
          loader: 'file-loader',
          options: {
            name: '[name].[ext]',
            outputPath: path.join(__dirname, '/bundle'),
            publicPath: 'http://localhost:8080/',
          },
        },
      },
      {
        test: /\.(gif|png|jpe?g|svg)$/i,
        use: [{
          loader: 'url-loader',
          options: {
            limit: 5000,
            name: 'img/[name].[ext]',
          }
        },
        ]
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        use: {
          loader: 'file-loader',
          options: {
            outputPath: 'fonts/',
            name: '[name].[ext]',
            publicPath: '../fonts/'
          }
        }
      }
    ]
  },
  output: {
    filename: 'site.js',
    path: path.join(__dirname, './frontend/web/bundle'),
    publicPath: 'http://localhost:8080/',
  },
  plugins: [
    new StyleLintPlugin({
      context: './frontend/web/source/',
      failOnError: false,
      syntax: 'scss',
    }),
    new webpack.HotModuleReplacementPlugin(),
    new webpack.ProvidePlugin({
      $: "jQuery"
    }),
  ],
};
