@extends('layout') 
@section('content')
<form class="ui form flex flex-col items-center mt-8" method="get" action="/reservation/next">
  {{csrf_field()}}

  <h2 class="my-8">สำรองที่นั่ง</h2>
  <div class="field w-2/5">
    <label>ชื่อ</label>
    <input type="text" name="name" placeholder="ชื่อ">
  </div>
  <div class="field w-2/5">
    <label>นามสกุล</label>
    <input type="text" name="lastname" placeholder="นามสกุล">
  </div>
  <div class="field w-2/5">
    <label>เบอร์โทรศัพท์</label>
    <input type="text" name="tel" placeholder="เบอร์โทรศัพท์">
  </div>
  <div class="field w-2/5">
    <label>สมาชิก</label>
    <div class="ui fluid search selection dropdown">
      <input type="hidden" name="member">
      <i class="dropdown icon"></i>
      <div class="default text">Select Member</div>
      <div class="menu">
        @foreach($members as $member)
        <div class="item" data-value="{{ $member->id }}" value="{{$member->id}}">{{ $member->name . ' ' . $member->lastname }}
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="field w-2/5">
    <label>จำนวนคน</label>
    <input type="text" name="seat" placeholder="จำนวนคน">
  </div>
  <div class="inline fields">
    <label>การสั่งอาหาร</label>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="type" value="กินที่ร้าน" checked="checked">
        <label>กินที่ร้าน</label>
      </div>
    </div>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="type" value="สั่งกลับบ้าน">
        <label>สั่งกลับบ้าน</label>
      </div>
    </div>
  </div>

  <div class="inline fields">
    <label>ช่วงเวลา</label>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="section" value="เช้า" checked="checked">
        <label>เช้า</label>
      </div>
    </div>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="section" value="บ่าย">
        <label>บ่าย</label>
      </div>
    </div>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="section" value="เย็น">
        <label>เย็น</label>
      </div>
    </div>
  </div>

  <div class="field w-2/5">
    <div class="ui calendar" id="example5">
      <label>วันเวลา</label>
      <div class="ui input left icon">
        <i class="calendar icon"></i>
        <input type="text" name="date_time" placeholder="Date">
      </div>
    </div>
  </div>

 

  <button class="ui button w-2/5 mt-4" type="submit">ยืนยัน</button>

</form>
@endsection