
$(document).ready(function() {

    $('.modal').modal();

});

    var numberNot = "0123456789-"
    var money = "0123456789.";
    var homenumber = "0123456789/";
    var number = "0123456789";
    var alphaWeb = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/.-_:";
    var alphaemail = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@.-_";
    var alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮ ุูึำะัี้็่๋าิื์ไใเแ";
    var alphaNumber = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮ ุูึำะัี้็่๋าิื์ไใเแ0123456789";
    var usn = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ._@";

    function controlchars(thestr,controlstr)
    {


        if(controlstr.indexOf(thestr.value.charAt(thestr.value.length - 1)) == -1)
        {
            var x=thestr.value.length - 1;
            thestr.value=thestr.value.substring(0,x)
        }
    }




setBillModal = (
        fund_name,
        fund_no,
        fund_village,
        fund_moo,
        fund_soi,
        fund_road,
        fund_tumbol,
        fund_district,
        fund_province,
        fund_zipcode,
        fund_tel,
        fund_tel_m,
        fund_fax,
        fund_email,
        fund_web,
        fund_name_h,
        fund_name_c,
        fund_habitant
    ) => {

    document.getElementById("fund_name").textContent=(fund_name);
    document.getElementById("fund_no").textContent=(fund_no);
    document.getElementById("fund_village").textContent=(fund_village);
    document.getElementById("fund_moo").textContent=(fund_moo);
    document.getElementById("fund_soi").textContent=(fund_soi);
    document.getElementById("fund_road").textContent=(fund_road);
    document.getElementById("fund_tumbol").textContent=(fund_tumbol);
    document.getElementById("fund_district").textContent=(fund_district);
    document.getElementById("fund_province").textContent=(fund_province);
    document.getElementById("fund_zipcode").textContent=(fund_zipcode);
    document.getElementById("fund_tel").textContent=(fund_tel);
    document.getElementById("fund_tel_m").textContent=(fund_tel_m);
    document.getElementById("fund_fax").textContent=(fund_fax);
    document.getElementById("fund_email").textContent=(fund_email);
    document.getElementById("fund_web").textContent=(fund_web);
    document.getElementById("fund_name_h").textContent=(fund_name_h);
    document.getElementById("fund_name_c").textContent=(fund_name_c);
    document.getElementById("fund_habitant").textContent=(fund_habitant);
}
