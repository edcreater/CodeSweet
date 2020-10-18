const webpack = require('webpack');
const path = require('path');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const autoprefixer = require('autoprefixer');

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
                    host: 'codesweet.local',
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
                test: /\.scss$/,
                use: ['style-loader', 'css-loader?sourceMap', 'sass-loader?sourceMap'],
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader?sourceMap'],
            },
            {
                test: /\.(gif|png|jpe?g|svg)$/i,
                use: {
                    loader: 'file-loader',
                    options: {
                        name: 'img/[name].[ext]',
                    },
                },
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                use: {
                    loader: 'file-loader',
                    options: {
                        name: 'fonts/[name].[ext]',
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
    externals: {
        jquery: 'jQuery'
    },
    plugins: [
        new StyleLintPlugin({
            context: './frontend/web/source/',
            failOnError: false,
            syntax: 'scss',
        }),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            "window.jQuery": "jquery",
        }),
        new webpack.HotModuleReplacementPlugin(),
    ],
};
