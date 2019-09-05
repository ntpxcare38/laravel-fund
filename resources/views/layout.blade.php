<!DOCTYPE html>
<html lang="en">
@include('sweetalert::alert')
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="icon" href="{!! asset('images/header3.ico') !!}"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="{{ asset('css/fund.css') }}">
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
    <script>
    </script>
    {{-- change Password --}}
    @if(session('status')=="login")
        <script>
             Swal.fire({
                    title: 'เข้าสู่ระบบสำเร็จ',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1500
                  })
            </script>
        </script>
    @elseif(session('status')=="save")
        <script>
            Swal.fire({
                    title: 'เพิ่มข้อมูล เรียบร้อยแล้ว',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1500
                })
        </script>
    @elseif(session('status')=="update")
        <script>
            Swal.fire({
                    title: 'แก้ไขข้อมูล เรียบร้อยแล้ว',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1500
                })
        </script>
    @elseif(session('status')=="delete")
    <script>
        Swal.fire({
                title: 'ลบข้อมูล เรียบร้อยแล้ว',
                type: 'success',
                showConfirmButton: false,
                timer: 1500
            })
    </script>
    @elseif(session('status')=="changepass")
    <script>
        Swal.fire({
                title: 'เปลี่ยนรหัสผ่าน เรียบร้อยแล้ว',
                type: 'success',
                showConfirmButton: false,
                timer: 1500
            })
    </script>
    @elseif(session('status')=="usernameduplicate")
    <script>
        Swal.fire({
                title: 'Username นี้มีผู้ใช้แล้ว',
                type: 'error',
                showConfirmButton: true
              })
    </script>
    @elseif(session('status')=="memnoduplicate")
    <script>
        Swal.fire({
                title: 'เลขที่สมาชิกนี้ มีผู้ใช้แล้ว',
                type: 'error',
                showConfirmButton: true
              })
    </script>
    @elseif(session('status')=="memidcardduplicate")
    <script>
        Swal.fire({
                title: 'เลขบัตรประชาชนนี้ มีผู้ใช้แล้ว',
                type: 'error',
                showConfirmButton: true
              })
    </script>
    @elseif(session('status')=="notfoundmemno")
    <script>
        Swal.fire({
                title: 'ไม่พบสมาชิกในระบบ',
                text: 'กรุณากรอกข้อมูลอีกครั้ง',
                type: 'error',
                showConfirmButton: true
              })
    </script>
    @endif

  <header>
        <nav>
            <div class="nav-wrapper fundnav">
                <div class="row">
                <div class="col s8 m12">
                    <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
                <span class="hide-on-small-only">ระบบสารสนเทศเพื่อการบริหารจัดการ{{$fund->fund_name}}</span>
                </div>
                </div>
            </div>
        </nav>
        <ul id="slide-out" class="sidenav">
            <li>
                <div>
                        @if(Auth::user()->type_pid==1)
                            <li><a href="/mAdmin"><i class="material-icons">home</i>หน้าหลัก</a></li>
                        @elseif(Auth::user()->type_pid==2)
                            <li><a href="/mBoard"><i class="material-icons">home</i>หน้าหลัก</a></li>
                        @elseif(Auth::user()->type_pid==3)
                            <li><a href="/mOfficer"><i class="material-icons">home</i>หน้าหลัก</a></li>
                        @endif
                        <li><a href="/showProfilePer/{{Auth::user()->p_id}}"><i class="material-icons">person_pin</i>
                            @if(Auth::user()->type_pid==1)
                                {{Auth::user()->p_fname}} {{Auth::user()->p_lname }}
                            @elseif(Auth::user()->type_pid==2)
                                {{Auth::user()->p_fname}} {{Auth::user()->p_lname }}
                            @elseif(Auth::user()->type_pid==3)
                            {{Auth::user()->p_fname}} {{Auth::user()->p_lname }}
                            @endif

                        </a></li>
                        <li><a href="#" style="pointer-events: none;">
                            @if(Auth::user()->type_pid==1)
                                <i class="material-icons">chevron_right</i>ผู้ดูแลระบบ
                            @elseif(Auth::user()->type_pid==2)
                                <i class="material-icons">chevron_right</i>ผู้บริหาร/กรรมการกองทุน
                            @elseif(Auth::user()->type_pid==3)
                                <i class="material-icons">chevron_right</i>เจ้าหน้าที่กองทุน
                            @endif
                        </a></li>
                        <li><a href="/pw_per"><i class="material-icons">vpn_key</i>เปลี่ยนรหัสผ่าน</a></li>
                        <li><div class="divider"></div></li>
                </div>
            </li>
            <?php if(Auth::user()->type_pid==1){ ?>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">person</i>บุคลากรกองทุน <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/per"><i class="material-icons">chevron_right</i>จัดการข้อมูลบุคลากร</a></li>
                                <li><a class="waves-effect waves-blue" href="/posfund"><i class="material-icons">chevron_right</i>จัดการข้อมูลตำแหน่งในกองทุน</a></li>
                                <li><a class="waves-effect waves-blue" href="/poscom"><i class="material-icons">chevron_right</i>จัดการข้อมูลตำแหน่งในชุมชน</a></li>
                                <li><div class="divider"></div></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">people</i>สมาชิกกองทุน <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/mem"><i class="material-icons">chevron_right</i>จัดการข้อมูลสมาชิก</a></li>
                                <li><a class="waves-effect waves-blue" href="/vil"><i class="material-icons">chevron_right</i>จัดการข้อมูลหมู่บ้าน</a></li>
                                <li><a class="waves-effect waves-blue" href="/mtype"><i class="material-icons">chevron_right</i>จัดการข้อมูลประเภทสมาชิก</a></li>
                                <li><div class="divider"></div></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">assessment</i>รายงาน<i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/reAlluserMem"><i class="material-icons">chevron_right</i>รายงานข้อมูลสมาชิก</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php if(Auth::user()->type_pid==2){ ?>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">assessment</i>รายงาน<i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/pdfmemall" target="blank"><i class="material-icons">chevron_right</i>ดูข้อมูลสมาชิก</a></li>
                                <li><a class="waves-effect waves-blue" href="/pdfper" target="blank"><i class="material-icons">chevron_right</i>ดูข้อมูลบุคลากร</a></li>
                                <li><a class="waves-effect waves-blue" href="/reOldMem" target="blank"><i class="material-icons">chevron_right</i>ดูข้อมูลผู้สูงอายุ</a></li>
                                <li><a class="waves-effect waves-blue" href="/reBenMonth"><i class="material-icons">chevron_right</i>ดูข้อมูลการจ่ายสวัสดิการ</a></li>
                                <li><a class="waves-effect waves-blue" href="/reAlluserMem"><i class="material-icons">chevron_right</i>รายงานข้อมูลสมาชิก</a></li>
                                <li><a class="waves-effect waves-blue" href="/reBenefit"><i class="material-icons">chevron_right</i>รายงานข้อมูลสวัสดิการ</a></li>
                                <li><a class="waves-effect waves-blue" href="/reAccount"><i class="material-icons">chevron_right</i>รายงานบัญชีรายรับ-รายจ่าย</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <?php if(Auth::user()->type_pid==3){ ?>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">account_balance</i>เกี่ยวกับกองทุน <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/fund"><i class="material-icons">chevron_right</i>แก้ไขข้อมูลกองทุน</a></li>
                                <li><div class="divider"></div></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">person</i>บุคลากรกองทุน <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/pdfper" target="blank"><i class="material-icons">chevron_right</i>พิมพ์รายชื่อบุคลากรทั้งหมด</a></li>
                                <li><div class="divider"></div></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">people</i>สมาชิกกองทุน <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/mem"><i class="material-icons">chevron_right</i>จัดการข้อมูลสมาชิก</a></li>
                                <li><div class="divider"></div></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">account_balance_wallet</i>รายรับ-รายจ่าย <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/ac"><i class="material-icons">chevron_right</i>จัดการข้อมูลรายรับ-รายจ่าย</a></li>
                                <li><a class="waves-effect waves-blue" href="/gc"><i class="material-icons">chevron_right</i>จัดการข้อมูลหมวดหมู่รายรับ-รายจ่าย</a></li>
                                <li><div class="divider"></div></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">assignment_ind</i>สวัสดิการ<i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/ben"><i class="material-icons">chevron_right</i>จัดการข้อมูลสวัสดิการ</a></li>
                                <li><a class="waves-effect waves-blue" href="/btype"><i class="material-icons">chevron_right</i>จัดการข้อมูลประเภทสวัสดิการ</a></li>
                                <li><div class="divider"></div></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">chat</i>เรื่องร้องเรียน<i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/comp_view"><i class="material-icons">chevron_right</i>ดูเรื่องร้องเรียน</a></li>
                                <li><div class="divider"></div></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">assessment</i>รายงาน<i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/reAlluserMem"><i class="material-icons">chevron_right</i>รายงานข้อมูลสมาชิก</a></li>
                                <li><a class="waves-effect waves-blue" href="/reBenefit"><i class="material-icons">chevron_right</i>รายงานข้อมูลสวัสดิการ</a></li>
                                <li><a class="waves-effect waves-blue" href="/reAccount"><i class="material-icons">chevron_right</i>รายงานบัญชีรายรับ-รายจ่าย</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <li><div class="divider"></div></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="material-icons">lock_open</i>ออกจากระบบ</a>
            </li>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
        </ul>
  </header>
  <div id="app">
      <example-component></example-component>
        @yield('content')
  </div>
        <footer class="page-footer foot-lay">
                <div class="container">
                  <div class="row">
                    <div class="col l6 s12">
                      <h5 class="white-text">เกี่ยวกับ</h5>
                      <p class="grey-text text-lighten-4">ระบบสารสนเทศเพื่อการบริหารจัดการ{{$fund->fund_name}}
                        <br><br>ที่ตั้งเลขที่ {{$fund->fund_no}} หมู่บ้าน{{$fund->fund_village}} หมู่ที่ {{$fund->fund_moo}} ซอย {{$fund->fund_soi}}
                        <br>ถนน{{$fund->fund_road}} ตำบล{{$fund->fund_tumbol}} อำเภอ{{$fund->fund_district}}
                        <br>จังหวัด{{$fund->fund_province}} รหัสไปรณีย์ {{$fund->fund_zipcode}}</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                      <h5 class="white-text">ติดต่อ</h5>
                      <ul>
                        <li>โทรศัพท์ : {{$fund->fund_tel}}</li>
                        <li>โทรศัพท์ : {{$fund->fund_tel_m}}</li>
                        <li>Fax : {{$fund->fund_fax}}</li>
                        <li>E-mail : {{$fund->fund_email}}</li>
                        <li>Website : <a class="grey-text text-lighten-4" href="https://{{$fund->fund_web}}">{{$fund->fund_web}}</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="footer-copyright">
                  <div class="container">
                  © 2019 Copyright
                  <a class="grey-text text-lighten-4 right" href="https://{{$fund->fund_web}}">{{$fund->fund_web}}</a>
                  </div>
                </div>
              </footer>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{ asset('js/materialize.min.js') }}"></script>
<script src="{{ asset('js/fund.js') }}"></script>

