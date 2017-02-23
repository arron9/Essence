var webpack = require('webpack');
var path = require('path');

module.exports = {
    //插件项
    plugins: [
        // new webpack.optimize.CommonsChunkPlugin('./dist/common.js'),
    ],
    //页面入口文件配置
    entry: {
        index : './public/src/js/index.js'
    },
    //入口文件输出配置
    output: {
        filename: './public/dist/main.js'
    },
    module: {
        //加载器配置
        loaders: [
        { test: /\.vue$/, loader: 'vue' },         // 解析.vue文件
        { test: /\.css$/, loader: 'style-loader!css-loader' },
        // { test: /\.js$/, loader: 'jsx-loader?harmony' },
        { test: /\.scss$/, loader: 'style!css!sass?sourceMap'},
        { test: /\.(png|jpg)$/, loader: 'url-loader?limit=8192'},
        { test: /\.(html|tpl)$/, loader: 'html-loader' }, //html模板编译？
        ]
    },
    //其它解决方案配置
    resolve: {
        root: path.resolve('./public/'), //绝对路径
        extensions: ['', '.js', '.json', '.scss', 'vue'],
        alias: {
            Bootstrap:           'libs/bootstrap/dist/js/bootstrap.min.js',
            Signup:              'src/commpents/cms-view/signup/list.vue',
            Home:                'src/commpents/cms-view/index/list.vue',
            HomeAdd:             'src/commpents/cms-view/index/add.vue',
            VueTreeView:         'src/commpents/vue-tree-view/vue-tree-view.vue',
            AdminLTE:            'libs/AdminLTE/dist/js/app.min.js',
            Vue:                 'libs/vue/dist/vue.min.js',
            vueResource:         'libs/vue-resource/dist/vue-resource.min.js',
            VueRouter:            'src/commpents/vue-router/vue-router.js',
            CmsHeader:            'src/commpents/head.vue',
            VueValidator:        'libs/vue-validator/dist/vue-validator.min.js'
        }
    },
    watch: false
}
