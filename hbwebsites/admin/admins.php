<script>
let admin_form = document.getElementById('admin-form');

      admin_form.addEventListener('submit',function(e){
        e.preventDefault();

      let data = new FormData();

      data.append('name',admin_form.elements['name'].value);
      data.append('email',admin_form.elements['email'].value);
      data.append('phonenum',admin_form.elements['phonenum'].value);
      data.append('pass',admin_form.elements['pass'].value);
      data.append('cpass',admin_form.elements['cpass'].value);
      data.append('admin','');

      var myModal = document.getElementById('addadminModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();
  
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/admin.php",true);
  
      xhr.onload = function(){
        if(this.responseText == 'pass_mismatch'){
          alert('error',"Password Mismatch!");
        }
        else if(this.responseText == 'email_already'){
          alert('error',"Email is already registered!");
        }
        else if(this.responseText == 'phone_already'){
          alert('error',"Phone number is already registered!");
        }
        else if(this.reponseText == 'mail_failed'){
          alert('error',"Cannot send confirmation email! Server down!");
        }
        else if(this.reponseText == 'ins_failed'){
          alert('error',"Registration failed! Server down!");
        }
        else{
          alert('success',"Registration successful.");
          admin_form.reset();
        }
      }
  
      xhr.send(data);
    });

    let log_form = document.getElementById('log-form');

    log_form.addEventListener('submit', (e)=>{
      e.preventDefault();
      
      let data = new FormData();
  
      data.append('email_mob',log_form.elements['email_mob'].value);
      data.append('pass',log_form.elements['pass'].value);
      data.append('login','');
  
      var myModal = document.getElementById('loginadminModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();
  
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/admin.php",true);
  
      xhr.onload = function(){
        if(this.responseText == 'inv_email_mob'){
          alert('error',"Invalid Email or Mobile Number!");
        }
        else if(this.responseText == 'inactive'){
          alert('error',"Account Suspended! Please contact Admin.");
        }
        else if(this.reponseText == 'invalid_pass'){
          alert('error',"Incorrect Password!");
        }
      }
  
      xhr.send(data);
    });
</script>