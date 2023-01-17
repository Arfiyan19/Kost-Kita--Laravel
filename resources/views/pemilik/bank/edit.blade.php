 <div class="modal fade" id="editBank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Update Rekening Bank</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
            <div class="modal-body">
                <input type="hidden" name="id_bank" id="id_bank">
                <div class="form-group">
                  <label for="Nama Bank">Nama Bank</label>
                  <select name="nama_bank" id="nama_bank" class="select2 form-control @error('nama_bank') is-invalid @enderror">
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
                    <input type="number" name="no_rekening" class="form-control  @error('no_rekening') is-invalid @enderror" id="no_rekening">
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
                    <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update_bank">Update</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>
