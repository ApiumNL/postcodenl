/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const CSSNano = require('cssnano');

module.exports = {
    mode: 'production',
    entry: {
        front: __dirname + '/views/js/front/main.js'
    },
    output: {
        path: __dirname + '/views/',
        filename: 'js/[name].bundle.js'
    },
    module: {
        rules: [
            {
                test: /.js$/,
                use: {
                    loader: 'babel-loader'
                },
                exclude: /node_modules/
            },
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract('css-loader')
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin('css/[name].styles.css'),
        new OptimizeCssAssetsPlugin({
            cssProcessor: CSSNano,
            cssProcessorPluginOptions: {
                preset: [
                    'default',
                    {
                        discardComments: {
                            removeAll: true
                        }
                    }
                ],
            },
            canPrint: true
        })
    ],
    watch: true
};
