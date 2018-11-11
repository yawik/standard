module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);
    grunt.config.init({
        targetDir: './public',
        nodeModulesPath: __dirname + "/node_modules"
    });

    grunt.loadTasks('./public/modules/Core');
    grunt.registerTask('default',['yawik:core']);
};