@extends('main')
@section('title','แสดงข้อมูลผู้ใช้')
@section('content')

<div class="container content-fund">
        <div class="show-per">
            <div class="row">
                <div class="col s12 m12">
                    <h5 class="left">ข้อมูลผู้ใช้งาน</h5>
                </div>
            </div>
            <div class="avatar-upload">
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url('/storage/{{$per->p_photo}}');">
                        </div>
                    </div>
            </div>

            <div class="row">
                    <div class="col s12 m7">
                    ชื่อ :  @if($per->p_title==1) {{'นาย'}} @endif
                            @if($per->p_title==2) {{'นาง'}} @endif
                            @if($per->p_title==3) {{'นางสาว'}} @endif
                            {{$per->p_fname}} {{$per->p_lname}}
                    </div>
                    <div class="col s12 m5">
                        เบอร์โทรศัพท์ : {{$per->p_tel}}
                    </div>
                    <div class="col s12 m7">
                        @foreach ($pfunds as $pfund)
                            @if($per->position_fid==$pfund->position_fid)
                                ตำแหน่งในกองทุน : {{$pfund->position_fname}}
                            @endif
                        @endforeach
                    </div>
                    <div class="col s12 m5">
                        ประเภทผู้ใช้ : @if($per->type_pid==1){{'ผู้ดูแลระบบ'}}@endif
                                    @if($per->type_pid==2){{'ผู้บริหาร/กรรมการ'}}@endif
                                    @if($per->type_pid==3){{'เจ้าหน้าที่'}}@endif
                    </div>
                    <div class="col s12 m7">
                        @foreach ($pcoms as $pcom)
                            @if($per->position_cid==$pcom->position_cid)
                                ตำแหน่งในหมู่บ้าน : {{$pcom->position_cname}}
                            @endif
                        @endforeach
                    </div>
                    <div class="col s12 m5">
                        Username : {{$per->p_username}}
                    </div>

            </p>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/person.js') }}"></script>

@endsection
