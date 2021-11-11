function validation(){

    const Admin_username= document.getElementById("ad_username");
    const Admin_password= document.getElementById("ad_password");
    const error_message =document.getElementById("error_message");
  
    if(Admin_username.value==""){
      error_message.innerHTML="Enter username of Admin Please.";
     return false;
    }else if(Admin_password.value==""){
      error_message.innerHTML="Enter Passwor of Admin Please.";
     return false;
    }
  
  }