
//--------------------------- ตรวจสอบ Personnel ------------------------------------//
function readURL(input) {
    var FileSize = input.files[0].size / 1024 / 1024; // in MB
    var extall="jpg,jpeg,png";

    if (FileSize > 2) {
        Swal.fire({
            title: 'ขนาดไฟล์ใหญ่เกิน 2 MB',
            type: 'error',
            showConfirmButton: false,
            timer: 1500
          })
       // $(file).val(''); //for clearing with Jquery
    } else {

        file = document.formPer.imageUpload.value;
		ext = file.split('.').pop().toLowerCase();

        if(parseInt(extall.indexOf(ext)) < 0) {
			Swal.fire({
                        title: 'ประเภทไฟล์ไม่ถูกต้อง',
                        text: "กรุณาใช้นามสกุลไฟล์ .jpg .jpeg .png",
                        type: 'error',
                        showConfirmButton: true
                      })
			return false;
        }else{
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

function chkFrmPer() {

    if(document.formPer.password.value != document.formPer.p_cpassword.value)
	{
		Swal.fire({
            title: 'รหัสผ่านไม่ตรงกัน',
            type: 'error',
            showConfirmButton: false,
            timer: 1500
          })
		document.formPer.p_cpassword.focus();
		return false;
    }

    var x = document.getElementById("posfSelect").value;
    var y = document.getElementById("poscSelect").value;
    var z = document.getElementById("type_pSelect").value;

    if (x == 0){
            Swal.fire({
                title: 'เลือกข้อมูลตำแหน่งในกองทุน',
                type: 'warning',
                showConfirmButton: false,
                timer: 1500
              })
            return false;
    }else if (y == 0){
            Swal.fire({
                title: 'เลือกข้อมูลตำแหน่งในหมู่บ้าน',
                type: 'warning',
                showConfirmButton: false,
                timer: 1500

              })
            return false;
    }else if (z == 0){
            Swal.fire({
                title: 'เลือกประเภทผู้ใช้',
                type: 'warning',
                showConfirmButton: false,
                timer: 1500
              })
            return false;
    }else{
            return true;
    }

}

function chkFrmPerEdit() {

    if(document.formPer.password.value != document.formPer.p_cpassword.value)
	{
		Swal.fire({
            title: 'รหัสผ่านไม่ตรงกัน',
            type: 'warning',
            showConfirmButton: false,
            timer: 1500
          })
		document.formPer.p_cpassword.focus();
		return false;
    }

    var x = document.getElementById("posfSelect").value;
    var y = document.getElementById("poscSelect").value;
    var z = document.getElementById("type_pSelect").value;

    if (x == 0){
            Swal.fire({
                title: 'เลือกข้อมูลตำแหน่งในกองทุน',
                type: 'warning',
                showConfirmButton: false,
                timer: 1500
              })
            return false;
    }else if (y == 0){
            Swal.fire({
                title: 'เลือกข้อมูลตำแหน่งในหมู่บ้าน',
                type: 'warning',
                showConfirmButton: false,
                timer: 1500

              })
            return false;
    }else if (z == 0){
            Swal.fire({
                title: 'เลือกประเภทผู้ใช้',
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
              document.getElementById("formPer").submit();
            }
          })
          return false;
    }
}



