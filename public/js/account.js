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
function chkFrmAc() {
    var x = document.getElementById("mySelect").value;
    if (x == 0){
        Swal.fire({
            title: 'เลือกข้อมูลหมวด',
            type: 'warning',
            showConfirmButton: false,
            timer: 1500
          })
          return false;
    }else{
          return true;
    }
  }

function chkFrmAcEdit() {
    var x = document.getElementById("mySelect").value;
    if (x == 0){
        Swal.fire({
            title: 'เลือกข้อมูลหมวด',
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
              document.getElementById("formAc").submit();
            }
          })
          return false;
    }
  }

  setBillModal = (
    acDate,
    acc_name,
    gacname,
    gactype,
    acc_piece,
    acPrice,
    acTotal,
    acc_file
    ) => {
    document.getElementById("acDate").textContent=(acDate);
    document.getElementById("acc_name").textContent=(acc_name);
    document.getElementById("gacname").textContent=(gacname);

    if(gactype==1){
        document.getElementById("gactype").textContent=("รายรับ");
    }else if(gactype==2){
        document.getElementById("gactype").textContent=("รายได้");
    }else if(gactype==3){
        document.getElementById("gactype").textContent=("รายจ่าย");
    }else if(gactype==4){
        document.getElementById("gactype").textContent=("ค่าใช้จ่าย");
    }

    document.getElementById("acc_piece").textContent=(acc_piece);
    document.getElementById("acPrice").textContent=(acPrice);
    document.getElementById("acTotal").textContent=(acTotal);
    document.getElementById("acc_file").href = acc_file;

}

function readURL() {

    var extall="pdf";

    file = document.formAc.acc_file.value;
		ext = file.split('.').pop().toLowerCase();

        if(parseInt(extall.indexOf(ext)) < 0) {
			Swal.fire({
                        title: 'ประเภทไฟล์ไม่ถูกต้อง',
                        text: "กรุณาใช้นามสกุลไฟล์ .pdf",
                        type: 'error',
                        showConfirmButton: true
                      })
            document.getElementById("upFile").value = '';
        }
}

