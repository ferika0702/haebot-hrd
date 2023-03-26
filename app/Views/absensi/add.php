<form autocomplete="off" class="row g-3 mt-2" action="<?= site_url() ?>absensi" method="POST" id="form">

    <?= csrf_field() ?>

    <div class="row mb-3">
        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="tanggal" id="tanggal" autofocus>
            <div class="invalid-feedback error-tanggal"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Karyawan</label>
        <div class="col-sm-9">
        <select class="form-control" name="nama_lengkap" id="nama_lengkap">
            <option value=""></option>
            <?php foreach ($absensi as $absensi) : ?>
                <option value="<?= $absensi['id'] ?>"><?= $absensi['nama_lengkap'] ?></option>
            <?php endforeach ?>
        </select>
        </div>
    </div>

    <div class="row mb-3">
        <label for="masuk1" class="col-sm-3 col-form-label">Jam Masuk 1</label>
        <div class="col-sm-9">
            <input type="time" class="form-control" id="masuk1" name="masuk1" autofocus>
            <div class="invalid-feedback error-masuk1"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="keluar1" class="col-sm-3 col-form-label">Jam Keluar 1</label>
        <div class="col-sm-9">
            <input type="time" class="form-control" id="keluar1" name="keluar1" autofocus>
            <div class="invalid-feedback error-keluar1"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="masuk2" class="col-sm-3 col-form-label">Jam Masuk 2</label>
        <div class="col-sm-9">
            <input type="time" class="form-control" id="masuk2" name="masuk2" autofocus>
            <div class="invalid-feedback error-masuk2"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="keluar2" class="col-sm-3 col-form-label">Jam Keluar 2</label>
        <div class="col-sm-9">
            <input type="time" class="form-control" id="keluar2" name="keluar2" autofocus>
            <div class="invalid-feedback error-keluar2"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="masuk3" class="col-sm-3 col-form-label">Jam Masuk 3</label>
        <div class="col-sm-9">
            <input type="time" class="form-control" id="masuk3" name="masuk3" autofocus>
            <div class="invalid-feedback error-masuk3"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="keluar3" class="col-sm-3 col-form-label">Jam Keluar 3</label>
        <div class="col-sm-9">
            <input type="time" class="form-control" id="keluar3" name="keluar3" autofocus>
            <div class="invalid-feedback error-keluar3"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="Status" class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-9">
            <select class="form-control" name="status" id="status">
                <option value=""></option>
                <option value="MASUK">Masuk</option>
                <option value="ALFA">Alfa</option>
                <option value="IZIN">Izin</option>
                <option value="SAKIT">Sakit</option>
                <option value="LIBUR">Libur</option>
                <option value="WFA">Wfa</option>
            </select>
            <div class="invalid-feedback error-status"></div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="total_menit" class="col-sm-3 col-form-label">Total Menit</label>
        <div class="col-sm-9">
            <input type="number" class="form-control" id="total_menit" name="total_menit" autofocus>
            <div class="invalid-feedback error-keterangan"></div>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="keterangan" class="col-sm-3 col-form-label">keterangan</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="keterangan" name="keterangan" autofocus>
            <div class="invalid-feedback error-keterangan"></div>
        </div>
    </div>

    <div class="col-md-9 offset-3 mb-3">
        <button id="tombolSimpan" class="btn px-5 btn-outline-primary" type="submit">Simpan <i class="fa-fw fa-solid fa-check"></i></button>
    </div>
</form>



<script>
    $('#form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#tombolSimpan').html('Tunggu <i class="fa-solid fa-spin fa-spinner"></i>');
                $('#tombolSimpan').prop('disabled', true);
            },
            complete: function() {
                $('#tombolSimpan').html('Simpan <i class="fa-fw fa-solid fa-check"></i>');
                $('#tombolSimpan').prop('disabled', false);
            },
            success: function(response) {
                if (response.error) {
                    let err = response.error;

                    if (err.error_tanggal) {
                        $('.error-tanggal').html(err.error_tanggal);
                        $('#tanggal').addClass('is-invalid');
                    } else {
                        $('.error-tanggal').html('');
                        $('#tanggal').removeClass('is-invalid');
                        $('#tanggal').addClass('is-valid');
                    }
                    if (err.error_nama_lengkap) {
                        $('.error-nama_lengkap').html(err.error_nama_lengkap);
                        $('#nama_lengkap').addClass('is-invalid');
                    } else {
                        $('.error-nama_lengkap').html('');
                        $('#nama_lengkap').removeClass('is-invalid');
                        $('#nama_lengkap').addClass('is-valid');
                    }
                    if (err.error_status) {
                        $('.error-status').html(err.error_status);
                        $('#status').addClass('is-invalid');
                    } else {
                        $('.error-status').html('');
                        $('#status').removeClass('is-invalid');
                        $('#status').addClass('is-valid');
                    }
                }
                if (response.success) {
                    $('#my-modal').modal('hide')
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.success,
                    }).then((value) => {
                        location.reload()
                    })
                }
            },
            error: function(e) {
                alert('Error \n' + e.responseText);
            }
        });
        return false
    })

    $(document).ready(function() {
        $("#nama_lengkap").select2({
            theme: "bootstrap-5",
            tags: true,
            dropdownParent: $('#my-modal')
        });

        $("#status").select2({
            theme: "bootstrap-5",
            dropdownParent: $('#my-modal')
        });
        
        $('#tanggal').datepicker({
            format: "yyyy-mm-dd"
        });
    })
    
</script>