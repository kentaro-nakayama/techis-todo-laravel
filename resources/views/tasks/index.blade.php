@extends('layouts.app')

@section('content')

<!-- タスク登録パネル -->
<div class="panel-body">
    <!-- バリデーションエラーの表示 -->
    @include('common.errors')

    <!-- タスク登録フォーム -->
    <form action="{{ url('create') }}" method="post" class="form-horizontal">
        @csrf
        <!-- タスク名 -->
        <div class="form-group">
            <label for="task-name" class="col-sm-3 control-label">Task</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control" placeholder="Enter task name">
            </div>
        </div>
        <!-- タスク追加ボタン -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i>Add Task
                </button>
            </div>
        </div>
    </form>
</div>

<!-- タスク一覧表示 -->
@if (count($tasks) > 0) 
    <div class="panel panel-default">
        <div class="panel-heading">
            Current Tasks
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table">
                <!-- テーブルヘッダー -->
                <thead>
                    <th>Task</th>
                    <th>&nbsp;</th>
                </thead>
                <!-- テーブル本体 -->
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <!-- タスク名 -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>
                            <td>
                                <!-- 削除ボタン -->
                                <form action="{{ url('delete/'.$task->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@endsection
