<?= $this->extend('MyLayout/template') ?>

<?= $this->section('content') ?>


<main class="p-md-3 p-2">
    <h3 style="color: #566573;">Pengaturan User dan Group</h3>

    <hr>

    <div class="row mt-4">
        <div class="col-md-4">
            <a class="text-decoration-none" href="<?= base_url() ?>view-absensi">
                <div class="card mb-3 shadow" style="border: 1px solid #1762A5;">
                    <h5 class="card-header" style="background-color: #1762A5; color: #fff;">Absensi Karyawan</h5>
                    <div class="card-body text-secondary">
                        <i class="fa-3x fa-regular fa-calendar-check"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a class="text-decoration-none" href="<?= base_url() ?>view-laporan">
                <div class="card mb-3 shadow" style="border: 1px solid #1762A5;">
                    <h5 class="card-header" style="background-color: #1762A5; color: #fff;">Laporan</h5>
                    <div class="card-body text-secondary">
                    <i class="fa-3x fa-regular fa-note-sticky"></i>
                    </div>
                </div>
            </a>
        </div>
</main>


<?= $this->endSection() ?>