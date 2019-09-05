
$(document).ready(function() {

    $('.modal').modal();

    $('.materialboxed').materialbox();
    $('.parallax').parallax();
    $('.collapsible').collapsible();
    // SIDENAV
    $('.sidenav').sidenav();
    $('select:not(.swal2-select)').formSelect();
});

    var numberNot = "0123456789-"
    var money = "0123456789.";
    var homenumber = "0123456789/";
    var number = "0123456789";
    var alphaWeb = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/.-_:";
    var alphaemail = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@.-_";
    var alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZกขฃคฅฆงจฉชซฌญฎฏฦฤฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮ ุูึำะัี้็่๋าิื์๊ไใโๆฯเแ";

    var alphaNumber = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZกขฃคฅฆงจฉชซฌญฎฏฦฤฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮ ุูึำะัี้็่๋าิื์๊ไใโๆฯเแ0123456789";
    var usn = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ._@";

function controlchars(thestr,controlstr)
{


	if(controlstr.indexOf(thestr.value.charAt(thestr.value.length - 1)) == -1)
	{
		var x=thestr.value.length - 1;
		thestr.value=thestr.value.substring(0,x)
	}
}

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false,
  })

var deleter = {

    linkSelector : "a#delete-btn",

    init: function() {
        $(this.linkSelector).on('click', {self:this}, this.handleClick);
    },

    handleClick: function(event) {
        event.preventDefault();

        var self = event.data.self;
        var link = $(this);

        Swal.fire({
            title: 'ยืนยันการลบ',
            type: 'question',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            cancelButtonColor: '#C0C0C0',
            cancelButtonColor: '#d33',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location = link.attr('href');
            }
            else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
              ) {
                  Swal.fire(
                  'ยกเลิกแล้ว',
                  'ข้อมูลปลอดภัย ยังไม่ถูกลบ',
                  'error'
                )
              }
        });

    },
};

deleter.init();
