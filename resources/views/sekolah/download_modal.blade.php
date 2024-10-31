          <!-- Modal -->
          <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="downloadModalLabel">Pilih Laporan yang Akan Diunduh</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>    --}}
                    </div>
                    <div class="modal-body">
                        <p>Pilih persentase laporan yang ingin diunduh:</p>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('download.template.Laporan', ['persentase' => 0]) }}" class="btn btn-gradient w-100">Template Laporan 0%</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('download.template.Laporan', ['persentase' => 50]) }}" class="btn btn-gradient w-100">Template Laporan 50%</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('download.template.Laporan', ['persentase' => 100]) }}" class="btn btn-gradient w-100">Template Laporan 100%</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> --}}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                    </div>
                </div>
            </div>
        </div>