function chkPwdMem() {

    if(document.formPwMem.new_password.value != document.formPwMem.cnew_password.value)
	{
		Swal.fire({
            title: 'รหัสผ่านไม่ตรงกัน',
            type: 'error',
            showConfirmButton: false,
            timer: 1500
          })
		document.formPwMem.cnew_password.focus();
		return false;
    }

  }
