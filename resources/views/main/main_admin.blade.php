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
                      <a href="/per">
                        <div class="waves-effect listMain">
                            <i class="large material-icons">person</i>
                            <span><h5>บุคลากร</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/posfund">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">person_outline</i>
                          <span><h5>ตำแหน่งในกองทุน</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/poscom">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">person_outline</i>
                          <span><h5>ตำแหน่งในชุมชน</h5></span>
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
                      <a href="/mtype">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">people_outline</i>
                          <span><h5>ประเภทสมาชิก</h5></span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="/vil">
                        <div class="waves-effect listMain">
                          <i class="large material-icons">home</i>
                          <span><h5>หมู่บ้าน</h5></span>
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

                </ul>
                  </div>
        </div>


</div>
@endsection
