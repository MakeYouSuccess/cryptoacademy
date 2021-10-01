// Custom file uploader
$('#chooseFile').bind('change', function () {
  var filename = $("#chooseFile").val();
  if (/^\s*$/.test(filename)) {
    $(".file-upload").removeClass('active');
    $("#noFile").text("No file chosen...");
  }
  else {
    $(".file-upload").addClass('active');
    $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
  }
});

// init owlCarousel
$('.owl-carousel-div').owlCarousel({
  center: true,
  items: 2,
  loop: true,
  margin: 0,
  responsive: {
    0: {
      items: 1
    },
    767: {
      items: 2
    },
    1000: {
      items: 3
    },
    1400: {
      items: 4
    }
  }
});
