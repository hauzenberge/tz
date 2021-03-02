@extends('layouts.app')

@section('content')
<div class="container">
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{url('company/add')}}" class="btn btn-primary"><i class="fa fa-btn fa-plus"></i>Добавить компанию</a>
                </div>
        </div>

        <!-- Current companies -->
        @if (count($companies) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Компании
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                    <th>ID</th>
                    <th>Название Компании</th>
                    <th>Email</th>
                    <th>Логотип</th>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                        <tr>
                            <td class="table-text"><div>{{ $company->id }}</div></td>
                            <td class="table-text"><div>{{ $company->name }}</div></td>
                            <td class="table-text"><div>{{ $company->email }}</div></td>
                            <td class="table-text"><div><img src="{{ $company->logo }}" alt="Логотип не загружен" width="100px" height="auto"></div></td>
                            <td class="table-text"><div><a href="{{ $company->site }}" target="_blank">Перейти на сайт</a></div></td>

                            <td><a href="{{url('/company/edit/'.$company->id)}}" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Редактировать</a></td>
                            <!-- Task Delete Button -->
                            <td>
                                <form action="{{url('/company/delete/'.$company->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-company-{{ $company->id }}" class="btn btn-danger">
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
    </div>
</div>
@endsection
