$(function(){
    $('.btn-like').click(function(e) {
	$.post('/like.php', {
	    userid:$(this).attr('data-userid'),
	    type: $(this).attr('data-type'),
	    objid: $(this).attr('data-id')
	}, function(data) {
	    var btn = $('.btn-like[data-type="' + data.type + '"][data-id="' + data.id + '"]');
	    if (data.result == true) {
		btn.addClass('liked');
		btn.text('liked');
	    } else {
		btn.removeClass('liked');
		btn.text('like');
	    }
	});
    });

    $('.editprofile').on('submit',function(event) {
	event.preventDefault(); // Prevent the form from submitting via the browser.
	var form = $(this);
	$.ajax({
	  type: form.attr('method'),
	  url: form.attr('action'),
	  data: form.serialize()
	}).success(function() {
	    alert('saved');
	  // Optionally alert the user of success here...
	});
      });
});


// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
      console.log(place);
      document.getElementById('latitude').value = place.geometry.location.k;
      document.getElementById('longitude').value = place.geometry.location.A.toFixed(6);
      window.setTimeout(function(){document.getElementById('autocomplete').value = place.name;},50)
      

}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
    });
  }
}
// [END region_geolocation]
//
function show_tag(id,show){
    if(show){
	document.getElementById(id).style.display = "inline";
    }
    else{
	document.getElementById(id).style.display = "none";
    }

}
