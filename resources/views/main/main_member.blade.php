@extends('main-mem')
@section('title','หน้าหลัก')
@section('content')

<div class="container mainBody">
        <div class="row">
                <div class="col s12 m12 center">
                            <div class="row">
                                <div class="left card-title headMainAd">
                                    <h3><i class="small material-icons">home</i> หน้าหลัก</h3>
                                </div>
                            </div>
                <ul>
                    <li>
                      <a href="/showProfileMem/{{Auth::user()->mem_id}}">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">person</i>
                          <span><h5>ดูข้อมูลสมาชิก</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/hisBenefit/{{Auth::user()->mem_id}}">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">assignment_ind</i>
                          <span><h5>ประวัติการเบิกสวัสดิการ</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/comp">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">chat</i>
                          <span><h5>ร้องเรียน</h5></span>
                        </div>
                      </a>
                    </li>

                </ul>
                  </div>
        </div>


</div>
@endsection
