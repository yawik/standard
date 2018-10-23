let Encore = require('@symfony/webpack-encore');
let CopyWebpackPlugin = require('copy-webpack-plugin');


Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .addEntry('yawik', './public/modules/Core/yawik.js')
    .addEntry('bootstrap-dialog', './public/modules/Core/bootstrap-dialog.js')

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableLessLoader()
    .autoProvideVariables({
        'global.$': 'jquery',
        jQuery: 'jquery',
        'global.jQuery': 'jquery',
    })
    .addPlugin(new CopyWebpackPlugin([
        {
            from: "./node_modules/tinymce/skins",
            to: "skins"
        }
    ]))
;

const coreConfig = Encore.getWebpackConfig();
coreConfig.name = 'core';
coreConfig.resolve = {
    extensions: ['.js'],
    alias: {
        'jquery-ui/ui/widget': 'blueimp-file-upload/js/vendor/jquery.ui.widget.js'
    }
};


module.exports = coreConfig;