
var dateObj = new Date();
var day = dateObj.getUTCDate();
var month = dateObj.getUTCMonth(); //months from 1-12
var year = dateObj.getUTCFullYear()+543;


$(document).ready(function() {

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

                var elDate1 = document.querySelector('#date1');
                var elDate2 = document.querySelector('#date2');

                if(elDate1.value==""){
                    $("#date1").datepicker("setDate",new Date(year,month,day));
                }else{
                    M.Datepicker.getInstance(elDate1).setDate(new Date(elDate1.value), true);
                }

                if(elDate2.value==""){
                    $("#date2").datepicker("setDate",new Date(elDate1.value));
                }else{
                    M.Datepicker.getInstance(elDate2).setDate(new Date(elDate2.value), true);
                }
        }



    });


});


