  function get_bookings(search='')
  {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/new_bookings.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
      document.getElementById('booking-data').innerHTML = this.responseText;
    }

    xhr.send('get_bookings&search='+search);
  }

  function confirm_booking(id)
  {
    if(confirm("Are you sure, you want to confirm this bookings?"))
    {
      let data = new FormData();
      data.append('booking_id',id);
      data.append('confirm_booking','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/new_bookings.php",true);

      xhr.onload = function()
      {
        if(this.responseText == 1){
          alert('success','Booking Successfully!');
          get_bookings();
        }
        else{
          alert('error','Server Down!');
        }
      }

      xhr.send(data);
    }
  }

  function cancel_booking(id)
  {
    if(confirm("Are you sure, you want to cancel this bookings?"))
    {
      let data = new FormData();
      data.append('booking_id',id);
      data.append('cancel_booking','');

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/new_bookings.php",true);

      xhr.onload = function()
      {
        if(this.responseText == 1){
          alert('success','Booking Cancelled!');
          get_bookings();
        }
        else{
          alert('error','Server Down!');
        }
      }

      xhr.send(data);
    }
  }

  window.onload = function(){
    get_bookings();
  }
