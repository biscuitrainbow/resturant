@extends('layout')
@section('content')
<div class="flex justify-between h-2/5 my-8">
        <h2 class="">รายชื่อสมาชิก</h2>
        <a href="/member/create">
                <button class="ui button" type="submit" >เพิ่มสมาชิก</button>
        </a>
</div>
<form action="/member" class="mb-8">
        <div class="flex items-center">
                <div class="field w-1/5 mr-8">
                        <label class="">เดือน</label>
                        <div class="ui fluid search selection dropdown mt-2">
                            <input type="hidden" name="month">
                            <i class="dropdown icon"></i>
                            <div class="default text">Select Month</div>
                            <div class="menu">
                            
                            <div class="item" data-value="1" value="1">January</div>
                            <div class="item" data-value="2" value="2">Febuary</div>
                            <div class="item" data-value="3" value="3">March</div>
                            <div class="item" data-value="4" value="4">April</div>
                            <div class="item" data-value="5" value="5">May</div>
                            <div class="item" data-value="6" value="6">June</div>
                            <div class="item" data-value="7" value="7">July</div>
                            <div class="item" data-value="8" value="8">August</div>
                            <div class="item" data-value="9" value="9">September</div>
                            <div class="item" data-value="10" value="10">October</div>
                            <div class="item" data-value="11" value="11">November</div>
                            <div class="item" data-value="12" value="12">December</div>
    
                            </div>
                        </div>
                </div>
    
                <div class="field w-1/5">
                        <label class="">ปี</label>
                        <div class="ui fluid search selection dropdown mt-2">
                            <input type="hidden" name="year">
                            <i class="dropdown icon"></i>
                            <div class="default text">Select Year</div>
                            <div class="menu">
                            
                            <div class="item" data-value="2018" value="2018">2018</div>
                            </div>
                        </div>
                </div>
    
                <div class="ui item mt-6 ml-6">
                    <button class="ui button" type="submit" >เรียกดูข้อมูล</button>
                </div>
    </div>
    </form>
<table class="ui basic table">
        <thead>
          <tr>
            <th>รหัสสมาชิก</th>   
            <th>ชื่อ</th>       
            <th>นามสกุล</th>
            <th>ที่อยู่</th>
            <th>เบอร์โทรศัพท์</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($members as $member)
          <tr>
            <td>{{$member->code}}</td>   
            <td>{{$member->name}}</td>        
            <td>{{$member->lastname}}</td>  
            <td>{{$member->address}}</td>  
            <td>{{$member->tel}}</td>  
            <td>
                <a href="/member/edit/{{$member->id}}">
                    <button class="ui compact icon button">
                        <i class="write icon"></i>
                    </button>
                </a>
                <a href="/member/delete/{{$member->id}}">
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