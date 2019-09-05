@extends('main')
@section('title','แก้ไขข้อมูลรายรับ-รายจ่าย')
@section('content')
<div class="container content-fund">
        <div class="cre-ac">
                <div class="row">
                    <form id="formAc" action="{{ route('ac.update', $ac->acc_id) }}" method="post" onsubmit="return chkFrmAcEdit()">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="input-field col s11 m11">
                                <i class="material-icons prefix">view_headline</i>
                                <input name="acc_name" type="text" id="icon_prefix" class="validate" value="{{$ac->acc_name}}" required>
                                <label for="icon_prefix">ชื่อรายการ</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10 m5">
                                <i class="material-icons prefix">date_range</i>
                            <input name="acc_date" type="text" id="icon_prefix" class="datepicker" value="{{$ac->acc_date}}" required>
                                <label for="icon_prefix">วันที่ทำรายการ</label>
                            </div>
                            <div class="input-field col s11 m7">
                                <i class="material-icons prefix">group_work</i>
                                <select name="group_acid" id="mySelect">
                                    <option value="0">เลือกหมวด</option>
                                        @foreach ($gcs as $gc)
                                        <option value="{{$gc->group_acid}}" @if($ac->group_acid==$gc->group_acid) selected='selected' @endif>{{$gc->group_acname}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10 m3">
                                <i class="material-icons prefix">poll</i>
                                <input name="acc_piece" type="text" id="piece" placeholder="0" maxlength="15" class="validate" onkeyup="javascript:controlchars(this,money);calculate()" onkeydown="javascript:controlchars(this,money)" value="{{$ac->acc_piece}}" required>
                                <label for="icon_prefix">จำนวน</label>
                            </div>
                            <div class="input-field col s10 m4">
                                <i class="material-icons prefix">attach_money</i>
                                <input name="acc_price" type="text" id="price" placeholder="0.00" maxlength="15" class="validate" onkeyup="javascript:controlchars(this,money);calculate()" onkeydown="javascript:controlchars(this,money)" value="{{$ac->acc_price}}" required>
                                <label for="icon_prefix">ราคา</label>
                            </div>
                            <div class="input-field col s10 m5">
                                <i class="material-icons prefix">functions</i>
                                <input name="acc_total" type="text" id="total" class="validate" onkeyup="calculate()" >
                                <label for="icon_prefix">ผลรวม</label>
                            </div>
                        </div>

                        <div class="center-align">
                            <button class="btn waves-effect waves-light btn-black" type="submit" name="action">บันทึก</button>
                            <a href="{{ url()->previous() }}"><button class="btn waves-effect waves-light btn-black" type="button" name="action">ยกเลิก</button></a>
                        </div>
                    </form>
                </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/account.js') }}"></script>
<script>
    calculate = function () {
        var piece = document.getElementById('piece').value == ''? 0: document.getElementById('piece').value;
        var price = document.getElementById('price').value == ''? 0: document.getElementById('price').value;
        var num = parseInt(piece) * parseFloat(price);
        var parts = num.toFixed(2);
        document.getElementById('total').value = parts;
    }
    calculate()
</script>

@endsection
