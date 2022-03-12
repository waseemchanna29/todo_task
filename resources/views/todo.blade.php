@extends('layouts.app')
@section('title')
My Todo App
@endsection
@section('content')
<div class="card">
    <div class="card-body">


        <div class="row mt-3">
            <div class="col-12 align-self-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>To Do Title</th>
                            <th>Deadline</th>

                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $key=>$todo)
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td>
                                {{$todo->title}}
                            </td>
                            <td>
                                @php
                                $deadline = $todo->date." ". $todo->time;
                                @endphp
                                {{Timezone::convertToLocal(\Carbon\Carbon::parse($deadline))}}
                            </td>
                            <td>
                                {{ $todo->status}}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <ul class="list-group">
                </ul>
            </div>
        </div>
    </div>
</div>

    @endsection
