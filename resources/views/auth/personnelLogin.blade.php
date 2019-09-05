@extends('layoutLogin')
@section('title','เข้าสู่ระบบสำหรับ (บุคลากร)')
@section('content')

                    <form method="POST" action="{{ route('personnel-login') }}" class="frmLogin">
                            <H4>เข้าสู่ระบบสำหรับ (บุคลากร)</H4>
                        @csrf

                        <div class="row">
                            <div class="input-field col s11 m10">
                                <i class="material-icons prefix">person</i>
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" onkeyup='javascript:controlchars(this,usn)' onkeydown='javascript:controlchars(this,usn)' name="username" value="{{ old('username') }}" required autofocus>
                                    <label for="icon_prefix">Username</label>
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback"><font color="red">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </font></span>
                                    @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s11 m10">
                                <i class="material-icons prefix">vpn_key</i>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    <label for="icon_prefix">Password</label>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="row center">
                            <div class="input-field col s12 m12">
                                <a href="/"><button class="btn waves-effect waves-light btn-black" type="button" name="action">กลับ<i class="material-icons left">navigate_before</i></button></a>
                                <button class="btn waves-effect waves-light center" type="submit" name="action">เข้าสู่ระบบ
                                    <i class="material-icons right">navigate_next</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="fixed-action-btn">
                        <a href="#" class="btn-floating btn-large modal-trigger" data-toggle="modal" data-target="modal1"
                                    onClick="setBillModal('<?php
                                                                echo   $fund->fund_name. '\',\''.
                                                                        $fund->fund_no. '\',\''.
                                                                        $fund->fund_village. '\',\''.
                                                                        $fund->fund_moo. '\',\''.
                                                                        $fund->fund_soi. '\',\''.
                                                                        $fund->fund_road. '\',\''.
                                                                        $fund->fund_tumbol. '\',\''.
                                                                        $fund->fund_district. '\',\''.
                                                                        $fund->fund_province. '\',\''.
                                                                        $fund->fund_zipcode. '\',\''.
                                                                        $fund->fund_tel. '\',\''.
                                                                        $fund->fund_tel_m. '\',\''.
                                                                        $fund->fund_fax. '\',\''.
                                                                        $fund->fund_email. '\',\''.
                                                                        $fund->fund_web. '\',\''.
                                                                        $fund->fund_name_h. '\',\''.
                                                                        $fund->fund_name_c. '\',\''.
                                                                        number_format($fund->fund_habitant,0);?>')">
                                            <i class="small material-icons">contacts</i>
                                        </a>
                      </div>

                      <div class="showContact">
                            <div id="modal1" class="modal">
                                    <div class="modal-content">
                                        <h6><b>ข้อมูล{{$fund->fund_name}}</b></h6>
                                        <div class="row">
                                                <div class="col s12 m12">
                                                    <ul>
                                                        <li>ชื่อกองทุน : <label><span id="fund_name" ></span></label></li>
                                                        <li>ที่ตั้งเลขที่ <label><span id="fund_no"></span></label>
                                                        &nbsp;&nbsp;หมู่บ้าน <label><span id="fund_village"></span></label>
                                                        &nbsp;&nbsp;หมู่ที่ <label><span id="mem_title"></span><span id="fund_moo"> </span></label>
                                                        &nbsp;&nbsp;ซอย <label><span id="fund_soi"></span></label>
                                                        &nbsp;&nbsp;ถนน <label><span id="fund_road"></span></label></li>
                                                        <li>ตำบล <label><span id="fund_tumbol"></span></label>
                                                        &nbsp;&nbsp;อำเภอ <label><span id="fund_district"></span></label>
                                                        &nbsp;&nbsp;จังหวัด <label><span id="fund_province"></span></label>
                                                        &nbsp;&nbsp;รหัสไปรษณีย์ <label><span id="fund_zipcode"></span></label></li>
                                                        <li>โทรศัพท์ <label><span id="fund_tel"></span></label>
                                                        &nbsp;&nbsp;โทรศัพท์มือถือ <label><span id="fund_tel_m"></span></label>
                                                        &nbsp;&nbsp;โทรสาร <label><span id="fund_fax"></span></label></li>
                                                        <li>อีเมล์ <label><span id="fund_email"></span></label>
                                                        &nbsp;&nbsp;เว็บไซต์ <label><a href="{{ 'https://'.$fund->fund_web }}" target="blank"><span id="fund_web"></span></a></label>
                                                        &nbsp;&nbsp;จำนวนประชากรในตำบล <label><span id="fund_habitant"></span> คน</label></li>
                                                        <li>ชื่อประธานกองทุน <label><span id="fund_name_h"></span></label>
                                                        &nbsp;&nbsp;ชื่อผู้ประสานงาน <label><span id="fund_name_c"></span></label></li>

                                                    </ul>
                                                <br>
                                        </div>
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3778.6633120233587!2d98.9235053146936!3d18.723885967811682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3132ec965281%3A0x16add43cf12e9986!2z4LiX4Li14LmI4LiX4Liz4LiB4Liy4Lij4LmA4LiX4Lio4Lia4Liy4Lil4LiV4Liz4Lia4Lil4Lir4LiZ4Lit4LiH4LiE4Lin4Liy4Lii!5e0!3m2!1sth!2sth!4v1558697145973!5m2!1sth!2sth" class="mapfund" frameborder="0" style="border:0" allowfullscreen></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                        <script src="{{ asset('js/materialize.min.js') }}"></script>
                        <script src="{{ asset('js/homePage.js') }}"></script>

@endsection
