@extends('main')
@section('title','ข้อมูลการจ่ายสวัสดิการ')
@section('content')
<div class="container reportBen">
    <div class="row">
        <div class="col s12 m12">
                <div class="col s12 m12"><label>ข้อมูลการจ่ายสวัสดิการ</label></div>
            <div class="col s12 m12">
                    <form action="pdfBenMonth" method="GET" name="search" target="blank" onsubmit="return chkFrmBenMonth()">
                        @csrf
                            <div class="input-field col s11 m3">
                                    <i class="material-icons prefix">date_range</i>
                                    <input name="startDate" type="text" id="date1" class="datepicker" value="{{ request()->startDate }}" required>
                                    <label for="icon_prefix">ตั้งแต่วันที่</label>
                            </div>
                            <div class="input-field col s11 m3">
                                <i class="material-icons prefix">date_range</i>
                                <input name="endDate" type="text" id="date2" class="datepicker" value="{{ request()->endDate }}" required>
                                <label for="icon_prefix">สิ้นสุดวันที่</label>
                            </div>
                            <div class="input-field col s11 m6">
                                <i class="material-icons prefix">date_range</i>
                                    <select name="ben_type" id="mySelect">
                                        <option value="0">เลือกประเภทสวัสดิการ</option>
                                            <option value="1" >สวัสดิการผู้สูงอายุ</option>
                                            <option value="2" >สวัสดิการทั้งหมด (ยกเว้นผู้สูงอายุ)</option>
                                    </select>
                            </div>
                            <div class="input-field col s12 m12 center-align">
                                <button class="btn waves-effect waves-light btn-black" type="submit" name="action" >ค้นหา</button>
                            </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/reportBenefitMonth.js') }}"></script>
@endsection
