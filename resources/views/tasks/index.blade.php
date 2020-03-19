@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')
<div id="app">
    <div class="panel panel-default">
        <div class="panel-heading">
            タスク一覧
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <th>Id</th>
                    <th>タスク名</th>
                    <!-- 
                    <th>完了</th>
                    -->
                    <th>編集</th>
                    <th>削除</th>
                </thead>
                <tbody v-for="task in tasks" v-bind:key="task.id">
                    <tr>
                        <td>@{{ task.id }}
                        </td>
                        <td>
                        <h4>
                            <a v-bind:href="'/tasks/' + task.id">@{{ task.title }}
                            </a>
                        </h4>
                        </td>                        
                        <td>
                            <a v-bind:href="'/tasks/' + task.id + '/edit'">[ edit ]
                            </a>
                        </td>
                    </tr>                    
                </tbody>
            </table>
            <br />
            new:<br />
            {{ link_to_route('tasks.create', '[ create ]' ) }}
            <br />
            <br />
            <!--
            <a href="make/"  class="btn btn-primary ">詳細はこちら </a>
              -->
        </div>
    </div>
</div>
<!-- -->
<script>
new Vue({
    el: '#app',
    created () {
        this.getTasks(0);
    },    
    data: {
        tasks : [],
    },
    methods: {
        getTasks (complete) {
            //get_tasks
            ///api/apitasks
            axios.get('/api/apitasks/get_tasks')
                .then(res =>  {
                    this.tasks = res.data
//console.log(res.data )
            })            
        },
    }
});
</script>
@endsection
