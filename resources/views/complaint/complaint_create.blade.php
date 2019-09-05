@extends('main-mem')
@section('title','ส่งเรื่องร้องเรียนกองทุน')
@section('content')
<?php
    $day = date("d");
    $month = date("m");
    $year = date("Y")+543;
    $dateObj = ("$year-$month-$day");
?>
<div class="container content-fund">
    <div class="cre-comp">
            <div class="row">
                    <form action="/comp" method="post">
                        @csrf
                        <input name="mem_id" type="hidden" class="validate" value="{{Auth::user()->mem_id}}">
                        <input name="comp_date" type="hidden" id="date1"  value="{{$dateObj}}">
                        <div class="row">
                            <div class="input-field col s11 m8">
                                <i class="material-icons prefix">chat</i>
                                <input name="comp_title" type="text" id="icon_prefix" onkeyup='javascript:controlchars(this,alphaNumber)' onkeydown='javascript:controlchars(this,alphaNumber)' class="validate" maxlength="50" required>
                                <label for="icon_prefix">เรื่องร้องเรียน</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s11 m11">
                                    <i class="material-icons prefix">view_headline</i>
                                <textarea name="comp_detail" id="textarea1" onkeyup='javascript:controlchars(this,alphaNumber)' onkeydown='javascript:controlchars(this,alphaNumber)' class="materialize-textarea validate" maxlength="250"></textarea>
                                <label for="textarea1">รายละเอียด</label>
                            </div>
                        </div>

                        <div class="center-align">
                                <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >ส่งเรื่อง</button>
                                <a href="{{ url()->previous() }}"><button class="btn waves-effect waves-light btn-black" type="button" name="action">ยกเลิก</button></a>
                            </div>
                    </form>
            </div>
    </div>
</div>

@endsection
