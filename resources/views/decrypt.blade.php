@extends('layout')

@section('content')
    <div class="row">
        <form action="{{url('/decrypt')}}" method="post">
            Geef password
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="password" id="password" name="password">
                        <input type="hidden" value="{{$url}}" name="id">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ontsleutel bericht</button>
        </form>
    </div>
@endsection
