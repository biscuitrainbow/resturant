@extends('layout')
@section('content')
<form class="ui form flex flex-col items-center mt-8" action="/tabletype/edit/{{$table_type->id}}" method="post">
  {{csrf_field()}}
       <h2 class="my-8">แก้ไขประเภทโต๊ะ</h2>
    <div class="field w-2/5">
      <label>ประเภท</label>
      <input type="text" name="name" value="{{$table_type->name}}" placeholder="ประเภท">
    </div>
  
    <button class="ui button w-2/5 mt-4" type="submit" >เพิ่ม</button>

  </form>

@endsection