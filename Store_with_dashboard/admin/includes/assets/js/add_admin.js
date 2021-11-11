function validation(){

    const Admin_username= document.getElementById("name");
    const Admin_email= document.getElementById("email");
    const Admin_password= document.getElementById("password");
    const Admin_image= document.getElementById("image");
    const error_name =document.getElementById("message_name_error");
    const error_email =document.getElementById("message_email_error");
    const error_pass =document.getElementById("message_pass_error");
    const error_image =document.getElementById("message_image_error");

  
    if(Admin_username.value==""){
        error_name.innerHTML="Enter username of Admin Please.";
     return false;
    } else if(Admin_email.value==""){
        error_name.innerHTML="";
        error_email.innerHTML="Enter Password of Admin Please.";
     return false;
    }
    else if(Admin_password.value==""){
        error_email.innerHTML="";
        error_name.innerHTML="";
        error_pass.innerHTML="Enter Password of Admin Please.";
     return false;
    }else if(Admin_image.value==""){
        error_email.innerHTML="";
        error_name.innerHTML="";
        error_pass.innerHTML="";
        error_image.innerHTML="Enter Your Image URl For You ";
     return false;
    }
    else{
        error_email.innerHTML="";
        error_name.innerHTML="";
        error_pass.innerHTML="";
        error_image.innerHTML="";
        return true;
    }
  
  }