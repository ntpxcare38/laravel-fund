
var dateObj = new Date();
var day = dateObj.getUTCDate();
var month = dateObj.getUTCMonth(); //months from 1-12
var year = dateObj.getUTCFullYear()+543;


$(document).ready(function() {

    $('#date1').datepicker({
        showMonthAfterYear:true,
        defaultDate: new Date(year,month,day),
        yearRange: [2455,year],
        firstDay:3,
        format:'yyyy-mm-dd',
        autoClose:true,
        showClearBtn:true,
        lang:'th',
        i18n:
        {
            locales:'th',
            months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
            weekdaysShort : ['พฤ ','ศ ','ส ','อา ','จ ','อ ','พ '],
            //weekdaysShort : ['อา','จ','อ','พ','พฤ','ศ','ส'],
            weekdaysAbbrev : ['พฤ','ศ','ส','อา','จ','อ','พ'],
            //weekdaysAbbrev : ['อา','จ','อ','พ','พฤ','ศ','ส'],
            monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
        },
        onOpen(){
            var elDate1 = document.querySelector('#date1');

            if(elDate1.value==""){
                //M.Datepicker.getInstance(element).setDate(new Date(year,month,day), true);
                $("#date1").datepicker("setDate",new Date(year-40,month,day));
            }else{
                M.Datepicker.getInstance(elDate1).setDate(new Date(elDate1.value), true);
            }
        }
    });

    $('#date2').datepicker({
        showMonthAfterYear:true,
        defaultDate: new Date(year,month,day),
        yearRange: [2554,year],
        firstDay:3,
        format:'yyyy-mm-dd',
        autoClose:true,
        showClearBtn:true,
        lang:'th',
        i18n:
        {
            locales:'th',
            months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
            weekdaysShort : ['พฤ ','ศ ','ส ','อา ','จ ','อ ','พ '],
            //weekdaysShort : ['อา','จ','อ','พ','พฤ','ศ','ส'],
            weekdaysAbbrev : ['พฤ','ศ','ส','อา','จ','อ','พ'],
            //weekdaysAbbrev : ['อา','จ','อ','พ','พฤ','ศ','ส'],
            monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
        },
        onOpen(){
                var elDate2 = document.querySelector('#date2');
                if(elDate2.value==""){
                    //M.Datepicker.getInstance(element).setDate(new Date(year,month,day), true);
                    $("#date2").datepicker("setDate",new Date(2554,02,19));
                }else{
                    M.Datepicker.getInstance(elDate2).setDate(new Date(elDate2.value), true);
                }
        }
    });

      $('#date3').datepicker({
        showMonthAfterYear:true,
        defaultDate: new Date(year,month,day),
        yearRange: [2554,year],
        firstDay:3,
        format:'yyyy-mm-dd',
        autoClose:true,
        showClearBtn:true,
        lang:'th',
        i18n:
        {
            locales:'th',
            months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
            weekdaysShort : ['พฤ ','ศ ','ส ','อา ','จ ','อ ','พ '],
            //weekdaysShort : ['อา','จ','อ','พ','พฤ','ศ','ส'],
            weekdaysAbbrev : ['พฤ','ศ','ส','อา','จ','อ','พ'],
            //weekdaysAbbrev : ['อา','จ','อ','พ','พฤ','ศ','ส'],
            monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
        },onOpen(){
            var elDate3 = document.querySelector('#date3');

            if(elDate3.value==""){
                //M.Datepicker.getInstance(element).setDate(new Date(year,month,day), true);
                $("#date3").datepicker("setDate",new Date(year,month,day));
            }else{
                M.Datepicker.getInstance(elDate3).setDate(new Date(elDate3.value), true);
            }
        }
    });

    if (document.getElementById('chkResign').checked==true) {
        document.getElementById('resign').style.visibility = 'visible';
    }
    else document.getElementById('resign').style.visibility = 'hidden';
});
  //-------------------- ตรวจสอบ member -------------------//
function chkFrmMem() {

    if(document.formMem.password.value != document.formMem.cpassword.value)
	{
		Swal.fire({
            title: 'รหัสผ่านไม่ตรงกัน',
            type: 'error',
            showConfirmButton: false,
            timer: 1500
          })
		document.formMem.cpassword.focus();
		return false;
    }

    var x = document.getElementById("mooSelect").value;
    var y = document.getElementById("mtypeSelect").value;

    if (x == 0){
        Swal.fire({
            title: 'เลือกข้อมูลหมู่ที่',
            type: 'warning',
            showConfirmButton: false,
            timer: 1500
          })
        return false;
    }else if (y == 0){
        Swal.fire({
            title: 'เลือกข้อมูลลักษณะสมาชิก',
            type: 'warning',
            showConfirmButton: false,
            timer: 1500
          })
        return false;
    }else{
          return true;
    }

  }

function chkFrmMemEdit() {

    if(document.formMem.password.value != document.formMem.cpassword.value)
	{
		Swal.fire({
            title: 'รหัสผ่านไม่ตรงกัน',
            type: 'error',
            showConfirmButton: false,
            timer: 1500
          })
		document.formMem.cpassword.focus();
		return false;
    }

    var x = document.getElementById("mooSelect").value;
    var y = document.getElementById("mtypeSelect").value;

    if (x == 0){
        Swal.fire({
            title: 'เลือกข้อมูลหมู่ที่',
            type: 'warning',
            showConfirmButton: false,
            timer: 1500
          })
        return false;
    }else if (y == 0){
        Swal.fire({
            title: 'เลือกข้อมูลลักษณะสมาชิก',
            type: 'warning',
            showConfirmButton: false,
            timer: 1500
          })
        return false;
    }else{
        Swal.fire({
            title: 'ยืนยันการแก้ไข',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
              document.getElementById("formMem").submit();
            }
          })
          return false;
    }
  }

function chkStatus() {

    if (document.getElementById('chkResign').checked) {
        document.getElementById('resign').style.visibility = 'visible';
    }
    else {
        document.getElementById('resign').style.visibility = 'hidden';
        document.getElementById('date3').value = '';
        document.getElementById('mem_cause').value = '';
    }

}


    //const Calender = document.querySelectorAll('.datepicker');
    // M.Datepicker.init(Calender, {
    //     //setDefaultDate:true,
    //     showMonthAfterYear:true,
    //     defaultDate: new Date(year,month,day),
    //     //yearRange: [2450,year],
    //     firstDay:3,
    //     format:'yyyy-mm-dd',
    //     autoClose:true,
    //     showClearBtn:true,
    //     lang:'th',
    //     i18n:
    //     {
    //         locales:'th',
    //         months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
    //         weekdaysShort : ['พฤ ','ศ ','ส ','อา ','จ ','อ ','พ '],
    //         //weekdaysShort : ['อา','จ','อ','พ','พฤ','ศ','ส'],
    //         weekdaysAbbrev : ['พฤ','ศ','ส','อา','จ','อ','พ'],
    //         //weekdaysAbbrev : ['อา','จ','อ','พ','พฤ','ศ','ส'],
    //         monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
    //     },
    //     onOpen(){
    //             var elDate1 = document.querySelector('#date1');
    //             var elDate2 = document.querySelector('#date2');
    //             var elDate3 = document.querySelector('#date3');

    //             if(elDate1.value==""){
    //                 //M.Datepicker.getInstance(element).setDate(new Date(year,month,day), true);
    //                 $("#date1").datepicker("setDate",new Date(year-40,month,day));
    //             }else{
    //                 M.Datepicker.getInstance(elDate1).setDate(new Date(elDate1.value), true);
    //             }

    //             if(elDate2.value==""){
    //                 //M.Datepicker.getInstance(element).setDate(new Date(year,month,day), true);
    //                 $("#date2").datepicker("setDate",new Date(2554,02,19));
    //             }else{
    //                 M.Datepicker.getInstance(elDate2).setDate(new Date(elDate2.value), true);
    //             }

    //             if(elDate3.value==""){
    //                 //M.Datepicker.getInstance(element).setDate(new Date(year,month,day), true);
    //                 $("#date3").datepicker("setDate",new Date(year,month,day));
    //             }else{
    //                 M.Datepicker.getInstance(elDate3).setDate(new Date(elDate3.value), true);
    //             }
    //     }
    // });
