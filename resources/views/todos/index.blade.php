@extends('layouts.app')
@section('title', 'タスク一覧')

@section('content')
<div id="app">
    <div class="panel panel-default">
        <div class="panel-heading">
            <BR />
            <h1>Todos - index</h1>
        </div>
        <hr />
        {{ link_to_route('todos.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
        <hr />
        <br />
        <div class="complete_wrap">
            <a href="#" class="btn btn-outline-primary" v-on:click="change_items(0)">未完
            </a>
            <a href="#" class="btn btn-outline-primary" v-on:click="change_items(1)">完了 
            </a>
        </div>
        <div class="panel-body">
            <!-- form_delete  -->

            <form method="POST" action="/todos/delete" name="form_delete">
                @csrf 
                {{ Form::hidden('delete_id', 0, ["id" => "delete_id"]) }}
            </form>
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>title</th>
                    <th>編集</th>
                    <th>削除</th>
                </thead>
                <!-- -->
                <tbody v-for="todo in todos" v-bind:key="todo.id">
                    <tr>
                        <td>@{{ todo.id }}
                        </td>
                        <td>
                        <h4>
                            <a v-bind:href="'/todos/' + todo.id">@{{ todo.title }}
                            </a>
                            <h5>
                                <span v-if="todo.complete==1" class="badge badge-secondary">完了済
                                </span>
                            </h5>
                        </h4>
                        </td>                        
                        <td>
                            <a v-bind:href="'/todos/' + todo.id + '/edit'"
                             class="btn btn-outline-primary">Edit
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-danger"
                             v-on:click="delete_todo(todo.id)">削除
                            </a>
                        </td>
                    </tr>                    
                </tbody>

            </table>
            <br />
    
            <br />
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
            todos : [],
            items : [],
        },
        methods: {
            getTasks (complete) {
                this.items = []
                axios.get('/api/apitodos')
                .then(res =>  {
                    this.items = res.data
//console.log(res.data )
                    this.convert_todos(this.items, complete)
                })            
            },
            convert_todos(items, complete){
                var ret = []
                items.forEach(function(item){
                    if(item.complete == complete){
                        ret.push(item)
                    }
                });
                this.todos = ret
//console.log(ret);
            },
            change_items(complete){
                this.convert_todos( this.items, complete)
            },
            delete_todo(id){
console.log(id);
                $("#delete_id").val(id);
                document.form_delete.submit();

            },

        }
    });
    </script>
@endsection
