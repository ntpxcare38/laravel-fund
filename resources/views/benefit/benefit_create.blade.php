@extends('main')
@section('title','บันทึกการเบิกสวัสดิการ')
@section('content')
<div class="container content-fund">
    <div class="cre-ben">
            <div class="row">
                    <form action="/ben" method="post" onsubmit="return chkFrmBen()">
                        @csrf
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <label>
                                        <input name="ben_status" onclick="javascript:chkStatus()" type="radio" value="1" @if(old('ben_status') == 1) checked @endif required>
                                        <span>ผู้สูงอายุทั้งหมด</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m7">
                                <div class="row">
                                    <div class="input-field col s11 m6">
                                        <label>
                                        <input name="ben_status" checked id="chkResign" type="radio" onclick="javascript:chkStatus()" value="2" @if(old('ben_status') == 2) checked @endif required>
                                        <span>สมาชิกธรรมดาทั่วไป</span>
                                        </label>
                                    </div>
                                    <div id="resign" style="visibility:hidden">
                                        <div class="input-field col s11 m6">
                                            <i class="material-icons prefix">person</i>
                                            <input name="mem_no" type="text" id="mem_no" class="autocomplete" onkeyup="javascript:controlchars(this,homenumber)" onkeydown="javascript:controlchars(this,homenumber)" value="{{ old('mem_no') }}">
                                            <label id="mem_no">เลขสมาชิกกองทุน</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s11 m5 right-align">
                                    <span id="mem_name" ></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10 m4">
                                <i class="material-icons prefix">date_range</i>
                                <input name="benefit_date" type="text" id="date1" class="datepicker" value="{{ old('benefit_date') }}" required>
                                <label>วันที่ทำรายการ</label>
                            </div>
                            <div class="input-field col s11 m8">
                                <i class="material-icons prefix">group_work</i>
                                <select name="type_bid" id="mySelect">
                                    <option value="0">เลือกสวัสดิการ</option>
                                        @foreach ($btypes as $btype)
                                            <option value="{{$btype->type_bid}}" @if(old('type_bid') == $btype->type_bid) selected @endif>{{$btype->type_bname}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>

                    <div class="row">
                        <div class="input-field col s8 m4">
                            <i class="material-icons prefix">attach_money</i>
                            <input name="benefit_price" type="text" id="price" placeholder="0.00" maxlength="10" class="validate" onkeyup="javascript:controlchars(this,money)" onkeydown="javascript:controlchars(this,money)" value="{{ old('benefit_price') }}" required>
                            <label>จำนวนเงิน</label>
                        </div>
                        <div class="input-field col s11 m7">
                            <i class="material-icons prefix">feedback</i>
                            <input name="benefit_annotation" type="text" id="mem_cause" class="validate" maxlength="100" value="{{ old('benefit_annotation') }}">
                            <label>หมายเหตุ</label>
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
<script src="{{ asset('js/benefitCreate.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('autocomplete.fetch') }}",
                        method:"GET",
                        success:function(data){
                             var memnoArray = data;
                            let dataMember = []
                            let dataName = []
                            memnoArray.forEach(value => {
                                const mergeValue = `${value.mem_no}`
                                dataMember[mergeValue] = null
                            })
                            $('input.autocomplete').autocomplete({
                                data: dataMember,
                                onAutocomplete: function(data) {
                                    memnoArray.forEach(value => {
                                        if(value.mem_no==data){
                                            dataName = `${value.mem_fname} ${value.mem_lname}`
                                        }
                                    })
                                   $('#mem_name').html('สมาชิกกองทุน คุณ'+dataName);
                                },
                                limit : 4
                            });

                        }
                        ,
                        error: function (err) {
                            console.log(err);
                        }

                    })


    });
</script>

@endsection
