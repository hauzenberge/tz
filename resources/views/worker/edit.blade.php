@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel-body">       
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="col-sm-10">

            <!-- Display Validation Errors -->
            @include('common.errors')

            <form class="form-horizontal" role="form" method="POST" action="{{ url('worker/update/'.$worker->id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Имя Сотрудника</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $worker->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Фамилия Сотрудника</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" value="{{ $worker->first_name }}">

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $worker->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Телефон</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" value="{{$worker->phone}}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Компания</label>
                            <div class="col-md-6">
                               <select class="form-control"name="company">
                                   @foreach ($companies as $company)
                                        @if ($company->id == $worker->compny_id)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endif
                                    @endforeach

                                    @foreach ($companies as $company)
                                        @if ($company->id != $worker->compny_id)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('site'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('site') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Обновить сотрудника
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
</div>
</div>
@endsection