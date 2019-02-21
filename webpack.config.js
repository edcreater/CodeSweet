const path = require('path');
const MiniCssExtractPlugin  = require('mini-css-extract-plugin');
const CleanPlugin = require('clean-webpack-plugin');

module.exports  = {
    entry: {
        app: path.resolve(__dirname, './frontend/web/source/js/app.js'),
        styles: path.resolve(__dirname, './frontend/web/source/scss/styles.scss'),
    },
    output: {
        filename: 'js/[name].js',
		    publicPath: '/',
        path: path.resolve(__dirname, './frontend/web/bundle'),
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
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
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
