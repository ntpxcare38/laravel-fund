setBillModal = (
    group_acid,
    group_acname,
    type_acc,
    ) => {

    $('#group_acid').val(group_acid)
    $('#group_acname').val(group_acname);
    if(type_acc==1){
        myFunction(1);
    }
    else if(type_acc==2){
        myFunction(2);
    }
    else if(type_acc==3){
        myFunction(3);
    }
    else if(type_acc==4){
        myFunction(4);
    }
}

function myFunction(p) {
    if(p==1){
        document.getElementById("type_acc1").checked = true;
    }
    if(p==2){
        document.getElementById("type_acc2").checked = true;
    }
    if(p==3){
        document.getElementById("type_acc3").checked = true;
    }
    if(p==4){
        document.getElementById("type_acc4").checked = true;
    }
}
