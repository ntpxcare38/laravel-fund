@extends('main')
@section('title','แก้ไขการเบิกสวัสดิการ')
@section('content')
<div class="container content-fund">
    <div class="cre-ben">
            <div class="row">
                    <form id="formBen" action="{{ route('ben.update', $ben->benefit_id) }}" method="post" onsubmit="return chkFrmBenEdit()">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="input-field col s9 m4">
                                <i class="material-icons prefix">person</i>
                                <input name="mem_no" type="text" id="mem_no" class="autocomplete" onkeyup="javascript:controlchars(this,homenumber)" onkeydown="javascript:controlchars(this,homenumber)" value="{{$mem->mem_no}}" required>
                                <label id="mem_no">เลขสมาชิกกองทุน</label>
                            </div>
                            <div class="col s11 m8 right-align">
                                    <span id="mem_name" ></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10 m4">
                                <i class="material-icons prefix">date_range</i>
                                <input name="benefit_date" type="text" id="date1" class="datepicker" value="{{$ben->benefit_date}}" required>
                                <label>วันที่ทำรายการ</label>
                            </div>
                            <div class="input-field col s11 m8">
                                <i class="material-icons prefix">group_work</i>
                                <select name="type_bid" id="mySelect">
                                    <option value="0">เลือกสวัสดิการ</option>
                                        @foreach ($btypes as $btype)
                                            <option value="{{$btype->type_bid}}" @if($ben->type_bid==$btype->type_bid) selected='selected' @endif>{{$btype->type_bname}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>

                    <div class="row">
                        <div class="input-field col s8 m4">
                            <i class="material-icons prefix">attach_money</i>
                            <input name="benefit_price" type="text" id="price" placeholder="0.00" maxlength="15" class="validate" onkeyup="javascript:controlchars(this,money)" onkeydown="javascript:controlchars(this,money)" value="{{$ben->benefit_price}}" required>
                            <label>จำนวนเงิน</label>
                        </div>
                        <div class="input-field col s11 m7">
                            <i class="material-icons prefix">feedback</i>
                        <input name="benefit_annotation" type="text" id="mem_cause" class="validate" maxlength="100" value="{{$ben->benefit_annotation}}">
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
<script src="{{ asset('js/benefitEdit.js') }}"></script>
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
                                //const mergeValue = `${value.mem_no} ${value.mem_fname} ${value.mem_lname}`
                                const mergeValue = `${value.mem_no}`
                                dataMember[mergeValue] = null
                            })
                            $('input.autocomplete').autocomplete({
                                data: dataMember,
                                onAutocomplete: function(data) {
                                    //console.log(data);
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
