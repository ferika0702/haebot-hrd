<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu div-menu">
            <div class="nav">
                <br>

                <?php if (has_permission('Dashboard') || has_permission('SDM')) : ?>
                    <small class="my-0 ms-3 text-secondary"></small>
                <?php endif; ?>

                <?php if (has_permission('Dashboard')) : ?>
                    <a class="nav-link" href="<?= base_url() ?>/dashboard">
                        <div class="sb-nav-link-icon">
                            <i class="fa-fw fa-solid fa-gauge"></i>
                        </div>
                        Dashboard
                    </a>
                <?php endif; ?>

                <?php if (has_permission('SDM')) : ?>
                    <a class="nav-link" href="<?= base_url() ?>/karyawan">
                        <div class="sb-nav-link-icon">
                            <i class="fa-fw fa-solid fa-user"></i>
                        </div>
                        Karyawan
                    </a>
                <?php endif; ?>

                <?php if (has_permission('SDM')) : ?>
                    <a class="nav-link" href="<?= base_url() ?>/absensi">
                        <div class="sb-nav-link-icon">
                            <i class="fa-fw fa-solid fa-user"></i>
                        </div>
                        Absensi
                    </a>
                <?php endif; ?>

                <?php if (has_permission('SDM')) : ?>
                    <a class="nav-link" href="<?= base_url() ?>/divisi">
                        <div class="sb-nav-link-icon">
                            <i class="fa-fw fa-solid fa-network-wired"></i>
                        </div>
                        Divisi
                    </a>
                <?php endif; ?>

                <?php if (has_permission('SDM')) : ?>
                    <a class="nav-link" href="<?= base_url() ?>/rekrutmen">
                        <div class="sb-nav-link-icon">
                            <i class="fa-fw fa-solid fa-folder-plus"></i>
                        </div>
                        Rekrutmen
                    </a>
                <?php endif; ?>

                <?php if (has_permission('SDM')) : ?>
                    <a class="nav-link" href="<?= base_url() ?>/resign">
                        <div class="sb-nav-link-icon">
                            <i class="fa-fw fa-solid fa-folder-minus"></i>
                        </div>
                        Resign
                    </a>
                <?php endif; ?>

                <?php if (has_permission('SDM')) : ?>
                    <a class="nav-link" href="<?= base_url() ?>/mutasi">
                        <div class="sb-nav-link-icon">
                            <i class="fa-fw fa-solid fa-right-left"></i>
                        </div>
                        Mutasi
                    </a>
                <?php endif; ?>

                <?php if (has_permission('SDM')) : ?>
                    <!-- <a class="nav-link" href="<?= base_url() ?>/pengaturan_user"> -->
                    <a class="nav-link" href="<?= base_url() ?>/user">
                        <div class="sb-nav-link-icon">
                            <i class="fa-fw fa-solid fa-gear"></i>
                        </div>
                        Pengaturan User
                    </a>
                <?php endif; ?>

            </div>
        </div>
        <div class="sb-sidenav-footer py-1">
            <div class="small">Masuk sebagai :</div>
            <?= user()->name ?>
        </div>
    </nav>
</div>