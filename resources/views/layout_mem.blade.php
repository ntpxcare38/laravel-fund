<!DOCTYPE html>
<html lang="en">
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
</head>
<body>
    @if(session('status')=="login")
        <script>
             Swal.fire({
                    title: 'เข้าสู่ระบบสำเร็จ',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 2500
                  })
            </script>
        </script>
    @elseif(session('status')=="changepass")
    <script>
        Swal.fire({
                title: 'เปลี่ยนรหัสผ่าน เรียบร้อยแล้ว',
                type: 'success',
                showConfirmButton: false,
                timer: 2500
            })
    </script>
    @elseif(session('status')=="sendcomp")
    <script>
        Swal.fire({
                title: 'ส่งข้อมูลร้องเรียน เรียบร้อยแล้ว',
                type: 'success',
                showConfirmButton: false,
                timer: 2500
            })
    </script>
    @endif
  <header>
        <nav>
            <div class="nav-wrapper fundnav">
                <div class="row">
                <div class="col s12 m12">
                    <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
                    <span class="hide-on-small-only">ระบบสารสนเทศเพื่อการบริหารจัดการ{{$fund->fund_name}}</span>
                </div>
                </div>
            </div>
        </nav>
        <ul id="slide-out" class="sidenav">
            <li>
                <div>
                        <li><a href="/mMember"><i class="material-icons">home</i>หน้าหลัก</a></li>
                        <li><a href="/showProfileMem/{{Auth::user()->mem_id}}"><i class="material-icons">person_pin</i>
                                {{Auth::user()->mem_fname}} {{Auth::user()->mem_lname}}
                        </a></li>
                        <li><a href="#" style="pointer-events: none;">
                                <i class="material-icons">chevron_right</i>สมาชิกกองทุน
                        </a></li>
                        <li><a href="/pw_mem"><i class="material-icons">vpn_key</i>เปลี่ยนรหัสผ่าน</a></li>
                        <li><div class="divider"></div></li>
                </div>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">person</i>ผู้ใช้งาน <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                            <li><a class="waves-effect waves-blue" href="/showProfileMem/{{Auth::user()->mem_id}}"><i class="material-icons">chevron_right</i>ดูข้อมูลผู้ใช้งาน</a></li>
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
                                <li><a class="waves-effect waves-blue" href="/hisBenefit/{{Auth::user()->mem_id}}"><i class="material-icons">chevron_right</i>ดูประวัติการเบิกสวัสดิการ</a></li>
                                <li><div class="divider"></div></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">chat</i>ร้องเรียน<i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="/comp"><i class="material-icons">chevron_right</i>ส่งเรื่องร้องเรียนกองทุน</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
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

