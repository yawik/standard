module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);
    grunt.config.init({
        targetDir: './public',
        nodeModulesPath: __dirname + "/node_modules"
    });

    grunt.loadTasks('./public/modules/YawikDemoSkin');
    grunt.registerTask('default',['yawik:demo']);
};