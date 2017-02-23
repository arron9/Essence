Bootstrap = require('Bootstrap');
AdminLTE = require('AdminLTE');
Vue = require('Vue');
vueResource = require('vueResource');
VueValidator = require('VueValidator');
VueRouter = require('VueRouter');
VueTreeView = require('VueTreeView');

Vue.use(vueResource);
Vue.use(VueValidator);
Vue.use(VueRouter);
console.log(VueRouter);

Vue.component("treeview",Vue.extend(VueTreeView));

Vue.config.delimiters = ['{[', ']}']; // 修改文本插值的定界符。
Vue.config.unsafeDelimiters = ['{!!', '!!}']; // 修改原生 HTML 插值的定界符。默认值： ["{{{", "}}}"]

var Signup = Vue.extend(require('Signup'));
var Home = Vue.extend(require('Home'));
var HomeAdd = Vue.extend(require('HomeAdd'));

var router = new VueRouter();
router.redirect({
    '/': '/home'
});

router.map({
    '/discover/' :{
        component: Signup 
    },
    '/home/' :{
        component: Home 
    },
    '/home/add/' :{
        component: HomeAdd 
    },

});

var App = Vue.extend({
    components:{
        'cms-header': require('CmsHeader'),
    },
})

router.start(App, '#cms-router')
