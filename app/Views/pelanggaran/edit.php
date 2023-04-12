<form autocomplete="off" class="row g-3 mt-3" action="<?= site_url() ?>pelanggaran/<?= $pelanggaran['id'] ?>" method="POST" id="form">

    <?= csrf_field() ?>

    <input type="hidden" name="_method" value="PUT">

    <div class="row mb-3">
        <label for="nama_pelanggaran" class="col-sm-3 col-form-label">Nama Pelanggaran</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran" value="<?= $pelanggaran['nama_pelanggaran']; ?>">                
            <div class="invalid-feedback error-nama_pelanggaran"></div>
        </div>
    </div>
        
    <div class="row mb-3">
        <label for="range_point" class="col-sm-3 col-form-label">Range Point Pelanggaran</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="range_point" name="range_point" value="<?= $pelanggaran['range_point']; ?>">
            <div class="invalid-feedback error-range_point"></div>
        </div>
    </div>

    <div class="text-center">
        <button id="#tombolUpdate" class="btn px-5 btn-outline-primary" type="submit">Update<i class="fa-fw fa-solid fa-check"></i></button>
    </div>
</form>

<?= $this->include('MyLayout/js') ?>

<script>
    $(document).ready(function() {
        // Alert
        var op = <?= (!empty(session()->getFlashdata('pesan')) ? json_encode(session()->getFlashdata('pesan')) : '""'); ?>;
        if (op != '') {
            Toast.fire({
                icon: 'success',
                title: op
            })
        }

        // Bahan Alert
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            background: '#63ec88',
            color: '#fff',
            iconColor: '#fff',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    })

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

                    if (err.error_nama_pelanggaran) {
                        $('.error-nama_pelanggaran').html(err.error_nama_pelanggaran);
                        $('#nama_pelanggaran').addClass('is-invalid');
                    } else {
                        $('.error-nama_pelanggaran').html('');
                        $('#nama_pelanggaran').removeClass('is-invalid');
                        $('#nama_pelanggaran').addClass('is-valid');
                    }
                    if (err.error_range_point) {
                        $('.error-range_point').html(err.error_range_point);
                        $('#range_point').addClass('is-invalid');
                    } else {
                        $('.error-range_point').html('');
                        $('#range_point').removeClass('is-invalid');
                        $('#range_point').addClass('is-valid');
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
</script>