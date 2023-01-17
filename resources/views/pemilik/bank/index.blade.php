 <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Form Tambah Rekening Bank</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{url('pemilik/rekening')}}" method="POST">
          @csrf
            <div class="modal-body">
                <div class="form-group">
                  <label for="Nama Bank">Nama Bank</label>
                  <select name="nama_bank" class="select2 form-control @error('nama_bank') is-invalid @enderror">
                    <option> Pilih Bank</option>
                    @foreach ($listBank as $banks)
                      <option value="{{$banks->nama_bank}}">{{$banks->nama_bank}}</option>
                    @endforeach
                  </select>
                  @error('nama_bank')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group">
                  <div class="controls">
                    <label for="No Rekening">No. Rekening</label>
                    <input type="number" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" placeholder="Nomor Rekening">
                    @error('no_rekening')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <div class="controls">
                    <label for="Nama Pemilik">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" placeholder="Nama Pemilik">
                    @error('nama_pemilik')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <fieldset>
                  <div class="vs-checkbox-con vs-checkbox-danger" data-toggle="tooltip" data-placement="top" title="Aktifkan Bank">
                    <input type="checkbox" name="is_active" value="1" id="is_active">
                      <span class="vs-checkbox vs-checkbox-lg" >
                          <span class="vs-checkbox--check">
                              <i class="vs-icon feather icon-check"></i>
                          </span>
                      </span>
                    <span class="">Aktifkan Bank</span>
                  </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>
