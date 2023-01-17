  // Tambah Fasilitas Kamar
  var i = 0;
  $("#addfkamar").click(function(){
      ++i;

      $("#fkamar").append('<div class="form-group remove"><div class="row"><div class="col-lg-5 col-xl-5 col-10"><label class="col-form-label" style="color:red">Fasilitas Kamar</label><input type="text" class="form-control" name="addmore['+i+'][name]" placeholder="Tambah Fasilitas Kamar"></div><div class="col-2 col-lg-1 col-xl-1"> <label class="col-form-label">.</label><input type="button" class="form-control btn btn-danger btn-sm remove-fk" value="-"></div></div></div>');
  });

  $(document).on('click', '.remove-fk', function(){
          $(this).parents('.remove').remove();
  });

  // Tambah Fasilitas Kamar Mandi
  var km = 0;
  $("#addkm").click(function(){
      ++km;

      $("#fkm").append('<div class="form-group remove"> <div class="row"><div class="col-lg-5 col-xl-5 col-10"><label class="col-form-label" style="color:red">Fasilitas Kama Mandi</label><input type="text" class="form-control" name="addkm['+km+'][name]" placeholder="Tambah Fasilitas Kama Mandi"></div><div class="col-2 col-lg-1 col-xl-1"><label class="col-form-label">.</label><input type="button" id="addkm" name="addkm" class="form-control btn btn-danger btn-sm remove-km" value="-"></div></div></div>');
  });

  $(document).on('click', '.remove-km', function(){
          $(this).parents('.remove').remove();
  });

  // Tambah Fasilitas Bersama
  var addbersama = 0;
  $("#addbersama").click(function(){
      ++addbersama;

      $("#fbersama").append('<div class="form-group remove"><div class="row"><div class="col-lg-5 col-xl-5 col-10"><label class="col-form-label" style="color:red">Fasilitas Bersama</label><input type="text" class="form-control" name="addbersama['+addbersama+'][name]" placeholder="Tambah Fasilitas Bersama"></div><div class="col-2 col-lg-1 col-xl-1"><label class="col-form-label">.</label><input type="button" class="form-control btn btn-danger btn-sm remove-bersama" value="-"></div></div></div>');
  });

  $(document).on('click', '.remove-bersama', function(){
          $(this).parents('.remove').remove();
  });

  // Tambah Fasilitas Parkir
  var addparkir = 0;
  $("#addparkir").click(function(){
      ++addparkir;

      $("#fparkir").append('<div class="form-group remove"><div class="row"><div class="col-lg-5 col-xl-5 col-10"><label class="col-form-label" style="color:red">Fasilitas Parkir</label><input type="text" class="form-control" name="addparkir['+addparkir+'][name]" placeholder="Tambah Fasilitas Parkir"></div><div class="col-2 col-lg-1 col-xl-1"><label class="col-form-label">.</label><input type="button" id="addparkir" name="addparkir" class="form-control btn btn-danger btn-sm remove-parkir" value="-"> </div></div></div>');
  });

  $(document).on('click', '.remove-parkir', function(){
          $(this).parents('.remove').remove();
  });

  // Tambah Fasilitas Lingkungan
  var area = 0;
  $("#addarea").click(function(){
      ++area;

      $("#farea").append('<div class="form-group remove"><div class="row"><div class="col-lg-5 col-xl-5 col-10""><label class="col-form-label" style="color:red">Area Lingkungan</label><input type="text" class="form-control" name="addarea['+area+'][name]" placeholder="Area Lingkungan"></div><div class="col-2 col-lg-1 col-xl-1"> <label class="col-form-label">.</label><input type="button" class="form-control btn btn-danger btn-sm remove-area" value="-"></div></div></div>');
  });

  $(document).on('click', '.remove-area', function(){
          $(this).parents('.remove').remove();
  });

  // Tambah Foto Kamar
  var foto = 0;
  $("#addfoto").click(function(){
      ++foto;

      $("#image").append('<div class="form-group remove"><div class="row"><div class="col-lg-5 col-xl-5 col-10""><label class="col-form-label" style="color:red">Foto Kamar</label><input type="file" class="form-control" name="addfoto['+foto+'][foto_kamar]"></div><div class="col-2 col-lg-1 col-xl-1"> <label class="col-form-label">.</label><input type="button" class="form-control btn btn-danger btn-sm remove-foto" value="-"></div></div></div>');
  });

  $(document).on('click', '.remove-foto', function(){
          $(this).parents('.remove').remove();
  });
