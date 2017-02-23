<template>
    <div id="tengxunyun_list_content">
    <aside class="main-sidebar" style="">
    <section class="sidebar" id="left_sidebar">
    <input type="hidden" name="category_id" id="category_id" value="{[ $route.params.categoryId ]}">
    <ul class="sidebar-menu">
    <li class="header"><a v-link="{ path: '/' }">栏目管理</a></li>
    <li class="header"><a v-link="{ path: '/discover' }">图片管理</a></li>
    </ul>
    </section>
    </aside>

 
        <div class="content-wrapper" style="height: 916;">
            <section class="content-header">
                <h1>
                用户空间图片审核
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">图片审核</li>
                </ol>
            </section>
            <section class="content" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="box" style="width:auto">
                            <div class="box-body" style="min-width:400px;overflow-x: scroll;white-space: nowrap">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                            <th>ID</th>
                                            <th>userId</th>
                                            <th>用户名称</th>
                                            <th>图片列表</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="image{[item.id]}" class="" v-for="item in items">
                                        <td>{[item.id]}</td>
                                        <td>{[item.user_id]}</td>
                                        <td>{[item.user_name]}</td>
                                        <td>
<div class="row">
<div v-for="image in item.image_urls" class="col-md-2">
<img  src="{[image]}" height="100"  style="margin-bottom:3px; width:100%">
</div>
</div>
</td>
                                        <td>{[item.create_at]}</td>
                                        <td><button type="button" v-on:click="pass(item.id)" class="btn btn-info">通过</button>
<button type="button" v-on:click="reject(item.id)" class="btn btn-Danger">拒绝</button>
</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <vue-nav :cur.sync="current_page" :all.sync="total_page" v-on:btn-click="loadData"></vue-nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

