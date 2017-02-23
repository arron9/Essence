<template>
    <div class="content-wrapper" style="height:916;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                新增内容
                <!-- <small>列表</small> -->
            </h1>
            <ol class="breadcrumb">
                <template v-for="crumb in crumbs">
                    <li><a v-link="{ path: '/creative/list/'+ crumb.id }">
                            <template v-if="$index == 0">
                                <i class="fa fa-dashboard"></i>
                            </template>
                            {[ crumb.title ]}</a></li>
                </template>
                <li class="active">增加内容</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content" id="creative_add_content">

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">新增</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <validator name="validation">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">标题</label>
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="" placeholder="" v-model="title" v-validate:title="['required']">
                                    </div>
                                </div>
                            </div>
                            <component v-for="item in elements | orderBy 'order'" :item="item" :is="item.type">

                            </component>
                            <div class="form-group">
                                <label for="">排序</label>
                                <div class="row">
                                    <div class="col-xs-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-sort-numeric-asc"></i>
                                            </span>
                                            <input type="number" class="form-control" id="" placeholder="" v-model="order">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <pre>{[ $validation | json ]}</pre> -->
                        </div>
                        <!-- /.box-body -->
                        </validator>
                        <div class="box-footer clearfix no-border">
                            <button type="button" class="btn btn-primary" v-on:click="save" :disabled="!(this.validate && $validation.valid)">保存</button>
                        </div>
                    </div>
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </section>
    </div>
</template>

