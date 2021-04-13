@extends('layout')

@section('content')
    <div class="row">
        Het ontsleutelde bericht:
        </br>
        {{$decryptedMessage}}
    </div>
    <div>
        <form action="{{url('/delete')}}" method="post">
            <input type="hidden" value="{{$id}}" name="id">
            <button type="submit" class="btn btn-primary">Verwijder bericht</button>
        </form>
    </div>
@endsection
