<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
            <meta charset="UTF-8">
            <title>กองทุนสวัสดิการ</title>
            <link rel="icon" href="{!! asset('images/header3.ico') !!}"/>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <link rel="stylesheet" href="{{ asset('css/homePage.css') }}">

</head>
<body>
    <div class="container">
                <div class="row center">
                        <br>
                        <div class="row">
                            <img src="{!! asset('images/logo.png') !!}" alt="Smiley face" height="200" width="200">
                        </div>
                        <div class="row sub">
                            <span class="flow-text">ระบบสารสนเทศเพื่อการบริหารจัดการ{{$fund->fund_name}}</span>
                        </div>
                            <div class="col s12 m12">
                                    <div class="col s0 m1">
                                    </div>
                                    <div class="col s12 m5">
                                        <a href="personnel-login">
                                            <div class="waves-effect listMain">
                                                <i class="large material-icons">person</i>
                                                <span><p>เข้าสู่ระบบสำหรับ (บุคลากร)</p></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col s12 m5">
                                        <a href="/member-login">
                                            <div class="waves-effect listMain">
                                            <i class="large material-icons">people</i>
                                            <span><p>เข้าสู่ระบบสำหรับ (สมาชิก)</p></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col s0 m1">
                                    </div>
                            </div>
                </div>
    </div>
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
    </div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/homePage.js') }}"></script>
</body>
</html>

