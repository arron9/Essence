<template>
<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>PLU</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>PLU</b>CMS</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle hide" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu" style="float:left;">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a v-link="{ path: '/home' }"class="dropdown-toggle" aria-expanded="false">
                        <i class="fa fa-bars"></i>
                        栏目管理
                    </a>
                </li>
                <li class="dropdown">
                    <a v-link="{ path: '/creative/list/0' }"class="dropdown-toggle" aria-expanded="false">
                        <i class="fa fa-file"></i>
                       内容管理
                    </a>
                </li>
                <li class="">
                    <a v-link="{ path: '/projects' }"class="dropdown-toggle" aria-expanded="false">
                        <i class="fa fa-tasks"></i>
                       项目管理 
                    </a>
                </li>
                <li class="dropdown">
                    <a v-link="{ path: '/tripartite/tengxunyellow/search' }" class="dropdown-toggle" aria-expanded="false">
                        <i class="fa fa-file-movie-o"></i>
                        腾讯鉴黄
                    </a>
                </li>
                <li class="dropdown">
                    <a v-link="{ path: '/discover' }" class="dropdown-toggle" aria-expanded="false">
                        <i class="fa fa-file-movie-o"></i>
                        图片审核
                    </a>
                </li>
 
                <li class="dropdown user user-menu hide">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="hidden-xs">Plucms</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-footer">
                            <div class="">
                                <a href="/auth/logout" class="btn btn-default btn-flat col-xs-12">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
</template>
<script>
    module.exports = {
        data: function() {
            return {
                categories: [],
                p_id:0,
            }
        },
        methods: {
        },
        ready:function(){
        }
    }
</script>
