const webpack = require('webpack');
const path = require('path');
const fs = require('fs');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const CleanTerminalPlugin = require('clean-terminal-webpack-plugin');
const config = require('./config');

const env = {
    mode: "development",
    key: 'dev'
};

fs.writeFile("config/env.json", JSON.stringify(env), function (err) {
    if (err) {
        console.log(err);
    }
});

module.exports = {
    resolve: {
        fallback: {
            "url": require.resolve("url")
        }
    },
    target: "web",
    devServer: {
        static: false,
        server: config.devServer.server,
        host: config.devServer.host,
        port: config.devServer.port,
        allowedHosts: "all",
        headers: {
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, PATCH, OPTIONS",
            "Access-Control-Allow-Headers": "X-Requested-With, content-type, Authorization"
        },
        watchFiles: ['**/*.php'],
    },
    entry: ['./source/app.js'],
    mode: 'development',
    devtool: 'eval',
    module: {
        rules: [
						{
							test: /\.(?:js|mjs|cjs)$/,
							exclude: /node_modules/,
							use: {
								loader: 'babel-loader',
								options: {
									presets: [
										['@babel/preset-env', { targets: "defaults" }]
									]
								}
							}
						},
            {
                test: /\.scss$/,
                include: [
                    path.resolve(config.paths.source, 'scss')
                ],
                use: [
                    'style-loader',
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            api: "modern",
                            sourceMap: true,
                        }
                    }
                ],
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader'],
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
            },
        ]
    },
    output: {
        filename: 'app.js',
        path: config.paths.bundle,
        publicPath: 'https://localhost:8080/',
        assetModuleFilename: 'images/[name][ext][query]'
    },
    externals: {
        jquery: 'jQuery'
    },
    plugins: [
        new CopyWebpackPlugin({
            patterns: [
                {
                    from: './source/favicons', to: './favicons',
                },
            ]
        }),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            "window.jQuery": "jquery",
        }),
        new StyleLintPlugin({
            failOnError: false,
            cacheLocation: '.yarn/.cache/stylelint-webpack-plugin/.stylelintcache'
        })
    ],
};
