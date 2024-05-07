function get_bookings(search='',page=1)
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/booking_records.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function(){
    let data = JSON.parse(this.responseText);
    document.getElementById('booking-data').innerHTML = data.booking_data;
    document.getElementById('table-pagination').innerHTML = data.pagination;

  }

  xhr.send('get_bookings&search='+search+'&page='+page);
}


window.onload = function(){
  get_bookings();
}
