@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel-body">       
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="col-sm-10">



            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New Task Form -->
            <form action="{{ url('/tasks') }}" method="POST" class="form-inline">
                {{ csrf_field() }}
                <div class="form-group">
                    <select class="form-control" name="operators[]">
                        @if($operators)
                        @foreach ($operators as $operator)                
                        <option value="{{ $operator->id }}">{{ $operator->email }}</option>
                        @endforeach    
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="operators[]">
                        @if($operators)
                        @foreach ($operators as $operator)                
                        <option value="{{ $operator->id }}">{{ $operator->email }}</option>
                        @endforeach    
                        @endif
                    </select>
                </div>  
                <!-- Add Task Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-btn fa-plus"></i>Добавить в задание
                    </button>
                </div>
            </form>
        </div>
        @if (count($tasks) > 0)
            @foreach ($tasks as $task)
            <div class="col-xs-3" style="margin-top: 20px">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{url('tasks/'.$task->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-xs btn-danger pull-right">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        @if (count($task->items) > 0)
                            @foreach ($task->items as $taskItem)
                                <p class="card-text">
                                    <div>{{ $task->getOperatorEmailById($operators, $taskItem->operator_id) }}</div>
                                    <form action="{{url('task-item/' . $taskItem->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <input name="shift" placeholder="Shift" value="{{ date('H:i', strtotime($taskItem->shift)) }}" pattern="^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$"/>
                                        <button type="submit" id="update-task-{{ $task->id }}" class="btn btn-info">
                                            Save
                                        </button>
                                    </form>
                                </p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @endif
</div>
</div>
@endsection