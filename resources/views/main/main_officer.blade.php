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
                      <a href="/fund">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">account_balance</i>
                          <span><h5>เกี่ยวกับกองทุน</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/pdfper" target="blank">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">person</i>
                          <span><h5>รายชื่อบุคคลากร</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/mem">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">people</i>
                          <span><h5>สมาชิก</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/ac">
                        <div class="waves-effect listMain">
                            <i class="large material-icons">account_balance_wallet</i>
                            <span><h5>รายรับ-รายจ่าย</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/gc">
                        <div class="waves-effect listMain">
                            <i class="large material-icons">account_balance_wallet</i>
                            <span><h5>หมวดรายรับ-รายจ่าย</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/ben">
                        <div class="waves-effect listMain">
                            <i class="large material-icons">assignment_ind</i>
                            <span><h5>สวัสดิการ</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/btype">
                        <div class="waves-effect listMain">
                            <i class="large material-icons">assignment_ind</i>
                            <span><h5>ประเภทสวัสดิการ</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/comp_view">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">chat</i>
                          <span><h5>เรื่องร้องเรียน</h5></span>
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
