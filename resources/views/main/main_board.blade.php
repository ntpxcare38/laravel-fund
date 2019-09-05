@extends('main')
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
                      <a href="/pdfmemall" target="blank">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">assignment</i>
                          <span><h5>ดูข้อมูลสมาชิก</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/pdfper" target="blank">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">assignment</i>
                          <span><h5>ดูข้อมูลบุคลากร</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/reOldMem" target="blank">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">assignment</i>
                          <span><h5>ดูข้อมูลผู้สูงอายุ</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/reBenMonth" target="blank">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">assignment</i>
                          <span><h5>ดูข้อมูลการจ่ายสวัสดิการ</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/reAlluserMem">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">assignment</i>
                          <span><h5>Report สมาชิก</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/reBenefit">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">assignment</i>
                          <span><h5>Report สวัสดิการ</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/reAccount">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">assignment</i>
                          <span><h5>Report รายรับ-รายจ่าย</h5></span>
                        </div>
                      </a>
                    </li>

                </ul>
                  </div>
        </div>


</div>
@endsection
