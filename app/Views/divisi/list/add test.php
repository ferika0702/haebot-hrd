<form autocomplete="off" class="row g-3 mt-2" action="<?= site_url() ?>list/create" method="POST" id="form">

    <?= csrf_field()?>
    
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered" width="100%" id="tabel">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th class="text-center" width="30%">Nama</th>
                    <th class="text-center" width="10%">Jabatan</th>
                    <th class="text-center" width="10%">Pendidikan</th>
                    <th class="text-center" width="10%">No Telepon</th>
                    <th class="text-center" width="20%">Email</th>
                    <th class="text-center" width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1 ?>
                <?php foreach ($karyawan as $karyawan) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $karyawan['nama_lengkap'] ?></td>
                        <td><?= $karyawan['jabatan'] ?></td>
                        <td><?= $karyawan['pendidikan'] ?></td>
                        <td><?= $karyawan['no_telp'] ?></td>
                        <td><?= $karyawan['email'] ?></td>
                        <td class="text-center">
                            <a title="Detail" class="px-2 py-0 btn btn-sm btn-outline-dark" onclick="Plus()">
                                <i class="fa-fw fa-solid fa-plus"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tr>

            </tbody>
        </table>
    </div>

</form>



<script>
    // $('#form').submit(function(e) {
    //     e.preventDefault();

    //     $.ajax({
    //         type: "post",
    //         url: $(this).attr('action'),
    //         data: $(this).serialize(),
    //         dataType: "json",
    //         beforeSend: function() {
    //             $('#tombolSimpan').html('Tunggu <i class="fa-solid fa-spin fa-spinner"></i>');
    //             $('#tombolSimpan').prop('disabled', true);
    //         },
    //         complete: function() {
    //             $('#tombolSimpan').html('Simpan <i class="fa-fw fa-solid fa-check"></i>');
    //             $('#tombolSimpan').prop('disabled', false);
    //         },
    //         success: function(response) {
    //             if (response.error) {
    //                 let err = response.error;

    //                 if (err.error_karyawan) {
    //                     $('.error-karyawan').html(err.error_karyawan);
    //                     $('#karyawan').addClass('is-invalid');
    //                 } else {
    //                     $('.error-karyawan').html('');
    //                     $('#karyawan').removeClass('is-invalid');
    //                     $('#karyawan').addClass('is-valid');
    //                 }
    //                 if (err.error_divisi) {
    //                     $('.error-divisi').html(err.error_divisi);
    //                     $('#divisi').addClass('is-invalid');
    //                 } else {
    //                     $('.error-divisi').html('');
    //                     $('#divisi').removeClass('is-invalid');
    //                     $('#divisi').addClass('is-valid');
    //                 }
    //             }
    //             if (response.success) {
    //                 $('#my-modal').modal('hide')
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Berhasil',
    //                     text: response.success,
    //                 }).then((value) => {
    //                     location.reload()
    //                 })
    //             }
    //         },
    //         error: function(e) {
    //             alert('Error \n' + e.responseText);
    //         }
    //     });
    //     return false
    // })
    

    $(document).ready(function() {
        $("#karyawan").select2({
            theme: "bootstrap-5",
            tags: true,
            dropdownParent: $('#my-modal')
        });

        $("#divisi").select2({
            theme: "bootstrap-5",
            dropdownParent: $('#my-modal')
    });
})
</script>