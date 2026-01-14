<!DOCTYPE html>
<html lang="en">
<?php $url = current_url(true); ?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php 
    $currentUrl = current_url();
    $pageTitle = 'Dashboard';
    
    if (strpos($currentUrl, 'antrian') !== false) {
        $pageTitle = 'Antrian';
    } elseif (strpos($currentUrl, 'laporan') !== false) {
        $pageTitle = 'Laporan';
    } elseif (strpos($currentUrl, 'menu') !== false) {
        $pageTitle = 'Menu';
    } elseif (strpos($currentUrl, 'user') !== false) {
        $pageTitle = 'User';
    } elseif (strpos($currentUrl, 'barcode') !== false) {
        $pageTitle = 'Barcode Meja';
    } elseif (strpos($currentUrl, 'order') !== false) {
        $pageTitle = 'Order';
    }
    ?>
    <title>KUBOKOPI | <?= $pageTitle ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/bootstrap/css/bootstrap.min.css">
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/simple-line-icons/css/simple-line-icons.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>/images/kubo2020.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>/images/kubo2020.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/images/kubo2020.png">
    <link rel="apple-touch-icon" href="<?= base_url() ?>/images/kubo2020.png">
    
    <link rel="stylesheet" href="<?= base_url() ?>/css/vertical-layout-light/custom.css?v=20250808183200">
    <link rel="stylesheet" href="<?= base_url() ?>/css/custom-style.css?v=20250808183200">

    <script src="<?php echo base_url() ?>/js/jquery/jquery.min.js"></script>
    
    <style>
        .navbar-brand-wrapper {
            position: relative !important;
            z-index: 2 !important;
        }

        .brand-marquee {
            width: 150px !important;
            white-space: nowrap !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .brand-kubo {
            color: #6F4E37 !important;
            font-weight: bold !important;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.3), 
                         0 0 10px rgba(111, 78, 55, 0.2) !important;
            transition: all 0.3s ease !important;
        }

        .brand-kopi {
            color: #5D4037 !important;
            font-weight: bold !important;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.3), 
                         0 0 10px rgba(93, 64, 55, 0.2) !important;
            transition: all 0.3s ease !important;
        }

        .navbar-brand:hover .brand-kubo {
            color: #8B4513 !important;
            text-shadow: 2px 2px 6px rgba(255,255,255,0.4), 
                         0 0 15px rgba(139, 69, 19, 0.3) !important;
            transform: scale(1.05) !important;
        }

        .navbar-brand:hover .brand-kopi {
            color: #654321 !important;
            text-shadow: 2px 2px 6px rgba(255,255,255,0.4), 
                         0 0 15px rgba(101, 67, 33, 0.3) !important;
            transform: scale(1.05) !important;
        }

        .welcome-text {
            color: #6F4E37 !important;
            font-size: 1.2rem !important;
            margin-bottom: 0 !important;
            text-shadow: 1px 1px 3px rgba(255,255,255,0.2) !important;
            transition: all 0.3s ease !important;
            position: relative !important;
        }

        .welcome-sub-text {
            color: #8B4513 !important;
            font-size: 0.9rem !important;
            margin-top: 2px !important;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.2) !important;
        }
    </style>
</head>

<body class="sidebar-fixed">
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="../../index.html" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="<?= base_url() ?>/images/kubo2020.png" alt="KUBOKOPI" style="height: 65px; margin-right: 10px;">
                        <h1 style="margin: 0; font-size: 2.8rem; font-weight: bold;">
                            <marquee class="brand-marquee">
                                <span class="brand-kubo">KUBO</span><span class="brand-kopi">KOPI</span>
                            </marquee>
                        </h1>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="../../index.html">
                        <img src="<?= base_url() ?>/images/kubo2020.png" alt="KK" style="height: 40px;">
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-5">
                        <h1 class="welcome-text">Kang Mas, <span class="text-black fw-bold"><?= session()->get("nama") ?></span></h1>
                        <h3 class="welcome-sub-text"> Harus Friendly Ya Sama pelanggan :) </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a type="button" class="btn btn-social-icon-text btn-dribbble" href="dashboard/logout"><i class="mdi mdi-account-check"></i>Log out</a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item <?php if (strpos(current_url(), 'antrian') !== false) {
                                            echo "active";
                                        } ?>">
                        <a class="nav-link" href="antrian">
                            <i class="menu-icon mdi mdi-chair-school"></i>
                            <span class="menu-title">Antrian</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if (strpos(current_url(), 'laporan') !== false) {
                                            echo "active";
                                        } ?>">
                        <a class="nav-link" href="laporan">
                            <i class="menu-icon mdi mdi-book-open-page-variant"></i>
                            <span class="menu-title">Laporan</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Data Master</li>
                    <?php if (session()->get("rule") == 1) : ?>
                        <!-- Menu untuk Admin -->
                        <li class="nav-item <?php if (strpos(current_url(), 'menu') !== false) {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="menu">
                                <i class="menu-icon mdi mdi-food-fork-drink"></i>
                                <span class="menu-title">Menu</span>
                            </a>
                        </li>
                        <li class="nav-item <?php if (strpos(current_url(), 'user') !== false) {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="user">
                                <i class="menu-icon mdi mdi-account-multiple"></i>
                                <span class="menu-title">User</span>
                            </a>
                        </li>
                        <li class="nav-item <?php if (strpos(current_url(), 'barcode') !== false) {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="barcode">
                                <i class="menu-icon mdi mdi-qrcode-scan"></i>
                                <span class="menu-title">Barcode Meja</span>
                            </a>
                        </li>
                    <?php elseif (session()->get("rule") == 2) : ?>
                        <!-- Menu untuk Kasir -->
                        <li class="nav-item <?php if (strpos(current_url(), 'menuKasir') !== false) {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="menuKasir">
                                <i class="menu-icon mdi mdi-food-fork-drink"></i>
                                <span class="menu-title">Status Menu</span>
                            </a>
                        </li>
                    <?php else : ?>
                        <!-- Menu untuk Karyawan (rule 0) -->
                        <li class="nav-item <?php if (strpos(current_url(), 'menuKaryawan') !== false) {
                                                echo "active";
                                            } ?>">
                            <a class="nav-link" href="menuKaryawan">
                                <i class="menu-icon mdi mdi-food-fork-drink"></i>
                                <span class="menu-title">Kelola Menu</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?php $this->renderSection('content'); ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Original Portofolio <a href="https://www.bootstrapdash.com/" style="text-decoration: none;" target="_blank">Egy Bayu Saputra</a> from Thesis.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
                    </div>
                </footer>
            </div>
            <!-- partial -->
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- endinject -->
    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url() ?>/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ?>/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>/js/settings.js"></script>
    <script src="<?= base_url() ?>/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
</body>

</html>