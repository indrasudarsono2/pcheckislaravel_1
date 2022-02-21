$(document).ready(function () {
  $("#download").bind("click", function (event) {
    // cetak data pada area <div id="#data-mahasiswa"></div>
    $('#pdf').printArea();
  });
});

