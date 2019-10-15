setBillModal = (
    p_title,
    p_fname,
    p_lname,
    p_photo,
    position_f,
    position_c,
    p_tel,
    type_per,
    p_username
    ) => {

    if(p_title==1){
        document.getElementById("p_title").textContent=("นาย");
    }else if(p_title==2){
        document.getElementById("p_title").textContent=("นาง");
    }else if(p_title==3){
        document.getElementById("p_title").textContent=("นางสาว");
    }

    document.getElementById("p_fname").textContent=(p_fname);
    document.getElementById("p_lname").textContent=(p_lname);

    document.getElementById("imagePreview").style.backgroundImage = "url('/storage/"+p_photo+"')";

    document.getElementById("position_f").textContent=(position_f);
    document.getElementById("position_c").textContent=(position_c);
    document.getElementById("p_tel").textContent=(p_tel);

    if(type_per==1){
        document.getElementById("type_per").textContent=("ผู้ดูแลระบบ");
    }else if(type_per==2){
        document.getElementById("type_per").textContent=("ผู้บริหาร/กรรมการ");
    }else if(type_per==3){
        document.getElementById("type_per").textContent=("เจ้าหน้าที่");
    }else if(type_per==4){
        document.getElementById("type_per").textContent=("พ้นสภาพ");
    }

    document.getElementById("p_username").textContent=(p_username);

    document.getElementById("linkImage").href = "download/"+p_photo;


}
