@extends('layout')
@section('content')
<form class="ui form flex flex-col items-center mt-8" action="/table/edit/{{$table->id}}" method="post">
  {{csrf_field()}}
     
  <h2 class="my-8">แก้ไขโต๊ะอาหาร</h2>
     <div class="field w-2/5">
       <label>เลขโต๊ะ</label>
       <input type="text" name="name" value="{{$table->name}}" placeholder="เลขโต๊ะ">
     </div>
     <div class="field w-2/5">
       <label>จำนวนที่นั่ง</label>
       <input type="number" name="number_of_seat" value="{{$table->seat}}" placeholder="จำนวนที่นั่ง">
     </div>
    
       <div class="inline fields ">
             <label for="fruit">ประเภทโต๊ะ:</label>
             @foreach($types as $type)
             <div class="field">
                <div class="ui radio checkbox">
                  <input type="radio" name="type" @if($table->type->id == $type->id) {{ "checked"}} @endif value="{{$type->id}}" tabindex="0" class="hidden">
                  <label>{{$type->name}}</label>
                </div>
              </div>
             @endforeach
      </div>
           <button class="ui button w-2/5 mt-4" type="submit" >บันทึก</button>
 
   </form>
@endsection