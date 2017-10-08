@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    Your balance: {{ $balance }}
                    <form action="{{url('/transfer')}}" method="post">
                        {{ csrf_field() }}
                        Transfer: <input type="number" name="sum" id="sum" min="0">
                        To:
                        <select name="user" id="users">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit">Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
