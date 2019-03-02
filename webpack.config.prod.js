const path = require('path');
const MiniCssExtractPlugin  = require('mini-css-extract-plugin');
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");const CleanPlugin = require('clean-webpack-plugin');

module.exports  = {
    entry: {
        app: path.resolve(__dirname, './frontend/web/source/js/app.js')
    },
    output: {
        filename: 'js/[name].js',
		    publicPath: '/',
        path: path.resolve(__dirname, './frontend/web/bundle'),
    },
    optimization: {
        minimizer: [
            new UglifyJsPlugin({
                cache: true,
                parallel: true,
            }),
            new OptimizeCSSAssetsPlugin({})
        ]
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: [/node_modules/],
                use: [
                    {
                        loader: 'babel-loader',
                        options: { presets: ['@babel/preset-env'] }
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
                        loader: 'sass-loader',
                        options: {
                            sourceMap: false
                        }
                    }
                ],
            },
            {
                test: /\.(gif|png|jpe?g|svg)$/i,
                use: [{
                    loader: 'url-loader',
                    options: {
                        limit: 5000,
                        name: 'images/[name].[ext]',
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
    plugins: [
        new CleanPlugin('./frontend/web/bundle'),
        new MiniCssExtractPlugin({
            filename: "css/[name].css"
        })
    ],
    devtool: 'source-map'
};
