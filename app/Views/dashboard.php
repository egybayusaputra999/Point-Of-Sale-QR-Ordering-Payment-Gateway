<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KUBOKOPI</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/vertical-layout-light/custom.css?v=<?= time() ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>/images/kubo2020.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>/images/kubo2020.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/images/kubo2020.png">
    <link rel="apple-touch-icon" href="<?= base_url() ?>/images/kubo2020.png">
    
    <style>
        /* Category Tabs Styling - Same as order.php */
        .category-tabs {
            background: linear-gradient(135deg, #F5DEB3 0%, #DEB887 100%) !important;
            padding: 15px !important;
            border-radius: 15px !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
            border: 2px solid #D2B48C !important;
            margin-bottom: 15px !important;
            justify-content: center !important;
            display: flex !important;
            flex-wrap: wrap !important;
        }

        /* Enhanced Navbar Styling - Brown Theme */
        .navbar {
            background: linear-gradient(135deg, #D2B48C 0%, #DEB887 30%, #CD853F 70%, #A0522D 100%) !important;
            box-shadow: 0 4px 20px rgba(210, 180, 140, 0.4), 
                        0 2px 10px rgba(0,0,0,0.2),
                        inset 0 1px 0 rgba(255,255,255,0.2) !important;
            border-bottom: 2px solid #8B4513 !important;
            backdrop-filter: blur(10px) !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            overflow: hidden !important;
        }

        .navbar::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent) !important;
            animation: navbarShine 3s infinite !important;
        }

        @keyframes navbarShine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .navbar:hover {
            background: linear-gradient(135deg, #DEB887 0%, #CD853F 30%, #A0522D 70%, #8B4513 100%) !important;
            box-shadow: 0 6px 25px rgba(210, 180, 140, 0.5), 
                        0 3px 15px rgba(0,0,0,0.3),
                        inset 0 1px 0 rgba(255,255,255,0.25) !important;
            transform: translateY(-1px) !important;
        }

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
            font-size: 1.5rem !important;
            margin-bottom: 0 !important;
            text-shadow: 1px 1px 3px rgba(255,255,255,0.2) !important;
            transition: all 0.3s ease !important;
            position: relative !important;
        }

        .welcome-text:hover {
            color: #5D4037 !important;
            text-shadow: 1px 1px 4px rgba(255,255,255,0.3), 
                         0 0 8px rgba(93, 64, 55, 0.2) !important;
            transform: translateX(5px) !important;
        }

        .navbar-menu-wrapper .text-muted {
            color: #8B4513 !important;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.2) !important;
            transition: all 0.3s ease !important;
        }

        .navbar-menu-wrapper .text-muted:hover {
            color: #6F4E37 !important;
            text-shadow: 1px 1px 3px rgba(255,255,255,0.3) !important;
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
            position: relative !important;
            overflow: hidden !important;
            border-radius: 8px !important;
        }

        .btn-warning::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent) !important;
            transition: left 0.6s ease !important;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #A0522D 0%, #8B4513 50%, #6F4E37 100%) !important;
            color: #F5DEB3 !important;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4) !important;
            box-shadow: 0 6px 18px rgba(160, 82, 45, 0.4), 
                        0 3px 10px rgba(139, 69, 19, 0.3) !important;
            transform: translateY(-3px) scale(1.02) !important;
        }

        .btn-warning:hover::before {
            left: 100% !important;
        }

        .btn-google {
            background: linear-gradient(135deg, #F5DEB3 0%, #DEB887 50%, #D2B48C 100%) !important;
            border: 2px solid #A0522D !important;
            color: #6F4E37 !important;
            font-weight: 700 !important;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.4) !important;
            box-shadow: 0 4px 12px rgba(160, 82, 45, 0.3), 
                        0 2px 6px rgba(139, 69, 19, 0.2) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border-radius: 8px !important;
        }

        .btn-google:hover {
            background: linear-gradient(135deg, #A0522D 0%, #8B4513 50%, #6F4E37 100%) !important;
            color: #F5DEB3 !important;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4) !important;
            box-shadow: 0 6px 18px rgba(160, 82, 45, 0.4), 
                        0 3px 10px rgba(139, 69, 19, 0.3) !important;
            transform: translateY(-3px) scale(1.02) !important;
        }

        .category-tabs .nav-link {
            background: linear-gradient(135deg, #F5DEB3 0%, #DDBF94 100%) !important;
            color: #6F4E37 !important;
            border: 2px solid #D2B48C !important;
            border-radius: 25px !important;
            padding: 12px 20px !important;
            margin: 0 5px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        }

        .category-tabs .nav-link:hover {
            background: linear-gradient(135deg, #8B4513 0%, #6F4E37 100%) !important;
            color: #F5DEB3 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 15px rgba(111, 78, 55, 0.3) !important;
        }

        .category-tabs .nav-link.active {
            background: linear-gradient(135deg, #8B4513 0%, #6F4E37 100%) !important;
            color: #F5DEB3 !important;
            border-color: #6F4E37 !important;
            box-shadow: 0 4px 15px rgba(111, 78, 55, 0.4) !important;
        }

        .category-tabs .nav-link i {
            margin-right: 8px !important;
            font-size: 1.1rem !important;
        }

        /* Content wrapper background to match order.php */
        .content-wrapper {
            background: linear-gradient(135deg, #F5DEB3 0%, #E6D3A3 100%) !important;
            min-height: calc(100vh - 15px) !important;
            padding: 10px !important;
            padding-top: 5px !important;
        }

        /* Main panel styling */
        .main-panel {
            margin-top: 15px !important;
            padding: 0px !important;
        }

        .main-panel-centered {
            width: 100% !important;
            max-width: none !important;
            margin-left: 0 !important;
        }

        /* Container margins */
        .container {
            margin-top: 0px !important;
            padding-top: 0px !important;
            margin-bottom: 0px !important;
        }

        /* Button Add to Cart Styling - Same as order.php */
        .btn-add-to-cart {
            background-color: #6F4E37 !important;
            color: #F5DEB3 !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 8px 15px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            width: 100% !important;
        }
        
        .btn-add-to-cart:hover {
            background-color: #5D4037 !important;
            transform: scale(1.03) !important;
            color: #F5DEB3 !important;
        }
        
        .btn-add-to-cart:disabled {
            background-color: #D2B48C !important;
            color: #8B7355 !important;
            cursor: not-allowed !important;
        }

        /* Cart icon styling */
        .btn-add-to-cart i {
            background: rgba(245, 222, 179, 0.3) !important;
            border-radius: 4px !important;
            transition: all 0.3s ease !important;
        }

        .btn-add-to-cart:hover i {
             background: rgba(111, 78, 55, 0.4) !important;
         }

        /* Menu Card Styling - Match order.php */
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
        
        .menu-item-disabled {
            filter: grayscale(100%);
            opacity: 0.6;
        }

        /* Best Seller Card Styling - Match order.php */
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

        /* Main Panel Styling - Small Gap */
        .main-panel {
            margin-top: 15px;
            padding: 0px;
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
            padding-top: 20px !important;
        }


     </style>
    
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start pl-3">

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
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold">:)</span></h1>
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Original Portofolio <a href="https://www.bootstrapdash.com/" style="text-decoration: none;" target="_blank">Egy Bayu Saputra</a> from Thesis.</span>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button type="button" class="btn btn-social-icon-text btn-warning" onclick="bukaModalKeranjang()"><i class="mdi mdi-cart-outline"></i>Keranjang <b id="jmlPesanan">(0)</b></button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-social-icon-text btn-google" onclick="bukaModalLogin()"><i class="mdi mdi-account-check"></i>Admin</button>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <div class="main-panel main-panel-centered">
                <div class="content-wrapper">
                    <div class="container">
                        <!-- Tab Navigation untuk Kategori Menu -->
                        <ul class="nav nav-pills mb-4 category-tabs" id="menuTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="all-tab" data-toggle="pill" href="#all" role="tab" aria-controls="all" aria-selected="true" onclick="showAllCategories()">
                                    <i class="mdi mdi-food-fork-drink category-icon"></i>Semua Menu
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="food-tab" data-toggle="pill" href="#food" role="tab" aria-controls="food" aria-selected="false" onclick="showCategory('food')">
                                    <i class="mdi mdi-food category-icon"></i>Makanan
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="snack-tab" data-toggle="pill" href="#snack" role="tab" aria-controls="snack" aria-selected="false" onclick="showCategory('snack')">
                                    <i class="mdi mdi-food-apple category-icon"></i>Snack
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="cold-drinks-tab" data-toggle="pill" href="#cold-drinks" role="tab" aria-controls="cold-drinks" aria-selected="false" onclick="showCategory('cold-drinks')">
                                    <i class="mdi mdi-cup-water category-icon"></i>Minuman Dingin
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="hot-drinks-tab" data-toggle="pill" href="#hot-drinks" role="tab" aria-controls="hot-drinks" aria-selected="false" onclick="showCategory('hot-drinks')">
                                    <i class="mdi mdi-coffee category-icon"></i>Minuman Panas
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="best-seller-tab" data-toggle="pill" href="#best-seller" role="tab" aria-controls="best-seller" aria-selected="false" onclick="showCategory('best-seller')">
                                    <i class="mdi mdi-star category-icon"></i>Best Seller
                                </a>
                            </li>
                        </ul>
                        


                        <!-- Tab Content untuk Kategori Menu -->
                        <div class="tab-content" id="menuTabsContent">
                            <!-- Tab Semua Menu -->
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <!-- Best Seller Section -->
                                <?php if ($bestSeller) : ?>
                                <h3 class="menu-category-title"><i class="mdi mdi-star category-icon"></i>Menu Best Seller</h3>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($bestSeller); $i++) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card best-seller-card">
                                                <div class="best-seller-badge">
                                                    <i class="mdi mdi-star"></i> Best Seller
                                                </div>
                                                <img src="<?= base_url() ?>/images/menu/<?= $bestSeller[$i]["foto"] ?>" class="card-img-top <?php if ($bestSeller[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $bestSeller[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $bestSeller[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($bestSeller[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($bestSeller[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $bestSeller[$i]["id"] ?>, "<?= $bestSeller[$i]["nama"] ?>", <?= $bestSeller[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($bestSeller[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <?php endif; ?>

                                <!-- Makanan Section -->
                                <?php if ($makanan) : ?>
                                <h3 class="menu-category-title"><i class="mdi mdi-food category-icon"></i>Aneka Makanan</h3>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($makanan); $i++) :
                                        if ($makanan[$i]["jenis"] == 1) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card">
                                                <img src="<?= base_url() ?>/images/menu/<?= $makanan[$i]["foto"] ?>" class="card-img-top <?php if ($makanan[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $makanan[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $makanan[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($makanan[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($makanan[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $makanan[$i]["id"] ?>, "<?= $makanan[$i]["nama"] ?>", <?= $makanan[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($makanan[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    endfor; ?>
                                </div>
                                <?php endif; ?>

                                <!-- Snack Section -->
                                <?php if ($snack) : ?>
                                <h3 class="menu-category-title"><i class="mdi mdi-food-apple category-icon"></i>Aneka Snack</h3>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($snack); $i++) :
                                        if ($snack[$i]["jenis"] == 2) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card">
                                                <img src="<?= base_url() ?>/images/menu/<?= $snack[$i]["foto"] ?>" class="card-img-top <?php if ($snack[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $snack[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $snack[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($snack[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($snack[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $snack[$i]["id"] ?>, "<?= $snack[$i]["nama"] ?>", <?= $snack[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($snack[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    endfor; ?>
                                </div>
                                <?php endif; ?>

                                <!-- Minuman Dingin Section -->
                                <?php if ($minumanDingin) : ?>
                                <h3 class="menu-category-title"><i class="mdi mdi-cup-water category-icon"></i>Aneka Minuman Dingin</h3>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($minumanDingin); $i++) :
                                        if ($minumanDingin[$i]["jenis"] == 3) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card">
                                                <img src="<?= base_url() ?>/images/menu/<?= $minumanDingin[$i]["foto"] ?>" class="card-img-top <?php if ($minumanDingin[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $minumanDingin[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $minumanDingin[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($minumanDingin[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($minumanDingin[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $minumanDingin[$i]["id"] ?>, "<?= $minumanDingin[$i]["nama"] ?>", <?= $minumanDingin[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($minumanDingin[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    endfor; ?>
                                </div>
                                <?php endif; ?>

                                <!-- Minuman Panas Section -->
                                <?php if ($minumanPanas) : ?>
                                <h3 class="menu-category-title"><i class="mdi mdi-coffee category-icon"></i>Aneka Minuman Panas</h3>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($minumanPanas); $i++) :
                                        if ($minumanPanas[$i]["jenis"] == 4) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card">
                                                <img src="<?= base_url() ?>/images/menu/<?= $minumanPanas[$i]["foto"] ?>" class="card-img-top <?php if ($minumanPanas[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $minumanPanas[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $minumanPanas[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($minumanPanas[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($minumanPanas[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $minumanPanas[$i]["id"] ?>, "<?= $minumanPanas[$i]["nama"] ?>", <?= $minumanPanas[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($minumanPanas[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    endfor; ?>
                                </div>
                                <?php endif; ?>

                            </div>

                            <!-- Tab Makanan -->
                            <div class="tab-pane fade" id="food" role="tabpanel" aria-labelledby="food-tab">
                                <?php if ($makanan) : ?>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($makanan); $i++) :
                                        if ($makanan[$i]["jenis"] == 1) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card">
                                                <img src="<?= base_url() ?>/images/menu/<?= $makanan[$i]["foto"] ?>" class="card-img-top <?php if ($makanan[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $makanan[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $makanan[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($makanan[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($makanan[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $makanan[$i]["id"] ?>, "<?= $makanan[$i]["nama"] ?>", <?= $makanan[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($makanan[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    endfor; ?>
                                </div>
                                <?php else : ?>
                                <div class="text-center py-5">
                                    <i class="mdi mdi-food-off empty-state-icon"></i>
                                    <h4 class="mt-3">Maaf, tidak ada menu makanan yang tersedia saat ini.</h4>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Tab Snack -->
                            <div class="tab-pane fade" id="snack" role="tabpanel" aria-labelledby="snack-tab">
                                <?php if ($snack) : ?>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($snack); $i++) :
                                        if ($snack[$i]["jenis"] == 2) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card">
                                                <img src="<?= base_url() ?>/images/menu/<?= $snack[$i]["foto"] ?>" class="card-img-top <?php if ($snack[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $snack[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $snack[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($snack[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($snack[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $snack[$i]["id"] ?>, "<?= $snack[$i]["nama"] ?>", <?= $snack[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($snack[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    endfor; ?>
                                </div>
                                <?php else : ?>
                                <div class="text-center py-5">
                                    <i class="mdi mdi-food-apple-outline empty-state-icon"></i>
                                    <h4 class="mt-3">Maaf, tidak ada menu snack yang tersedia saat ini.</h4>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Tab Minuman Dingin -->
                            <div class="tab-pane fade" id="cold-drinks" role="tabpanel" aria-labelledby="cold-drinks-tab">
                                <?php if ($minumanDingin) : ?>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($minumanDingin); $i++) :
                                        if ($minumanDingin[$i]["jenis"] == 3) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card">
                                                <img src="<?= base_url() ?>/images/menu/<?= $minumanDingin[$i]["foto"] ?>" class="card-img-top <?php if ($minumanDingin[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $minumanDingin[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $minumanDingin[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($minumanDingin[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($minumanDingin[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $minumanDingin[$i]["id"] ?>, "<?= $minumanDingin[$i]["nama"] ?>", <?= $minumanDingin[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($minumanDingin[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    endfor; ?>
                                </div>
                                <?php else : ?>
                                <div class="text-center py-5">
                                    <i class="mdi mdi-cup-water empty-state-icon"></i>
                                    <h4 class="mt-3">Maaf, tidak ada menu minuman dingin yang tersedia saat ini.</h4>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Tab Minuman Panas -->
                            <div class="tab-pane fade" id="hot-drinks" role="tabpanel" aria-labelledby="hot-drinks-tab">
                                <?php if ($minumanPanas) : ?>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($minumanPanas); $i++) :
                                        if ($minumanPanas[$i]["jenis"] == 4) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card">
                                                <img src="<?= base_url() ?>/images/menu/<?= $minumanPanas[$i]["foto"] ?>" class="card-img-top <?php if ($minumanPanas[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $minumanPanas[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $minumanPanas[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($minumanPanas[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($minumanPanas[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $minumanPanas[$i]["id"] ?>, "<?= $minumanPanas[$i]["nama"] ?>", <?= $minumanPanas[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($minumanPanas[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                    endfor; ?>
                                </div>
                                <?php else : ?>
                                <div class="text-center py-5">
                                    <i class="mdi mdi-coffee empty-state-icon"></i>
                                    <h4 class="mt-3">Maaf, tidak ada menu minuman panas yang tersedia saat ini.</h4>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Tab Best Seller -->
                            <div class="tab-pane fade" id="best-seller" role="tabpanel" aria-labelledby="best-seller-tab">
                                <?php if ($bestSeller) : ?>
                                <div class="row">
                                    <?php for ($i = 0; $i < count($bestSeller); $i++) : ?>
                                        <div class="col-md-3">
                                            <div class="card menu-card best-seller-card">
                                                <div class="best-seller-badge">
                                                    <i class="mdi mdi-star"></i> Best Seller
                                                </div>
                                                <img src="<?= base_url() ?>/images/menu/<?= $bestSeller[$i]["foto"] ?>" class="card-img-top <?php if ($bestSeller[$i]["status"] == 0) { echo 'menu-item-disabled'; } ?>" alt="<?= $bestSeller[$i]["nama"] ?>">
                                                <div class="card-body text-center">
                                                    <h5><?= $bestSeller[$i]["nama"] ?></h5>
                                                    <span class="price">Rp. <?= number_format($bestSeller[$i]["harga"], 0, ',', '.') ?></span>
                                                    <button class="btn btn-add-to-cart" <?php if ($bestSeller[$i]["status"] == 0) {
                                                        echo "disabled";
                                                    } ?> onclick='tambahPesanan(<?= $bestSeller[$i]["id"] ?>, "<?= $bestSeller[$i]["nama"] ?>", <?= $bestSeller[$i]["harga"] ?> )'>
                                                        <i class="mdi mdi-cart-plus"></i> <?php if ($bestSeller[$i]["status"] == 0) {
                                                            echo "Habis";
                                                        } else {
                                                            echo "Tambah ke Keranjang";
                                                        } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <?php else : ?>
                                <div class="text-center py-5">
                                    <i class="mdi mdi-star empty-state-icon"></i>
                                    <h4 class="mt-3">Belum ada menu best seller yang tersedia saat ini.</h4>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
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
                                                <input type="number" id="noMeja" class="form-control" aria-label="Amount (to the nearest dollar)">
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

                                <b id="peringatan" class="badge badge-danger">Silahkan isi nama dan no meja.</b><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" onclick="tutupModalKeranjang()">Tutup</button>
                                <button type="button" class="btn" style="background: linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3) !important; color: #6F4E37 !important; border: 2px solid #8B4513 !important; font-weight: bold; border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #A0522D, #8B4513, #6F4E37)'; this.style.color='#F5DEB3';" onmouseout="this.style.background='linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3)'; this.style.color='#6F4E37';" onclick="prosesTransaksi()" id="simpanTransaksi">Pesan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
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

                <!-- Modal -->
                <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Login admin.</h5>
                            </div>
                            <div class="modal-body">
                                <div id="errorLogin" class="mb-3"></div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select id="idUser" class="form-control text-dark">
                                            <?php for ($i = 0; $i < count($user); $i++) {
                                                echo "<option value='" . $user[$i]["id"] . "'>" . $user[$i]["nama"] . "</option>";
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="background: linear-gradient(135deg, #8B4513, #A0522D) !important; color: white; border: 1px solid #6F4E37;">Password</span>
                                        </div>
                                        <input type="password" id="pass" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" onclick="tutupModalLogin()">Batal</button>
                                <button type="button" class="btn" style="background: linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3) !important; color: #6F4E37 !important; border: 2px solid #8B4513 !important; font-weight: bold; border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, #A0522D, #8B4513, #6F4E37)'; this.style.color='#F5DEB3';" onmouseout="this.style.background='linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3)'; this.style.color='#6F4E37';" onclick="login()" id="simpanTransaksi">Log in</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <script src="<?php echo base_url() ?>/js/jquery/jquery.min.js"></script>
        <script>
            // Set base URL untuk digunakan di file JavaScript terpisah
            window.baseUrl = '<?= base_url() ?>';
        </script>
        <script src="<?= base_url() ?>/js/dashboard.js"></script>

        <script src="<?= base_url() ?>/vendors/js/vendor.bundle.base.js"></script>
        <script src="<?= base_url() ?>/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url() ?>/js/off-canvas.js"></script>
        <script src="<?= base_url() ?>/js/hoverable-collapse.js"></script>
        <script src="<?= base_url() ?>/js/jquery.cookie.js"></script>
        <script src="<?= base_url() ?>/js/template.js"></script>
        <script src="<?= base_url() ?>/js/settings.js"></script>
        <script src="<?= base_url() ?>/js/todolist.js"></script>
        <!-- endinject -->
</body>

</html>