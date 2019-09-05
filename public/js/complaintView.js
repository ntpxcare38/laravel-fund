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


setBillModal = (
    comp_id,
    mem_no,
    mem_fname,
    mem_lname,
    comp_date,
    comp_title,
    comp_detail
    ) => {
    document.getElementById("comp_id").textContent=(comp_id);
    document.getElementById("mem_no").textContent=(mem_no);
    document.getElementById("mem_fname").textContent=(mem_fname);
    document.getElementById("mem_lname").textContent=(mem_lname);
    document.getElementById("comp_date").textContent=(comp_date);
    document.getElementById("comp_title").textContent=(comp_title);
    document.getElementById("comp_detail").textContent=(comp_detail);
}
