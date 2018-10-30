/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
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
            }
        ]
    },
    watch: true
};
