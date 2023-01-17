
$('.datepicker').datepicker({
  clearBtn: true,
  changeYear: true,
  changeMonth: true,
  autoclose: true,
  todayHighlight: true,
  format: 'mm/dd/yyyy',
  startDate: new Date(),
  endDate: new Date(new Date().setDate(new Date().getDate() + 60))
});

// Total harga kamar + lama sewa
$(function() {
  $(".DropChange").change(function(){
    var valone = $('#hargakamar').val();
    var valtwo = $('#lamasewa').val();
    var perkalian =  valone  * valtwo;
    var totalharga = 'Rp ' + perkalian.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    $('#sewakamar').text(totalharga);
  });
});

// Total harga sewa kamar keseluruhan
$(function() {
  $(".DropChange").change(function(){
    var valone      = $('#hargakamar').val();
    var valtwo      = $('#lamasewa').val();
    var valThree    = $('#depost').val();
    var valFour     = $('#biayadmin').val();
    var perkalian   =  valone  * valtwo;
    var jumlah = parseInt(perkalian) + parseInt(valThree) + parseInt(valFour);
    var totalharga  = 'Rp ' + jumlah.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    $('#hargatotal').text(totalharga);
  });
});


// Total harga di kurangi points
$(function () {
  $(".DropChange").change(function () {
    var valPoints = $('#points').val();
    var valone      = $('#hargakamar').val();
    var valtwo      = $('#lamasewa').val();
    var valThree    = $('#depost').val();
    var valFour     = $('#biayadmin').val();
    var perkalian   =  valone  * valtwo;
    var jumlah      = parseInt(perkalian) + parseInt(valThree) + parseInt(valFour);
    var total = parseInt(jumlah) - parseInt(valPoints);
    var totalhargapoints = 'Rp ' + total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    $('#hargatotalpoints').text(totalhargapoints);
  });
});

// Tampil tombol and jumlah harga
document.getElementById('lamasewa').addEventListener('change', function () {
  var style = this.value == 1 ? 'block' : this.value == 3 ? 'block' :  'none';

  document.getElementById('tampil').style.display = style;
});

var switchStatus = false;
$("#useCredit").on('change', function() {
    if ($(this).is(':checked')) {
      switchStatus = $(this).is(':checked');
      alert('Gunakan Points Untuk Pembayaran ?');// To verify
      document.getElementById("show").style.display = "block";
      document.getElementById("harga").style.display = "none";
    }
    else {
      switchStatus = $(this).is(':checked');
      alert('Gak Jadi Deh !');// To verify
      document.getElementById("show").style.display = "none";
      document.getElementById("harga").style.display = "block";
    }
});

// Simpan kamar
$(document).on('click','#simpan', function () {
  var id = $(this).attr('data-id-simpan');
  $.get('/simpan/kamar', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(_resp){
    location.reload();
    alert('Kamar berhasil disimpan.')
  });
});

// Hapus kamar
$(document).on('click','#hapus', function () {
  var id = $(this).attr('data-id-hapus');
  $.get('/hapus/kamar', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(_resp){
    location.reload();
    alert('Kamar berhasil dihapus.')
  });
});

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
$(document).ready(function() {
  $('#eventshow').click(function() {
    $('.alerts').show()
  })
});
