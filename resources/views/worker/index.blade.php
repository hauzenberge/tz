@extends('layouts.app')

@section('content')
<div class="container">
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{url('worker/add')}}" class="btn btn-primary"><i class="fa fa-btn fa-plus"></i>Добавить сотрудника</a>
                </div>
        </div>

        <!-- Current companies -->
        @if (count($workers) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Сотрудники
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                    <th>ID</th>
                    <th>ФИО сотрудника</th>
                    <th>Компания</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    </thead>
                    <tbody>
                        @foreach ($workers as $worker)
                        <tr>
                            <td class="table-text"><div>{{ $worker->id }}</div></td>
                            <td class="table-text"><div>{{ $worker->name }} {{ $worker->first_name }}</div></td>

                            @foreach ($companies as $company)
                                @if ($company->id == $worker->compny_id)
                                    <td class="table-text"><div><a href="{{url('/company/edit/'.$company->id)}}">{{ $company->name }}</a></div></td>
                                @endif
                            @endforeach

                            <td class="table-text"><div>{{ $worker->email }}</div></td>
                            <td class="table-text"><div>{{ $worker->phone }}</div></td>

                            <td><a href="{{url('/worker/edit/'.$worker->id)}}" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Редактировать</a></td>
                            <!-- Task Delete Button -->
                            <td>
                                <form action="{{url('/worker/delete/'.$worker->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-company-{{ $worker->id }}" class="btn btn-danger">
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
        @else
            У компании нет сотрудников
        @endif
    </div>
</div>
@endsection
