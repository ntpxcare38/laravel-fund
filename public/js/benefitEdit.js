$(document).ready(function() {
    var dateObj = new Date();
    var day = dateObj.getUTCDate();
    var month = dateObj.getUTCMonth(); //months from 1-12
    var year = dateObj.getUTCFullYear()+543;

    const Calender = document.querySelectorAll('.datepicker');
    M.Datepicker.init(Calender, {
        //setDefaultDate:true,
        showMonthAfterYear:true,
        defaultDate: new Date(year,month,day),
        firstDay:3,
        yearRange: [2554,year],
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

            var element = document.querySelector('.datepicker');

            if(document.querySelector('.datepicker').value==""){
                $("datepicker").datepicker("setDate",new Date(year,month,day));
                M.Datepicker.getInstance(element).setDate(new Date(year,month,day), true);
            }else{
                M.Datepicker.getInstance(element).setDate(new Date(element.value), true);
            }

        }
    });
});

//-------------------- ตรวจสอบเลือกหมวด Account -------------------//

function chkFrmBenEdit() {
    var x = document.getElementById("mySelect").value;
    if (x == 0){
        Swal.fire({
            title: 'เลือกข้อมูลสวัสดิการ',
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
              document.getElementById("formBen").submit();
            }
          })
          return false;
    }
  }
