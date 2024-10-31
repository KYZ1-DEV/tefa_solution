<!-- Modal for Upload -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('admin.upload.template') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="uploadModalLabel">Upload Template Laporan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Informasi Status File -->
            <div class="alert alert-info">
              <p>Status File Laporan:</p>
              <ul>
                <li>Laporan 0%: {{ isset($statuses['0']) && $statuses['0'] ? 'Sudah diunggah' : 'Belum diunggah' }}</li>
                <li>Laporan 50%: {{ isset($statuses['50']) && $statuses['50'] ? 'Sudah diunggah' : 'Belum diunggah' }}</li>
                <li>Laporan 100%: {{ isset($statuses['100']) && $statuses['100'] ? 'Sudah diunggah' : 'Belum diunggah' }}</li>
              </ul>
            </div>
  
            <!-- Form Upload -->
            <div class="form-group">
              <label for="templateFile">Pilih file PDF</label>
              <input type="file" class="form-control" id="templateFile" name="template" accept="application/pdf" required>
            </div>
            <div class="form-group mt-3">
              <label for="reportPercentage">Pilih Persentase Laporan</label>
              <select class="form-control" id="reportPercentage" name="percentage" required>
                <option value="0">0%</option>
                <option value="50">50%</option>
                <option value="100">100%</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  