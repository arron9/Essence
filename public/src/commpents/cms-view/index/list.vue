<template>
<style>
.treeview-custom {
    min-height: 1200px;
    background-color: rgb(34, 45, 50);
border:0px;
overflow:scoll
}
.treeview-custom .node label{
color:rgb(182,199,206);
padding: 1px;
}
.treeview-custom .node.active label {
    font-weight: bold;
color:#333;
}

.treeview-custom .node.active{
    border-radius: 4px;
padding: 1px;
}
.content-wrapper, .main-footer, .right-side{ margin-left:230px; }
</style>

    <div id="tengxunyun_list_content">
    <aside class="main-sidebar" style="">
    <section class="sidebar" id="left_sidebar">
    <input type="hidden" name="category_id" id="category_id" value="{[ $route.params.categoryId ]}">
    <ul class="sidebar-menu">
    <li class="header"><a v-link="{ path: '/home/add'}">增加栏目</a></li>
    <li class="header"><a v-link="{ path: '/discover' }">图片管理</a></li>
    </ul>
    </section>
    </aside>

        <div class="content-wrapper" style="height: 916;">
            <section class="content-header">
                <h1>
后台管理首页{[msg]}
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
<script>
    module.exports = {
        data: function(){
            return {
                items: [],
                msg: 'test msg',
                current_page: 1,
                total_page: 0,
                p_id:'',
                categories:[],
            }
        },
        components: {
        },
methods: {
loadData: function(data){
p_id = 234;
categories = "['123','123','4654']";

              var params = {
current_page: data,
              };
              this.$http.get('api/discover', params, []).then(function(response){
                      var data = response.data.data;
console.log(data);
                      this.items = data.discovers;
                      this.total_page = Math.ceil(data.total_count/10);
                      }, function(response) {
                      alert('请求失败')
                      });
          },
zoomImage: function(id){
               $("#"+id+"-show_image").show()
            },
            zoomhide: function(id){
                $("#"+id+"-show_image").hide()
            },

pass: function(id) {
          var params = {
id: id,
          };

          this.$http.get('/api/discover/pass', params, []).then(function(response){

                  var data = response.data;
                  if (data.code == 0) {
                  alert('操作成功');
                  $("#image"+id).hide();
                  } else {
                  alert(data.message);
                  }
                  }, function(response) {
                  alert('请求失败')
                  });

      },

reject: function(id) {
            var params = {
id: id,
            };

            this.$http.get('/api/discover/reject', params, []).then(function(response){
                    var data = response.data;
                    if (data.code == 0) {
                    alert('操作成功');
                    $("#image"+id).hide();
                    } else {
                    alert(data.message);
                    }

                    }, function(response) {
                    alert('请求失败')
                    });
        },

         },

ready:function(){
          this.loadData(1)
      },
    }
</script>
