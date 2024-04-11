// Generated using webpack-cli https://github.com/webpack/webpack-cli

const path = require('path');

const isProduction = process.env.NODE_ENV == 'production';

const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');

const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

const config = {
    entry: {
        mainJs: {
            import: "./_dev/js/index.ts",
            filename: 'js/main.js'
        },
        mainCss: {
            import: './_dev/scss/index.scss',
        }
    },
    output: {
        path: path.resolve(__dirname, 'views'),
        assetModuleFilename: 'img/[name][ext]'
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/style.css'
        }),
        new RemoveEmptyScriptsPlugin()
    ],
    module: {
        rules: [
            {
                test: /\.(ts|tsx)$/i,
                loader: 'ts-loader',
                exclude: ['/node_modules/'],
            },
            {
                test: /\.s[ac]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ],
            }, {
                test: /\.(png|jpg|gif|svg)$/,
                type: 'asset/resource'
            }
        ],
    },
    resolve: {
        extensions: ['.tsx', '.ts', '.jsx', '.js', '...'],
    },
};

module.exports = () => {
    if (isProduction) {
        config.mode = 'production';
        config.optimization = {
            minimizer: [
                // For webpack@5 you can use the `...` syntax to extend existing minimizers (i.e. `terser-webpack-plugin`), uncomment the next line
                `...`,
                new CssMinimizerPlugin(),
            ],
            minimize: true,
        };
    } else {
        config.mode = 'development';
    }
    return config;
};
