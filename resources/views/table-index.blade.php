@extends('layout')
@section('content')
<div class="flex justify-between h-2/5 my-8">
        <h2 class="">โต๊ะอาหาร</h2>
        <a href="/table/create">
                <button class="ui button" type="submit" >เพิ่มโต๊ะ</button>
        </a>
</div>
<table class="ui basic table">
        <thead>
          <tr>
            <th>เลขโต๊ะ</th>
            <th>จำนวนทั่งนั่ง</th>
            <th>ประเภท</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
         @foreach($tables as $table)
         <tr>
            <td>{{$table->name}}</td>
            <td>{{$table->seat}}</td>
            <td>{{$table->type->name}}</td>
            <td>
                <a href="/table/edit/{{$table->id}}">
                    <button class="ui compact icon button">
                        <i class="write icon"></i>
                    </button>
                </a>
                <a href="/table/delete/{{$table->id}}">
                    <button class="ui compact icon button">
                        <i class="trash icon"></i>
                    </button>
                </a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
@endsection