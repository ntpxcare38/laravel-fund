@extends('main')
@section('title','พิมพ์รายชื่อผู้สูงอายุ')
@section('content')
<div class="container reportOmem">
    <div class="row">
        <div class="col s12 m12">
                <div class="col s12 m12"><label>พิมพ์รายชื่อผู้สูงอายุ</label></div>
            <div class="col s12 m12">
                    <form action="pdfoldmem" method="GET" name="search" target="blank">
                        @csrf
                            <div class="input-field col s12 m10">
                                <i class="material-icons prefix">date_range</i>
                                    <select name="year_omem" onchange="this.form.submit()" id="posfSelect">
                                        <option value="0">เลือกผู้สูงอายุในปี</option>
                                        @foreach ($oldMems as $oldMem)
                                            <option value="{{$oldMem->year}}" >ปี พ.ศ. {{$oldMem->year}}</option>
                                        @endforeach
                                    </select>
                            </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/reportOldMember.js') }}"></script>
@endsection
