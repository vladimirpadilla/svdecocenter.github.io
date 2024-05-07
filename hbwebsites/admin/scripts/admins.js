let admin_form = document.getElementById('admin_form');

  admin_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_admin();
  });

function add_admin()
{
  let data = new FormData();
  data.append('system_name',admin_form.elements['system_name'].value);
  data.append('phonenum',admin_form.elements['phonenum'].value);
  data.append('system_pass',admin_form.elements['system_pass'].value);
  // data.append('cpass',admin_form.elements['cpass'].value);
  data.append('add_admin','');

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/admins.php",true);

  xhr.onload = function(){
    var myModal = document.getElementById('adminModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if(this.responseText == 0){
      alert('success','New Admin added!');
      admin_form.reset();
      get_all_admin();
    }
    else{
      alert('error','Not Manager added!');
    }
  }

  xhr.send(data);
}

function get_all_admin()
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/admins.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function(){
    document.getElementById('admin-data').innerHTML = this.responseText;
  }

  xhr.send('get_all_admin');
}

window.onload = function(){
  get_all_admin();
}

function toggle_status(id,val)
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/admins.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function(){
    if(this.responseText){
      alert('success','Status toggled!');
      get_all_admin();
    }
    else{
      alert('success','Server Down!');
    }
  }

  xhr.send('toggle_status='+id+'&value='+val);
}

function removed_admin(system_name)
  {
    if(confirm("Are you sure, you want to remove this this?"))
    {
      let data = new FormData();
      data.append('system_name',system_name);
      data.append('removed_admin','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/admins.php",true);

      xhr.onload = function()
      {
      if(this.responseText == 1){
        alert('success','User Removed!');
        get_users();
      }
      else{
        alert('error','User removal failed!');
      }
      }
      xhr.send(data);
    }
  }

