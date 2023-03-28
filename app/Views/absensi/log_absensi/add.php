<form autocomplete="off" class="row g-3 mt-2" action="<?= site_url() ?>log-absen/create" method="POST" id="form">
    <?= csrf_field() ?>
    <div class="row mb-3">
        <label for="log_date" class="col-sm-3 col-form-label">Tanggal</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="log_date" name="log_date" autofocus>
            <div class="invalid-feedback error-log_date"></div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="log_time" class="col-sm-3 col-form-label">Waktu Absen</label>
        <div class="col-sm-9">
            <input type="time" class="form-control" id="log_time" name="log_time" autofocus>
            <div class="invalid-feedback error-log_time"></div>
        </div>
    </div>
    
    </div>
    <input type="hidden" name="absen_id" value=<?=$id_absen?>>

    <div class="col-md-9 offset-3 mb-3">
        <button id="tombolSimpan" class="btn px-5 btn-outline-primary" type="submit">Simpan<i class="fa-fw fa-solid fa-check"></i></button>
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
                    if (err.error_log_date) {
                        $('.error-log_date').html(err.error_log_date);
                        $('#log_date').addClass('is-invalid');
                    } else {
                        $('.error-log_date').html('');
                        $('#log_date').removeClass('is-invalid');
                        $('#log_date').addClass('is-valid');
                    }
                    if (err.error_log_time) {
                        $('.error-log_time').html(err.error_log_time);
                        $('#log_time').addClass('is-invalid');
                    } else {
                        $('.error-log_time').html('');
                        $('#log_time').removeClass('is-invalid');
                        $('#log_time').addClass('is-valid');
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

        $('#log_date').datepicker({
            format: "yyyy-mm-dd"
        });
})
</script>