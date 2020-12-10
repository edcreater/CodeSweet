const webpack = require('webpack');
const path = require('path');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const autoprefixer = require('autoprefixer');

module.exports = {
    devServer: {
        host: 'localhost',
        hot: true,
        overlay: {
		  warnings: true,
		  errors: true
		},
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
    entry: ['./source/app.js'],
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
                type: 'asset/resource',
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                type: 'asset/resource',
            }
        ]
    },
    output: {
        filename: 'app.js',
        path: path.join(__dirname, './bundle'),
        publicPath: 'http://localhost:8080/',
    },
    externals: {
        jquery: 'jQuery'
    },
    plugins: [
        new StyleLintPlugin({
            failOnError: false,
            syntax: 'scss',
        }),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            "window.jQuery": "jquery",
        }),
    ],
};
