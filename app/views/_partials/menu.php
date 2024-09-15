<ul class="navbar-nav ml-auto">
    <?php switch ($this->session->userdata($tabel9_field6)) {
        case $tabel9_field6_value1:
            ?>
            <li class="nav-item">
                <a class="nav-link text-decoration-none font-weight-bold" href="<?= site_url('welcome') ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-decoration-none font-weight-bold" href="<?= site_url('tabel6') ?>">
                    <?= $tabel6_alias ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-decoration-none font-weight-bold" href="<?= site_url('tabel3') ?>">
                    <?= $tabel3_alias ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-decoration-none font-weight-bold" href="<?= site_url('tabel9/login') ?>">Login</a>
            </li>
            <?php break;
        case $tabel9_field6_value5:
        case $tabel9_field6_value2:
        case $tabel9_field6_value4:
        case $tabel9_field6_value3:

            switch ($this->session->userdata($tabel9_field6)) {
                case $tabel9_field6_value2:
                case $tabel9_field6_value3:
                case $tabel9_field6_value4:
                    ?>

                    <li class="nav-item">
                        <a class="nav-link text-decoration-none font-weight-bold"
                            href="<?= site_url('welcome/dashboard') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link text-decoration-none font-weight-bold" data-toggle="dropdown" href="#">Master Data <i
                                    class="fas fa-caret-down"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php switch ($this->session->userdata($tabel9_field6)) {
                                    case $tabel9_field6_value2:
                                        ?>
                                        <h6 class="dropdown-header">
                                            <?= $tabel10_alias ?>
                                        </h6>
                                        <a class="dropdown-item" href="<?= site_url('tabel10/admin') ?>">
                                            <?= $tabel10_alias ?> Aktif
                                        </a>
                                        <a class="dropdown-item" href="<?= site_url('tabel10/history') ?>">
                                            <?= $tabel10_alias ?> History
                                        </a>
                                        <?php break;

                                    case $tabel9_field6_value3:
                                        ?>
                                        <h6 class="dropdown-header">Data</h6>
                                        <a class="dropdown-item" href="<?= site_url('tabel6/admin') ?>">
                                            <?= $tabel6_alias ?>
                                        </a>
                                        <a class="dropdown-item" href="<?= site_url('tabel1/admin') ?>">
                                            <?= $tabel1_alias ?>
                                        </a>
                                        <a class="dropdown-item" href="<?= site_url('tabel3/admin') ?>">
                                            <?= $tabel3_alias ?>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header">Operasional</h6>
                                        <a class="dropdown-item" href="<?= site_url('tabel4/admin') ?>">
                                            <?= $tabel4_alias ?>
                                        </a>
                                        <a class="dropdown-item" href="<?= site_url('tabel5/admin') ?>">
                                            <?= $tabel5_alias ?>
                                        </a>
                                        <a class="dropdown-item" href="<?= site_url('tabel9/admin') ?>">
                                            <?= $tabel9_alias ?>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= site_url('tabel7/admin') ?>">
                                            <?= $tabel7_alias ?>
                                        </a>
                                        <?php break;
                                    case $tabel9_field6_value4:
                                        ?>

                                        <h6 class="dropdown-header">Kelola</h6>
                                        <a class="dropdown-item" href="<?= site_url('tabel5/admin') ?>">
                                            <?= $tabel5_alias ?>
                                        </a>
                                        <a class="dropdown-item" href="<?= site_url('tabel8/admin') ?>">
                                            <?= $tabel8_alias ?>
                                        </a>
                                        <a class="dropdown-item" href="<?= site_url('tabel2/admin') ?>">
                                            <?= $tabel2_alias ?>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header">Operasional</h6>
                                        <a class="dropdown-item" href="<?= site_url('tabel11/admin') ?>">
                                            <?= $tabel11_alias ?>
                                        </a>
                                        <h6 class="dropdown-header">Data</h6>
                                        <a class="dropdown-item" href="<?= site_url('tabel6/admin') ?>">
                                            <?= $tabel6_alias ?>
                                        </a>

                                        <?php break;
                                    default:
                                        ?>
                                        <!-- Show the dropdown for other cases -->
                                        <?php break;
                                } ?>
                            </div>
                        </div>
                    </li>

                    <?php break;
                default:
                    break;
            } ?>

            <li class="nav-item">
                <div class="dropdown">
                    <!-- tombol ini akan memunculkan dropdown tanpa menggunakan button: https://stackoverflow.com/questions/38576503/how-to-remove-the-arrow-in-dropdown-in-bootstrap- terimakasih pada link di atas -->
                    <?php switch ($this->session->userdata($tabel9_field6)) {
                        case $tabel9_field6_value2:
                        case $tabel9_field6_value3:
                            ?>
                            <a type="button" class="nav-link text-decoration-none font-weight-bold" data-toggle="dropdown" href="#">
                                <h4><i class="fas fa-user-tie"></i> <i class="fas fa-caret-down"></i></h4>
                            </a>

                            <?php break;
                        case $tabel9_field6_value4:
                            ?>
                            <a type="button" class="nav-link text-decoration-none font-weight-bold" data-toggle="dropdown" href="#">
                                <h4><i class="fas fa-user"></i> <i class="fas fa-caret-down"></i></h4>
                            </a>
                            <?php break;
                        case $tabel9_field6_value5:
                            ?>
                            <a type="button" class="nav-link text-decoration-none font-weight-bold" data-toggle="dropdown" href="#">
                                <h4>
                                    <?= $this->session->userdata($tabel9_field2) ?> <i class="fas fa-caret-down"></i>
                                </h4>
                            </a>
                            <?php break;
                        default:
                            ?>
                            <!-- Show the dropdown for other cases -->
                            <?php break;
                    } ?>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php switch ($this->session->userdata($tabel9_field6)) {
                            case $tabel9_field6_value5:
                                ?>
                                <h6 class="dropdown-header">Jelajahi</h6>
                                <a class="dropdown-item" href="<?= site_url('welcome') ?>">Pesan Sekarang</a>
                                <a class="dropdown-item" href="<?= site_url('tabel6') ?>">
                                    <?= $tabel6_alias ?>
                                </a>
                                <a class="dropdown-item" href="<?= site_url('tabel3') ?>">
                                    <?= $tabel3_alias ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">Reservasi</h6>
                                <a class="dropdown-item" href="<?= site_url('tabel8/daftar') ?>">Daftar
                                    <?= $tabel8_alias ?>
                                </a>
                                <a class="dropdown-item" href="<?= site_url('tabel10/daftar') ?>">Daftar
                                    <?= $tabel10_alias ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">History</h6>
                                <a class="dropdown-item" href="<?= site_url('tabel2/daftar') ?>">
                                    <?= $tabel2_alias ?>
                                </a>
                                <a class="dropdown-item" href="<?= site_url('tabel10/daftar_history') ?>">History
                                    <?= $tabel10_alias ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <?php break;
                            case $tabel9_field6_value2:
                            case $tabel9_field6_value3:
                            case $tabel9_field6_value4:
                                ?>
                                <?php break;
                            default:
                                ?>
                                <!-- Show the dropdown for other cases -->
                                <?php break;
                        } ?>

                        <a class="dropdown-item" href="<?= site_url('tabel9/profil') ?>">Profil</a>
                        <a class="dropdown-item" href="<?= site_url('tabel9/logout') ?>">Logout</a>


                    </div>
                </div>
            </li>
            <?php break;
        default:
            break;
    } ?>
</ul>