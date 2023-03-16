<?= $this->extend('MyLayout/template') ?>

<?= $this->section('content') ?>


<main class="p-md-3 p-2">

    <div class="d-flex mb-0">
        <div class="me-auto mb-1">
            <h3 style="color: #566573;">User</h3>
        </div>
    </div>

    <hr class="mt-0 mb-4">

    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered" id="tabel">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th class="text-center" width="30%">Nama Lengkap</th>
                    <th class="text-center" width="30%">Email</th>
                    <th class="text-center" width="20%">Username</th>
                    <th class="text-center" width="40%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach ($user as $sp) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $sp->name ?></td>
                        <td><?= $sp->email ?></td>
                        <td><?= $sp->username ?></td>
                        <td class="text-center">
                            
                            <a title="List Group" class="px-2 py-0 btn btn-sm btn-outline-dark" href="<?= site_url() ?>group/<?= $sp->id?>">
                                <i class="fa-fw fa-solid fa-list"></i>
                            </a>

                            <a title="List Permission" class="px-2 py-0 btn btn-sm btn-outline-dark" href="<?= site_url() ?>permission/<?= $sp->id?>">
                                <i class="fa-fw fa-solid fa-list"></i>
                            </a>

                            <button onclick="confirm_delete()" title="Hapus" type="button" class="px-2 py-0 btn btn-sm btn-outline-danger">
                                <i class="fa-fw fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tr>

            </tbody>
        </table>
    </div>

</main>

<!-- Modal -->
<div class="modal fade" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="isiModal">

            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<?= $this->include('MyLayout/js') ?>

<script>
    // Bahan Alert
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        background: '#EC7063',
        color: '#fff',
        iconColor: '#fff',
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })



    function confirm_delete(id) {
        Swal.fire({
            title: 'Konfirmasi?',
            text: "Apakah yakin menghapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#form_delete').attr('action', '<?= site_url() ?>divisi/' + id);
                $('#form_delete').submit();
            }
        })
    }


    $('#tombolTambah').click(function(e) {
        e.preventDefault();
        showModalTambah();
    })


    function showModalTambah() {
        $.ajax({
            type: 'GET',
            url: '<?= site_url() ?>divisi/new',
            dataType: 'json',
            success: function(res) {
                if (res.data) {
                    $('#isiModal').html(res.data);
                    $('#my-modal').modal('toggle')
                    $('#judulModal').html('Tambah Divisi')
                }
            },
            error: function(e) {
                alert('Error \n' + e.responseText);
            }
        })
    }

    


    function showModalDetail(id) {
        $.ajax({
            type: 'GET',
            url: '<?= site_url() ?>divisi/' + id,
            dataType: 'json',
            success: function(res) {
                if (res.data) {
                    $('#isiModal').html(res.data)
                    $('#my-modal').modal('toggle')
                    $('#judulModal').html('Detail Devisi')
                } else {
                    console.log(res)
                }
            },
            error: function(e) {
                alert('Error \n' + e.responseText);
            }
        })
    }


    function showModalEdit(id) {
        $.ajax({
            type: 'GET',
            url: '<?= site_url() ?>divisi/' + id + '/edit',
            dataType: 'json',
            success: function(res) {
                if (res.data) {
                    $('#isiModal').html(res.data)
                    $('#my-modal').modal('toggle')
                    $('#judulModal').html('Edit Devisi')
                } else {
                    console.log(res)
                }
            },
            error: function(e) {
                alert('Error \n' + e.responseText);
            }
        })
    }
</script>

<?= $this->endSection() ?>