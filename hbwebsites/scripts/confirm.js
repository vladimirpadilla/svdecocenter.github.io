let book_form = document.getElementById('book-form');

  book_form.addEventListener('submit', (e)=>{
    e.preventDefault();
    
    let data = new FormData();

    data.append('name',book_form.elements['name'].value);
    data.append('email',book_form.elements['email'].value);
    data.append('phonenum',book_form.elements['phonenum'].value);
    data.append('address',book_form.elements['address'].value);
    data.append('checkin',book_form.elements['checkin'].value);
    data.append('checkout',book_form.elements['checkout'].value);
    data.append('book','');
    

    var myModal = document.getElementById('bookModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/confirm_booking.php",true);

    xhr.onload = function(){
      if(this.responseText == 'inv_date'){
        alert('error',"Out of date!");
      }
      else{
        alert('success',"Booking successful. Notification Downpayment!");
        book_form.reset();
      }
    }

    xhr.send(data);
  });