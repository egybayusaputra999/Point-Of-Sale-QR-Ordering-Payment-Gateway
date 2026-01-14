<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Meja <?= $table['table_number'] ?></title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="<?= base_url() ?>/images/kubo2020.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>/images/kubo2020.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/images/kubo2020.png">
    <link rel="apple-touch-icon" href="<?= base_url() ?>/images/kubo2020.png">
    
    <!-- Midtrans Snap -->
    <?php 
    $midtransConfig = new \Config\Midtrans();
    $snapJsUrl = $midtransConfig->getSnapJsUrl();
    $clientKey = $midtransConfig->clientKey;
    ?>
    <script type="text/javascript" src="<?= $snapJsUrl ?>" data-client-key="<?= $clientKey ?>"></script>
    
    <style>
        .header-section {
            background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .table-info {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
        }
        
        .menu-card {
            background-color: #FFFAF0 !important;
            border: 1px solid #E8E8D0 !important;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 25px;
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        
        .menu-card .card-img-top {
            height: 180px;
            object-fit: cover;
        }
        
        .menu-card .card-body {
            padding: 15px;
            background-color: #F5DEB3;
        }
        
        .menu-card h5 {
            color: #6F4E37;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .menu-card .price {
            color: #8B4513;
            font-weight: 500;
            margin-bottom: 15px;
            display: block;
        }
        

        
        .btn-add-to-cart {
            background-color: #6F4E37;
            color: #F5DEB3;
            border: none;
            border-radius: 6px;
            padding: 8px 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-add-to-cart:hover {
            background-color: #5D4037;
            transform: scale(1.03);
            color: #F5DEB3;
        }
        
        .btn-add-to-cart:disabled {
            background-color: #D2B48C;
            color: #8B7355;
            cursor: not-allowed;
        }
        
        .menu-item-disabled {
            filter: grayscale(100%);
            opacity: 0.6;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: #D2B48C;
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: #8B7355;
            font-weight: 500;
            padding: 1rem 1.5rem;
            border-radius: 25px;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, #8B4513 0%, #6F4E37 100%);
            color: #F5DEB3;
            border: none;
        }
        
        .nav-tabs .nav-link:hover {
            border: none;
            background: rgba(139, 69, 19, 0.1);
            color: #8B4513;
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #8B4513;
            color: #F5DEB3;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
        }
        
        .best-seller-card {
            position: relative;
            border: 3px solid transparent !important;
            background: linear-gradient(white, white) padding-box, 
                        linear-gradient(45deg, #8B4513, #D2B48C, #8B4513) border-box !important;
            box-shadow: 0 8px 20px rgba(139, 69, 19, 0.3), 
                        0 0 15px rgba(210, 180, 140, 0.4),
                        inset 0 2px 0 rgba(255, 255, 255, 0.4) !important;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            animation: gentleGlow 3s ease-in-out infinite alternate, 
                       subtleFloat 4s ease-in-out infinite;
            transform-origin: center;
        }
        
        .best-seller-card::before {
            content: '';
            position: absolute;
            top: -100%;
            left: -100%;
            width: 300%;
            height: 300%;
            background: linear-gradient(45deg, 
                        transparent, 
                        rgba(139, 69, 19, 0.15), 
                        rgba(210, 180, 140, 0.2),
                        rgba(139, 69, 19, 0.15),
                        transparent);
            transform: rotate(45deg);
            animation: simpleShimmer 2s linear infinite;
            z-index: 1;
        }
        
        .best-seller-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, 
                        rgba(210, 180, 140, 0.08) 0%, 
                        transparent 70%);
            animation: softPulse 3s ease-in-out infinite;
            z-index: 1;
            pointer-events: none;
        }
        
        .best-seller-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 15px 30px rgba(139, 69, 19, 0.4), 
                        0 5px 20px rgba(210, 180, 140, 0.5),
                        inset 0 3px 0 rgba(255, 255, 255, 0.5) !important;
            animation: gentleGlow 2s ease-in-out infinite alternate, 
                       subtleFloat 4s ease-in-out infinite;
        }
        
        .best-seller-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(135deg, #8B4513, #A0522D, #D2B48C, #A0522D, #8B4513);
            color: white;
            padding: 10px 18px;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 10;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.5),
                        0 0 20px rgba(210, 180, 140, 0.4),
                        inset 0 2px 0 rgba(255, 255, 255, 0.4);
            animation: gentlePulse 2s ease-in-out infinite,
                       badgeFloat 3s ease-in-out infinite;
            border: 2px solid rgba(255, 255, 255, 0.5);
            transform-origin: center;
        }
        
        .best-seller-badge::before {
            content: '⭐';
            position: absolute;
            top: -6px;
            left: -6px;
            font-size: 14px;
            animation: simpleRotate 3s linear infinite;
            z-index: 15;
        }
        
        .best-seller-badge i {
            margin-right: 5px;
            color: #FFD700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
            animation: starTwinkle 1s ease-in-out infinite alternate;
        }
        
        .best-seller-card .card-img-top {
            transition: all 0.4s ease;
            filter: brightness(1.1) contrast(1.1);
        }
        
        .best-seller-card:hover .card-img-top {
            transform: scale(1.05);
            filter: brightness(1.2) contrast(1.2) saturate(1.1);
        }
        
        .best-seller-card .card-body {
            background: linear-gradient(135deg, #F5DEB3, #DEB887) !important;
            position: relative;
            z-index: 2;
        }
        
        .best-seller-card .price {
            background: linear-gradient(45deg, #8B4513, #D2B48C);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 900 !important;
            font-size: 1.1em !important;
            text-shadow: 0 0 10px rgba(139, 69, 19, 0.3);
            animation: priceGlow 2s ease-in-out infinite alternate;
        }
        
        .best-seller-card .btn-add-to-cart {
            background: linear-gradient(135deg, #8B4513, #6F4E37) !important;
            border: none !important;
            color: #F5DEB3 !important;
            font-weight: bold !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.4) !important;
            transition: all 0.3s ease !important;
            position: relative;
            overflow: hidden;
        }
        
        .best-seller-card .btn-add-to-cart::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .best-seller-card .btn-add-to-cart:hover::before {
            left: 100%;
        }
        
        .best-seller-card .btn-add-to-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 69, 19, 0.6) !important;
            background: linear-gradient(135deg, #A0522D, #8B4513) !important;
        }
        
        /* Keyframes Animations */
        @keyframes gentleGlow {
            0% { 
                box-shadow: 0 8px 20px rgba(139, 69, 19, 0.3), 
                            0 0 15px rgba(210, 180, 140, 0.4),
                            inset 0 2px 0 rgba(255, 255, 255, 0.4);
            }
            100% { 
                box-shadow: 0 12px 30px rgba(139, 69, 19, 0.4), 
                            0 0 25px rgba(210, 180, 140, 0.5),
                            inset 0 3px 0 rgba(255, 255, 255, 0.5);
            }
        }
        
        @keyframes subtleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-3px); }
        }
        
        @keyframes simpleShimmer {
            0% { transform: translateX(-150%) translateY(-150%) rotate(45deg); }
            100% { transform: translateX(150%) translateY(150%) rotate(45deg); }
        }
        
        @keyframes softPulse {
            0% { opacity: 0.2; transform: scale(0.98); }
            50% { opacity: 0.4; transform: scale(1.02); }
            100% { opacity: 0.2; transform: scale(0.98); }
        }
        
        @keyframes gentlePulse {
            0% { 
                transform: scale(1); 
                box-shadow: 0 4px 15px rgba(139, 69, 19, 0.5),
                            0 0 20px rgba(210, 180, 140, 0.4);
            }
            50% { 
                transform: scale(1.05); 
                box-shadow: 0 6px 20px rgba(139, 69, 19, 0.6),
                            0 0 25px rgba(210, 180, 140, 0.5);
            }
            100% { 
                transform: scale(1); 
                box-shadow: 0 4px 15px rgba(139, 69, 19, 0.5),
                            0 0 20px rgba(210, 180, 140, 0.4);
            }
        }
        
        @keyframes badgeFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-2px); }
        }
        
        @keyframes simpleRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes starTwinkle {
            0% { opacity: 0.8; }
            100% { opacity: 1; }
        }
        
        @keyframes priceGlow {
            0% { 
                color: #8B4513; 
                text-shadow: 0 0 5px rgba(139, 69, 19, 0.6);
            }
            50% { 
                color: #D2B48C; 
                text-shadow: 0 0 8px rgba(210, 180, 140, 0.8);
            }
            100% { 
                color: #8B4513; 
                text-shadow: 0 0 5px rgba(139, 69, 19, 0.6);
            }
        }

        /* Enhanced Navbar Styling - Brown Theme */
        .navbar {
            background: linear-gradient(135deg, #D2B48C 0%, #DEB887 30%, #CD853F 70%, #A0522D 100%);
            box-shadow: 0 4px 20px rgba(210, 180, 140, 0.4), 
                        0 2px 10px rgba(0,0,0,0.2),
                        inset 0 1px 0 rgba(255,255,255,0.2);
            border-bottom: 2px solid #8B4513;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            animation: navbarShine 3s infinite;
        }

        @keyframes navbarShine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .navbar:hover {
            background: linear-gradient(135deg, #DEB887 0%, #CD853F 30%, #A0522D 70%, #8B4513 100%);
            box-shadow: 0 6px 25px rgba(210, 180, 140, 0.5), 
                        0 3px 15px rgba(0,0,0,0.3),
                        inset 0 1px 0 rgba(255,255,255,0.25);
            transform: translateY(-1px);
        }

        .navbar-brand-wrapper {
            position: relative;
            z-index: 2;
        }

        .brand-marquee {
            width: 150px;
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }

        .brand-kubo {
            color: #6F4E37;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.3), 
                         0 0 10px rgba(111, 78, 55, 0.2);
            transition: all 0.3s ease;
        }

        .brand-kopi {
            color: #5D4037;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.3), 
                         0 0 10px rgba(93, 64, 55, 0.2);
            transition: all 0.3s ease;
        }

        .navbar-brand:hover .brand-kubo {
            color: #8B4513;
            text-shadow: 2px 2px 6px rgba(255,255,255,0.4), 
                         0 0 15px rgba(139, 69, 19, 0.3);
            transform: scale(1.05);
        }

        .navbar-brand:hover .brand-kopi {
            color: #654321;
            text-shadow: 2px 2px 6px rgba(255,255,255,0.4), 
                         0 0 15px rgba(101, 67, 33, 0.3);
            transform: scale(1.05);
        }

        .welcome-text {
            color: #6F4E37;
            font-size: 1.5rem;
            margin-bottom: 0;
            text-shadow: 1px 1px 3px rgba(255,255,255,0.2);
            transition: all 0.3s ease;
            position: relative;
        }

        .welcome-text:hover {
            color: #5D4037;
            text-shadow: 1px 1px 4px rgba(255,255,255,0.3), 
                         0 0 8px rgba(93, 64, 55, 0.2);
            transform: translateX(5px);
        }

        .navbar-menu-wrapper .text-muted {
            color: #8B4513 !important;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .navbar-menu-wrapper .text-muted:hover {
            color: #6F4E37 !important;
            text-shadow: 1px 1px 3px rgba(255,255,255,0.3);
        }

        /* Enhanced Cart Button - Brown Theme */
        .btn-warning {
            background: linear-gradient(135deg, #F5DEB3 0%, #DEB887 50%, #D2B48C 100%) !important;
            border: 2px solid #A0522D !important;
            color: #6F4E37 !important;
            font-weight: 700 !important;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.4) !important;
            box-shadow: 0 4px 12px rgba(160, 82, 45, 0.3), 
                        0 2px 6px rgba(139, 69, 19, 0.2) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative;
            overflow: hidden;
            border-radius: 8px !important;
        }

        .btn-warning::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            transition: left 0.6s ease;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #A0522D 0%, #8B4513 50%, #6F4E37 100%) !important;
            color: #F5DEB3 !important;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4) !important;
            box-shadow: 0 6px 18px rgba(160, 82, 45, 0.4), 
                        0 3px 10px rgba(139, 69, 19, 0.3) !important;
            transform: translateY(-3px) scale(1.02) !important;
            border-color: #6F4E37 !important;
        }

        .btn-warning:hover::before {
            left: 100%;
        }

        .btn-warning:active {
            transform: translateY(-1px) scale(0.98) !important;
            box-shadow: 0 3px 8px rgba(160, 82, 45, 0.3) !important;
        }

        .btn-warning i {
            margin-right: 8px;
            font-size: 1.1em;
            text-shadow: none !important;
            color: #6F4E37 !important; /* Coklat tua untuk icon */
            background: rgba(245, 222, 179, 0.3) !important; /* Background coklat terang untuk icon */
            border-radius: 4px !important;
            transition: all 0.3s ease !important;
        }
        
        .btn-warning:hover i {
            color: #F5DEB3 !important; /* Warna terang saat hover */
            background: rgba(111, 78, 55, 0.4) !important; /* Background coklat tua saat hover */
        }

        .btn-warning b {
            background: rgba(111, 78, 55, 0.2);
            padding: 2px 6px;
            border-radius: 12px;
            margin-left: 5px;
            font-size: 0.9em;
        }

        .btn-warning:hover b {
            background: rgba(245, 222, 179, 0.3);
            color: #F5DEB3;
        }

        /* Category Tabs Styling */
        .category-tabs {
            background: linear-gradient(135deg, #F5DEB3 0%, #DEB887 100%);
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 2px solid #D2B48C;
            justify-content: center;
            display: flex;
            flex-wrap: wrap;
        }

        .category-tabs .nav-link {
            background: linear-gradient(135deg, #F5DEB3 0%, #DDBF94 100%);
            color: #6F4E37;
            border: 2px solid #D2B48C;
            border-radius: 25px;
            padding: 12px 20px;
            margin: 0 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .category-tabs .nav-link:hover {
            background: linear-gradient(135deg, #8B4513 0%, #6F4E37 100%);
            color: #F5DEB3;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(111, 78, 55, 0.3);
        }

        .category-tabs .nav-link.active {
            background: linear-gradient(135deg, #8B4513 0%, #6F4E37 100%);
            color: #F5DEB3;
            border-color: #6F4E37;
            box-shadow: 0 4px 15px rgba(111, 78, 55, 0.4);
        }

        .category-tabs .nav-link i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        /* Main Panel Styling - Small Gap */
        .main-panel {
            margin-top: 15px;
            padding: 0px;
        }

        .main-panel-centered {
            width: 100%;
            max-width: none;
        }

        .content-wrapper {
            background: linear-gradient(135deg, #F5DEB3 0%, #E6D3A3 100%);
            min-height: calc(100vh - 15px);
            padding: 10px;
            padding-top: 5px;
            margin-top: 0px;
        }

        /* Remove any default margins from container */
        .container {
            margin-top: 0px !important;
            padding-top: 0px !important;
            margin-bottom: 0px !important;
        }

        /* Small gap for category tabs */
        .category-tabs {
            margin-top: 0px !important;
            margin-bottom: 15px !important;
            padding-top: 5px !important;
        }

        /* Remove gaps from page body wrapper */
        .page-body-wrapper {
            padding-top: 0px !important;
            margin-top: 0px !important;
        }

        /* Remove gaps from container-fluid */
        .container-fluid {
            padding-top: 0px !important;
            margin-top: 0px !important;
        }

        /* Fixed Navbar styling */
        .navbar {
            margin-bottom: 0px !important;
            z-index: 1000;
            position: fixed !important;
            top: 0 !important;
            width: 100% !important;
        }

        /* Add padding to body to compensate for fixed navbar */
        body {
            padding-top: 80px !important;
        }

        /* Adjust content wrapper for fixed navbar */
        .content-wrapper {
            background: linear-gradient(135deg, #F5DEB3 0%, #E6D3A3 100%);
            min-height: calc(100vh - 15px);
            padding: 10px;
            padding-top: 20px !important;
            margin-top: 0px;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <!-- Navigation Bar -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="#" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="<?= base_url() ?>/images/kubo2020.png" alt="KUBOKOPI" style="height: 65px; margin-right: 10px;">
                        <h1 style="margin: 0; font-size: 2.8rem; font-weight: bold;">
                            <marquee class="brand-marquee">
                                <span class="brand-kubo">KUBO</span><span class="brand-kopi">KOPI</span>
                            </marquee>
                        </h1>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="#">
                        <img src="<?= base_url() ?>/images/kubo2020.png" alt="KK" style="height: 40px;">
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-5">
                        <h1 class="welcome-text" style="color: #6F4E37; font-size: 1.2rem;">Meja <?= $table['table_number'] ?></h1>
                        <h3 class="welcome-sub-text" style="color: #8B4513; font-size: 0.9rem; margin-top: 2px;">Original Portofolio <a href="#" style="color: blue; text-decoration: none;">Egy Bayu Saputra</a> from Thesis.</h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button type="button" class="btn btn-social-icon-text btn-warning" onclick="bukaModalKeranjang()"><i class="mdi mdi-cart-outline"></i>Keranjang <b id="jmlPesanan">(0)</b></button>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Main Content -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel main-panel-centered">
                <div class="content-wrapper">

                        <div class="container">
                            <!-- Tab Navigation untuk Kategori Menu -->
                            <ul class="nav nav-pills mb-4 category-tabs" id="menuTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">
                                        <i class="mdi mdi-silverware-fork-knife"></i> Semua Menu
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="food-tab" data-bs-toggle="pill" data-bs-target="#food" type="button" role="tab" aria-controls="food" aria-selected="false">
                                        <i class="mdi mdi-food"></i> Makanan
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="snack-tab" data-bs-toggle="pill" data-bs-target="#snack" type="button" role="tab" aria-controls="snack" aria-selected="false">
                                        <i class="mdi mdi-cookie"></i> Snack
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="cold-drinks-tab" data-bs-toggle="pill" data-bs-target="#cold-drinks" type="button" role="tab" aria-controls="cold-drinks" aria-selected="false">
                                        <i class="mdi mdi-cup"></i> Minuman Dingin
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="hot-drinks-tab" data-bs-toggle="pill" data-bs-target="#hot-drinks" type="button" role="tab" aria-controls="hot-drinks" aria-selected="false">
                                        <i class="mdi mdi-coffee"></i> Minuman Panas
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="best-seller-tab" data-bs-toggle="pill" data-bs-target="#best-seller" type="button" role="tab" aria-controls="best-seller" aria-selected="false">
                                        <i class="mdi mdi-star"></i> Best Seller
                                    </button>
                                </li>
                            </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content" id="menuTabContent">
                                        <!-- Tab Semua Menu -->
                                        <div class="tab-pane fade show active" id="all" role="tabpanel">
                                            <!-- Best Seller Section -->
                                            <?php if (!empty($bestSeller)): ?>
                                            <h3 class="menu-category-title mb-3"><i class="mdi mdi-star" style="color: #ffd700; margin-right: 0.5rem;"></i>Menu Best Seller</h3>
                                            <div class="row mb-4">
                                                <?php foreach ($bestSeller as $item): ?>
                                                    <div class="col-md-3">
                                                        <div class="card menu-card best-seller-card">
                                                            <div class="best-seller-badge">
                                                                <i class="mdi mdi-star"></i> Best Seller
                                                            </div>
                                                            <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                            <div class="card-body text-center">
                                                                <h5><?= $item['nama'] ?></h5>
                                                                <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                    <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) {
                                                                        echo "Habis";
                                                                    } else {
                                                                        echo "Tambah ke Keranjang";
                                                                    } ?>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php endif; ?>
                                            
                                            <!-- Menu Berdasarkan Kategori -->
                                            <?php if (empty($menu_items)): ?>
                                                <div class="col-12">
                                                    <div class="text-center py-5">
                                                        <i class="mdi mdi-food empty-state-icon"></i>
                                                        <h4 class="mt-3">Menu belum tersedia saat ini.</h4>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <!-- Aneka Makanan -->
                                                <?php 
                                                $makanan = array_filter($menu_items, function($item) {
                                                    return ($item['jenis'] ?? 1) == 1;
                                                });
                                                if (!empty($makanan)): ?>
                                                <h3 class="menu-category-title mb-3"><i class="mdi mdi-food" style="color: #8B4513; margin-right: 0.5rem;"></i>Aneka Makanan</h3>
                                                <div class="row mb-4">
                                                    <?php foreach ($makanan as $item): ?>
                                                        <div class="col-md-3">
                                                            <div class="card menu-card">
                                                                <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                                <div class="card-body text-center">
                                                                    <h5><?= $item['nama'] ?></h5>
                                                                    <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                    <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                        <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) { echo "Habis"; } else { echo "Tambah ke Keranjang"; } ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php endif; ?>

                                                <!-- Aneka Snack -->
                                                <?php 
                                                $snack = array_filter($menu_items, function($item) {
                                                    return ($item['jenis'] ?? 1) == 2;
                                                });
                                                if (!empty($snack)): ?>
                                                <h3 class="menu-category-title mb-3"><i class="mdi mdi-cookie" style="color: #8B4513; margin-right: 0.5rem;"></i>Aneka Snack</h3>
                                                <div class="row mb-4">
                                                    <?php foreach ($snack as $item): ?>
                                                        <div class="col-md-3">
                                                            <div class="card menu-card">
                                                                <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                                <div class="card-body text-center">
                                                                    <h5><?= $item['nama'] ?></h5>
                                                                    <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                    <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                        <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) { echo "Habis"; } else { echo "Tambah ke Keranjang"; } ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php endif; ?>

                                                <!-- Aneka Minuman Dingin -->
                                                <?php 
                                                $minuman_dingin = array_filter($menu_items, function($item) {
                                                    return ($item['jenis'] ?? 1) == 3;
                                                });
                                                if (!empty($minuman_dingin)): ?>
                                                <h3 class="menu-category-title mb-3"><i class="mdi mdi-cup" style="color: #8B4513; margin-right: 0.5rem;"></i>Aneka Minuman Dingin</h3>
                                                <div class="row mb-4">
                                                    <?php foreach ($minuman_dingin as $item): ?>
                                                        <div class="col-md-3">
                                                            <div class="card menu-card">
                                                                <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                                <div class="card-body text-center">
                                                                    <h5><?= $item['nama'] ?></h5>
                                                                    <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                    <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                        <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) { echo "Habis"; } else { echo "Tambah ke Keranjang"; } ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php endif; ?>

                                                <!-- Aneka Minuman Panas -->
                                                <?php 
                                                $minuman_panas = array_filter($menu_items, function($item) {
                                                    return ($item['jenis'] ?? 1) == 4;
                                                });
                                                if (!empty($minuman_panas)): ?>
                                                <h3 class="menu-category-title mb-3"><i class="mdi mdi-coffee" style="color: #8B4513; margin-right: 0.5rem;"></i>Aneka Minuman Panas</h3>
                                                <div class="row mb-4">
                                                    <?php foreach ($minuman_panas as $item): ?>
                                                        <div class="col-md-3">
                                                            <div class="card menu-card">
                                                                <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                                <div class="card-body text-center">
                                                                    <h5><?= $item['nama'] ?></h5>
                                                                    <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                    <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                        <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) { echo "Habis"; } else { echo "Tambah ke Keranjang"; } ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                         </div>

                                         <!-- Tab Makanan -->
                                         <div class="tab-pane fade" id="food" role="tabpanel">
                                             <?php if ($menu_items): ?>
                                             <div class="row">
                                                 <?php foreach ($menu_items as $item): 
                                                     if (($item['jenis'] ?? 1) == 1): ?>
                                                     <div class="col-md-3">
                                                         <div class="card menu-card">
                                                             <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                             <div class="card-body text-center">
                                                                 <h5><?= $item['nama'] ?></h5>
                                                                 <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                 <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                     <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) { echo "Habis"; } else { echo "Tambah ke Keranjang"; } ?>
                                                                 </button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 <?php endif; endforeach; ?>
                                             </div>
                                             <?php else: ?>
                                             <div class="text-center py-5">
                                                 <i class="mdi mdi-food empty-state-icon"></i>
                                                 <h4 class="mt-3">Maaf, tidak ada menu makanan yang tersedia saat ini.</h4>
                                             </div>
                                             <?php endif; ?>
                                         </div>

                                         <!-- Tab Snack -->
                                         <div class="tab-pane fade" id="snack" role="tabpanel">
                                             <?php if ($menu_items): ?>
                                             <div class="row">
                                                 <?php foreach ($menu_items as $item): 
                                                     if (($item['jenis'] ?? 1) == 2): ?>
                                                     <div class="col-md-3">
                                                         <div class="card menu-card">
                                                             <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                             <div class="card-body text-center">
                                                                 <h5><?= $item['nama'] ?></h5>
                                                                 <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                 <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                     <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) { echo "Habis"; } else { echo "Tambah ke Keranjang"; } ?>
                                                                 </button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 <?php endif; endforeach; ?>
                                             </div>
                                             <?php else: ?>
                                             <div class="text-center py-5">
                                                 <i class="mdi mdi-food-variant empty-state-icon"></i>
                                                 <h4 class="mt-3">Maaf, tidak ada menu snack yang tersedia saat ini.</h4>
                                             </div>
                                             <?php endif; ?>
                                         </div>

                                         <!-- Tab Minuman Dingin -->
                                         <div class="tab-pane fade" id="cold-drinks" role="tabpanel">
                                             <?php if ($menu_items): ?>
                                             <div class="row">
                                                 <?php foreach ($menu_items as $item): 
                                                     if (($item['jenis'] ?? 1) == 3): ?>
                                                     <div class="col-md-3">
                                                         <div class="card menu-card">
                                                             <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                             <div class="card-body text-center">
                                                                 <h5><?= $item['nama'] ?></h5>
                                                                 <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                 <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                     <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) { echo "Habis"; } else { echo "Tambah ke Keranjang"; } ?>
                                                                 </button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 <?php endif; endforeach; ?>
                                             </div>
                                             <?php else: ?>
                                             <div class="text-center py-5">
                                                 <i class="mdi mdi-cup-water empty-state-icon"></i>
                                                 <h4 class="mt-3">Maaf, tidak ada menu minuman dingin yang tersedia saat ini.</h4>
                                             </div>
                                             <?php endif; ?>
                                         </div>

                                         <!-- Tab Minuman Panas -->
                                         <div class="tab-pane fade" id="hot-drinks" role="tabpanel">
                                             <?php if ($menu_items): ?>
                                             <div class="row">
                                                 <?php foreach ($menu_items as $item): 
                                                     if (($item['jenis'] ?? 1) == 4): ?>
                                                     <div class="col-md-3">
                                                         <div class="card menu-card">
                                                             <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                             <div class="card-body text-center">
                                                                 <h5><?= $item['nama'] ?></h5>
                                                                 <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                 <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                     <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) { echo "Habis"; } else { echo "Tambah ke Keranjang"; } ?>
                                                                 </button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 <?php endif; endforeach; ?>
                                             </div>
                                             <?php else: ?>
                                             <div class="text-center py-5">
                                                 <i class="mdi mdi-coffee empty-state-icon"></i>
                                                 <h4 class="mt-3">Maaf, tidak ada menu minuman panas yang tersedia saat ini.</h4>
                                             </div>
                                             <?php endif; ?>
                                         </div>
                                         
                                         <!-- Tab Best Seller -->
                                         <div class="tab-pane fade" id="best-seller" role="tabpanel">
                                             <?php if (!empty($bestSeller)): ?>
                                             <div class="row">
                                                 <?php foreach ($bestSeller as $item): ?>
                                                     <div class="col-md-3">
                                                         <div class="card menu-card best-seller-card">
                                                             <div class="best-seller-badge">
                                                                 <i class="mdi mdi-star"></i> Best Seller
                                                             </div>
                                                             <img src="<?= base_url() ?>/images/menu/<?= $item['foto'] ?? 'default.jpg' ?>" class="card-img-top <?php if (($item['status'] ?? 1) == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $item['nama'] ?>">
                                                             <div class="card-body text-center">
                                                                 <h5><?= $item['nama'] ?></h5>
                                                                 <span class="price">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                                                 <button class="btn btn-add-to-cart" <?php if (($item['status'] ?? 1) == 0) { echo "disabled"; } ?> onclick='tambahPesanan(<?= $item["id"] ?>, "<?= $item["nama"] ?>", <?= $item["harga"] ?> )'>
                                                                     <i class="mdi mdi-cart-plus"></i> <?php if (($item['status'] ?? 1) == 0) {
                                                                         echo "Habis";
                                                                     } else {
                                                                         echo "Tambah ke Keranjang";
                                                                     } ?>
                                                                 </button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 <?php endforeach; ?>
                                             </div>
                                             <?php else: ?>
                                             <div class="text-center py-5">
                                                 <i class="mdi mdi-star empty-state-icon"></i>
                                                 <h4 class="mt-3">Belum ada menu best seller yang tersedia saat ini.</h4>
                                             </div>
                                             <?php endif; ?>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Keranjang -->
    <div class="modal fade" id="modalKeranjang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesanan</h5>
                </div>
                <div class="modal-body p-0 text-center">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #8B4513, #A0522D) !important; color: white; border: 1px solid #6F4E37;">Nama</span>
                                    </div>
                                    <input type="text" id="nama" class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #8B4513, #A0522D) !important; color: white; border: 1px solid #6F4E37;">No Meja</span>
                                    </div>
                                    <input type="number" id="noMeja" class="form-control" value="<?= $table['table_number'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table text-center bg-white" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jml</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody id="tabelPesanan">
                            <td colspan="5">Data Kosong</td>
                        </tbody>
                    </table>

                    <div class="row mt-3">
                        <div class="col-12 text-right">
                            <h4><strong>Total Keseluruhan: <span id="totalKeseluruhan">Rp 0</span></strong></h4>
                        </div>
                    </div>

                    <b id="peringatan" class="badge badge-danger">Silahkan isi nama.</b><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="tutupModalKeranjang()">Tutup</button>
    
                    <button type="button" class="btn" style="background: linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3) !important; color: #6F4E37 !important; border: 2px solid #8B4513 !important; font-weight: bold; border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #A0522D, #8B4513, #6F4E37)'; this.style.color='#F5DEB3';" onmouseout="this.style.background='linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3)'; this.style.color='#6F4E37';" onclick="prosesTransaksi()" id="simpanTransaksi">Pesan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Selesai -->
    <div class="modal fade" id="modalSelesai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesanan Berhasil.</h5>
                </div>
                <div class="modal-body">
                    Pesanan Berhasil dibuat. atas nama <b id="namaPemesan"></b> dengan lokasi meja <b id="lokasiMeja"></b>.
                    <br> <br> Mohon Menunggu sebentar kak. semoga anda dapat menikmati suasana rindu cafe ini. <br> <br>
                    <b>Terimakasih... :)</b><br><br>
                    <i>langsung dibayar ya.. </i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary mr-2" onclick="cetakStruk()"><i class="mdi mdi-printer"></i> Cetak Struk</button>
                    <button type="button" class="btn" style="background: linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3) !important; color: #6F4E37 !important; border: 2px solid #8B4513 !important; font-weight: bold; border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #A0522D, #8B4513, #6F4E37)'; this.style.color='#F5DEB3';" onmouseout="this.style.background='linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3)'; this.style.color='#6F4E37';" onclick="tutupModalSelesai()">Siap :)</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>/js/jquery/jquery.min.js"></script>
    <script>
        // Set base URL untuk digunakan di JavaScript
        window.baseUrl = '<?= base_url() ?>';
    </script>
    <script src="<?php echo base_url() ?>/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Payment functionality removed -->
    <script>
        
        var pesanan = [];
        var ditemukan = false;
        var jmlPesanan = 0;

        function bukaModalKeranjang() {
            tampilkanPesanan();
            $('#modalKeranjang').modal('show');
            $('#peringatan').hide();
        }

        function tutupModalKeranjang() {
            $('#modalKeranjang').modal('hide');
        }

        function tutupModalSelesai() {
            $('#modalSelesai').modal('hide');
        }

        function cetakStruk() {
            // Ambil data pesanan dari variabel yang disimpan
            var nama = window.namaPelangganStruk || $("#namaPemesan").text();
            var noMeja = window.noMejaStruk || $("#lokasiMeja").text();
            var tanggal = new Date().toLocaleString('id-ID');
            
            // Buat tabel detail pesanan
            var detailPesanan = '';
            var totalBayar = 0;
            
            if (window.pesananStruk && window.pesananStruk.length > 0) {
                detailPesanan += '<table style="width: 100%; border-collapse: collapse;">';
                detailPesanan += '<tr><th style="text-align: left;">Item</th><th style="text-align: center;">Qty</th><th style="text-align: right;">Harga</th><th style="text-align: right;">Total</th></tr>';
                detailPesanan += '<tr><td colspan="4"><hr style="border-top: 1px dashed #000;"></td></tr>';
                
                for (let i = 0; i < window.pesananStruk.length; i++) {
                    var item = window.pesananStruk[i];
                    var namaItem = item[1];
                    var qty = item[2];
                    var harga = item[3];
                    var total = qty * harga;
                    totalBayar += total;
                    
                    detailPesanan += `<tr>
                        <td style="text-align: left;">${namaItem}</td>
                        <td style="text-align: center;">${qty}</td>
                        <td style="text-align: right;">${formatRupiah(harga.toString())}</td>
                        <td style="text-align: right;">${formatRupiah(total.toString())}</td>
                    </tr>`;
                }
                
                detailPesanan += '<tr><td colspan="4"><hr style="border-top: 1px dashed #000;"></td></tr>';
                detailPesanan += `<tr>
                    <td colspan="2"></td>
                    <td style="text-align: right;"><strong>Total:</strong></td>
                    <td style="text-align: right;"><strong>${formatRupiah(window.totalBayarStruk.toString())}</strong></td>
                </tr>`;
                detailPesanan += '</table>';
            } else {
                detailPesanan = '<p>Tidak ada detail pesanan tersedia.</p>';
            }
            
            // Buat konten struk
            var kontenStruk = `
            <div style="font-family: 'Courier New', monospace; width: 300px; padding: 10px;">
                <div style="text-align: center; margin-bottom: 10px;">
                    <h3 style="margin: 5px 0;">KUBOKOPI</h3>
                    <p style="margin: 5px 0;">Jl. Ryacudu No.48, Waydadi, Kec.Sukarame, Kota Bandar Lampung</p>
                    <p style="margin: 5px 0;">Telp: 0812-3456-7890</p>
                    <hr style="border-top: 1px dashed #000;">
                </div>
                <div>
                    <p>Tanggal: ${tanggal}</p>
                    <p>Nama: ${nama}</p>
                    <p>No. Meja: ${noMeja}</p>
                    <hr style="border-top: 1px dashed #000;">
                </div>
                <div>
                    ${detailPesanan}
                </div>
                <div style="margin-top: 20px;">
                    <p style="text-align: center;">*** TERIMA KASIH ***</p>
                    <p style="text-align: center;">Silahkan datang kembali</p>
                </div>
            </div>
            `;
            
            // Buat jendela baru untuk mencetak
            var jendela = window.open('', '_blank', 'width=400,height=600');
            jendela.document.write('<html><head><title>Struk Pembayaran</title></head><body>');
            jendela.document.write(kontenStruk);
            jendela.document.write('</body></html>');
            jendela.document.close();
            
            // Cetak dan tutup jendela setelah selesai
            setTimeout(function() {
                jendela.print();
                // jendela.close();
            }, 500);
        }

        function tambahPesanan(id, nama, harga) {
            ditemukan = false;
            jmlPesanan = 0;
            for (let i = 0; i < pesanan.length; i++) {
                if (pesanan[i][0] == id) {
                    pesanan[i][2] += 1;
                    ditemukan = true;
                }
                jmlPesanan += pesanan[i][2];
            }
            if (ditemukan == false) {
                pesanan.push([id, nama, 1, harga]);
                jmlPesanan += 1;
            }

            $('#jmlPesanan').html('(' + jmlPesanan + ')');
            tampilkanPesanan();
        }

        function tampilkanPesanan() {
            var isiPesanan = '';
            var totalKeseluruhan = 0;
            jmlPesanan = 0;

            for (let i = 0; i < pesanan.length; i++) {
                var subtotal = pesanan[i][2] * pesanan[i][3];
                totalKeseluruhan += subtotal;
                jmlPesanan += pesanan[i][2];
                isiPesanan += '<tr><td>' + pesanan[i][1] + '</td><td>' + pesanan[i][2] + '</td><td>' + formatRupiah(pesanan[i][3].toString()) + '</td><td>' + formatRupiah(subtotal.toString()) + '</td><td><button href="#" class="badge badge-danger" onClick="hapusPesanan(' + i + ')">x</button></td></tr>';
            }
            if (pesanan.length < 1) {
                $('#simpanTransaksi').prop('disabled', true);
                isiPesanan = '<td colspan="5">Pesanan Masih Kosong :)</td>';
                $('#totalKeseluruhan').text('Rp 0');
            } else {
                $('#simpanTransaksi').prop('disabled', false);
                $('#totalKeseluruhan').text(formatRupiah(totalKeseluruhan.toString()));
            }

            $('#tabelPesanan').html(isiPesanan);
            $('#jmlPesanan').html('(' + jmlPesanan + ')');
        }

        function hapusPesanan(index) {
            pesanan.splice(index, 1);
            tampilkanPesanan();
            
            // Update badge keranjang
            jmlPesanan = 0;
            for (let i = 0; i < pesanan.length; i++) {
                jmlPesanan += pesanan[i][2];
            }
            $('#jmlPesanan').html('(' + jmlPesanan + ')');
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function prosesTransaksi() {
            var nama = $('#nama').val();
            var noMeja = $('#noMeja').val();
            
            if (nama == "") {
                $("#nama").focus();
                $("#peringatan").show();
            } else if (noMeja == "") {
                $("#noMeja").focus();
                $("#peringatan").show();
            } else {
                $("#simpanTransaksi").html('<i class="mdi mdi-reload fa-pulse"></i> Memproses..');
                
                // Hitung total keseluruhan
                var totalKeseluruhan = 0;
                for (let i = 0; i < pesanan.length; i++) {
                    totalKeseluruhan += pesanan[i][2] * pesanan[i][3];
                }
                
                // Simpan salinan pesanan untuk struk sebelum AJAX
                var pesananUntukStruk = JSON.parse(JSON.stringify(pesanan));
                
                // Buat data untuk Midtrans
                var orderData = {
                    order_id: 'ORDER-' + Date.now(),
                    gross_amount: totalKeseluruhan,
                    customer_name: nama,
                    customer_phone: '',
                    customer_email: '',
                    table_number: noMeja,
                    items: pesanan.map(function(item) {
                        return {
                            id: item[0],
                            name: item[1],
                            quantity: item[2],
                            price: item[3]
                        };
                    })
                };
                
                // Buat Snap Token untuk pembayaran
                $.ajax({
                    type: 'POST',
                    url: window.baseUrl + '/payment/createSnapToken',
                    data: orderData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $("#simpanTransaksi").html('Pesan');
                            $("#modalKeranjang").modal("hide");
                            
                            // Tampilkan Snap payment popup
                            snap.pay(response.snap_token, {
                                onSuccess: function(result) {
                                    // Simpan pesanan ke database setelah pembayaran berhasil
                                    $.ajax({
                                        type: 'POST',
                                        url: window.baseUrl + '/dashboard/tambahPesananMeja',
                                        data: {
                                            'pesanan': pesanan,
                                            'nama': nama,
                                            'noMeja': noMeja,
                                            'total': totalKeseluruhan,
                                            'transaction_id': result.transaction_id,
                                            'order_id': result.order_id
                                        },
                                        dataType: 'json',
                                        success: function(data) {
                                            if (data.status === 'success') {
                                                // Simpan data untuk struk setelah transaksi berhasil
                                                window.pesananStruk = pesananUntukStruk;
                                                window.namaPelangganStruk = nama;
                                                window.noMejaStruk = noMeja;
                                                window.totalBayarStruk = totalKeseluruhan;
                                                
                                                // Tampilkan nama dan meja di modal sebelum reset form
                                                $("#namaPemesan").html(nama);
                                                $("#lokasiMeja").html(noMeja);
                                                
                                                pesanan = [];
                                                $('#nama').val("");
                                                $('#noMeja').val("");
                                                tampilkanPesanan();

                                                $("#modalSelesai").modal("show");
                                            } else {
                                                alert('Gagal menyimpan pesanan: ' + data.message);
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            alert('Terjadi kesalahan saat menyimpan pesanan: ' + error);
                                        }
                                    });
                                },
                                onPending: function(result) {
                                    alert('Pembayaran pending. Silakan selesaikan pembayaran Anda.');
                                },
                                onError: function(result) {
                                    alert('Pembayaran gagal: ' + result.status_message);
                                },
                                onClose: function() {
                                    alert('Anda menutup popup pembayaran tanpa menyelesaikan pembayaran.');
                                }
                            });
                        } else {
                            alert('Gagal membuat token pembayaran: ' + response.message);
                            $("#simpanTransaksi").html('Pesan');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat memproses pembayaran: ' + error);
                        $("#simpanTransaksi").html('Pesan');
                    }
                });
            }
        }
        
        // Function removed - payment integration no longer needed

        // Tab switching functionality
        function switchTab(tabId) {
            // Hide all tab panes
            $('.tab-pane').removeClass('show active');
            
            // Remove active class from all nav links
            $('.nav-link').removeClass('active');
            
            // Show selected tab pane
            $('#' + tabId).addClass('show active');
            
            // Add active class to clicked nav link
            $('#' + tabId + '-tab').addClass('active');
        }

        // Initialize
        $(document).ready(function() {
            tampilkanPesanan();
            $('#peringatan').hide();
            
            // Add click handlers for tab buttons
            $('.nav-link[data-bs-toggle="pill"]').click(function(e) {
                e.preventDefault();
                var targetTab = $(this).attr('data-bs-target').substring(1); // Remove # from target
                switchTab(targetTab);
            });
        });
    </script>
</body>
</html>