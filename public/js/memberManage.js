// $(document).ready(function() {

//     var dateObj = new Date();
//     var day = dateObj.getUTCDate();
//     var month = dateObj.getUTCMonth(); //months from 1-12
//     var year = dateObj.getUTCFullYear()+543;

//     const Calender = document.querySelectorAll('.datepicker');
//     M.Datepicker.init(Calender, {
//         //setDefaultDate:true,
//         showMonthAfterYear:true,
//         defaultDate: new Date(year,month,day),
//         firstDay:3,
//         yearRange: 80,
//         format:'yyyy-mm-dd',
//         autoClose:true,
//         showClearBtn:true,
//         lang:'th',
//         i18n:
//         {
//             locales:'th',
//             months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
//             weekdaysShort : ['พฤ ','ศ ','ส ','อา ','จ ','อ ','พ '],
//             //weekdaysShort : ['อา','จ','อ','พ','พฤ','ศ','ส'],
//             weekdaysAbbrev : ['พฤ','ศ','ส','อา','จ','อ','พ'],
//             //weekdaysAbbrev : ['อา','จ','อ','พ','พฤ','ศ','ส'],
//             monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
//         },
//         onOpen(){

//             var element = document.querySelector('.datepicker');

//             if(document.querySelector('.datepicker').value==""){
//                 $("datepicker").datepicker("setDate",new Date(year,month,day));
//                 M.Datepicker.getInstance(element).setDate(new Date(year,month,day), true);
//             }else{
//                 M.Datepicker.getInstance(element).setDate(new Date(element.value), true);
//             }

//         }
//     });
// });

setBillModal = (
    mem_no,
    mem_card_id,
    mem_title,
    mem_fname,
    mem_lname,
    mem_birthdate,
    mem_age,
    mem_add_no,
    mvname,
    mem_status,
    mtname,
    register_date,
    resign_date,
    mem_cause_st,
    totalDateFund,
    savings,
    amount_ben
    ) => {

    document.getElementById("mem_no").textContent=(mem_no);
    document.getElementById("mem_card_id").textContent=(mem_card_id);

    if(mem_title==1){
        document.getElementById("mem_title").textContent=("นาย");
        document.getElementById("mem_gender").textContent=("ชาย");
    }else if(mem_title==2){
        document.getElementById("mem_title").textContent=("นาง");
        document.getElementById("mem_gender").textContent=("หญิง");
    }else if(mem_title==3){
        document.getElementById("mem_title").textContent=("นางสาว");
        document.getElementById("mem_gender").textContent=("หญิง");
    }else if(mem_title==4){
        document.getElementById("mem_title").textContent=("เด็กชาย");
        document.getElementById("mem_gender").textContent=("ชาย");
    }else if(mem_title==5){
        document.getElementById("mem_title").textContent=("เด็กหญิง");
        document.getElementById("mem_gender").textContent=("หญิง");
    }

    document.getElementById("mem_fname").textContent=(mem_fname);
    document.getElementById("mem_lname").textContent=(mem_lname);

    document.getElementById("mem_birthdate").textContent=(mem_birthdate);
    document.getElementById("mem_age").textContent=(mem_age);
    document.getElementById("mem_add_no").textContent=(mem_add_no);
    document.getElementById("v_id").textContent=(mvname);
    document.getElementById("mem_status").textContent=(mem_status);
    document.getElementById("type_mid").textContent=(mtname);
    document.getElementById("register_date").textContent=(register_date);

    if(resign_date==""){
        document.getElementById("resign_date").textContent=("-");
    }else{
        document.getElementById("resign_date").textContent=(resign_date);
    }

    if(mem_cause_st==""){
        document.getElementById("mem_cause_st").textContent=("-");
    }else{
        document.getElementById("mem_cause_st").textContent=(mem_cause_st);
    }

    document.getElementById("totalDateFund").textContent=(totalDateFund);
    document.getElementById("savings").textContent=(savings);
    document.getElementById("amount_ben").textContent=(amount_ben);
}
