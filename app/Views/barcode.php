<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Manajemen Barcode Meja</h4>
                    <div>
                        <a href="<?= base_url('dashboard/barcode/generate') ?>" class="btn btn-primary btn-sm me-2">
                            <i class="mdi mdi-qrcode"></i> Generate Barcode
                        </a>
                    </div>
                </div>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Meja</th>
                                <th>Barcode</th>
                                <th>Status</th>
                                <th>QR Code</th>
                                <th>Link Pemesanan</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($barcodes)): ?>
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="py-4">
                                            <i class="mdi mdi-qrcode-scan mdi-48px text-muted"></i>
                                            <p class="text-muted mt-2">Belum ada barcode meja. Klik "Generate Barcode" untuk membuat barcode untuk 15 meja.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($barcodes as $barcode): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <span class="badge badge-info">Meja <?= $barcode['table_number'] ?></span>
                                        </td>
                                        <td>
                                            <code class="text-primary"><?= $barcode['barcode'] ?></code>
                                        </td>
                                        <td>
                                            <?php if ($barcode['status'] == 'active'): ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Nonaktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                            <div class="qr-code-container">
                                <div class="qr-code" data-barcode="<?= $barcode['barcode'] ?>" data-table="<?= $barcode['table_number'] ?>">
                                    <canvas id="qr-<?= $barcode['id'] ?>" width="80" height="80"></canvas>
                                </div>
                                <button class="btn btn-sm btn-outline-primary mt-2 download-qr" data-table="<?= $barcode['table_number'] ?>">
                                    <i class="mdi mdi-download"></i> Download QR
                                </button>
                            </div>
                        </td>
                                        <td>
                                            <div class="input-group input-group-sm" style="max-width: 400px;">
                                                <input type="text" class="form-control" 
                                                       value="<?= base_url('order/' . $barcode['barcode']) ?>" 
                                                       id="link-<?= $barcode['id'] ?>" readonly>
                                                <button class="btn btn-outline-secondary" type="button" 
                                                        onclick="copyLink('link-<?= $barcode['id'] ?>')">
                                                    <i class="mdi mdi-content-copy"></i>
                                                </button>
                                                <a href="<?= base_url('order/' . $barcode['barcode']) ?>" 
                                                   target="_blank" 
                                                   class="btn btn-primary btn-sm" 
                                                   title="Buka halaman pemesanan meja <?= $barcode['table_number'] ?>">
                                                    <i class="mdi mdi-open-in-new"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?= date('d/m/Y H:i', strtotime($barcode['created_at'])) ?>
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('dashboard/barcode/regenerate/' . $barcode['id']) ?>" 
                                                   class="btn btn-sm" 
                                                   style="background: linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3) !important; color: #6F4E37 !important; border: 2px solid #8B4513 !important; font-weight: bold; border-radius: 6px; transition: all 0.3s ease;" 
                                                   onmouseover="this.style.background='linear-gradient(135deg, #A0522D, #8B4513, #6F4E37)'; this.style.color='#F5DEB3';" 
                                                   onmouseout="this.style.background='linear-gradient(135deg, #D2B48C, #DEB887, #F5DEB3)'; this.style.color='#6F4E37';" 
                                                   onclick="return confirm('Yakin ingin regenerate barcode meja <?= $barcode['table_number'] ?>?')">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                                <a href="<?= base_url('dashboard/barcode/toggle/' . $barcode['id']) ?>" 
                                                   class="btn btn-<?= $barcode['status'] == 'active' ? 'danger' : 'success' ?> btn-sm"
                                                   onclick="return confirm('Yakin ingin <?= $barcode['status'] == 'active' ? 'nonaktifkan' : 'aktifkan' ?> meja <?= $barcode['table_number'] ?>?')">
                                                    <i class="mdi mdi-<?= $barcode['status'] == 'active' ? 'eye-off' : 'eye' ?>"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QR Code Library -->
<script src="<?= base_url('/js/qrcode.min.js') ?>"></script>

<script>
// Barcode page specific JavaScript
(function() {
    'use strict';
    
    // Prevent multiple initialization
    if (window.barcodePageInitialized) {
        return;
    }
    window.barcodePageInitialized = true;
    
    let qrCodeInstances = [];
    
    // Initialize QR codes when DOM is ready
    function initializeQRCodes() {
        const qrElements = document.querySelectorAll('.qr-code');
        
        qrElements.forEach(function(element) {
            const barcode = element.getAttribute('data-barcode');
            const canvas = element.querySelector('canvas');
            const orderUrl = '<?= base_url('order/') ?>' + barcode;
            const tableNumber = element.getAttribute('data-table');
            
            if (!barcode || !canvas) {
                return;
            }
            
            try {
                // Create QR code with proper options
                const qr = new QRCode(orderUrl, {
                    width: 80,
                    height: 80,
                    typeNumber: 4,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: 0
                });
                
                // Render QR code to canvas
                qr.renderToCanvas(canvas);
                
                // Store canvas reference for download
                element.qrCanvas = canvas;
                
                // Store QR instance for cleanup
                qrCodeInstances.push({
                    element: element,
                    qr: qr,
                    canvas: canvas
                });
                
            } catch (error) {
                console.error('Error creating QR code for table', tableNumber, ':', error);
                
                // Simple error display
                if (canvas && canvas.getContext) {
                    const ctx = canvas.getContext('2d');
                    canvas.width = 80;
                    canvas.height = 80;
                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(0, 0, 80, 80);
                    ctx.fillStyle = '#ff0000';
                    ctx.font = '12px Arial';
                    ctx.textAlign = 'center';
                    ctx.fillText('ERROR', 40, 35);
                    ctx.fillText('Check Console', 40, 50);
                }
            }
        });
    }
    
    // Download QR code functionality
     function handleDownloadClick(e) {
         // Only handle clicks on download-qr buttons, don't prevent other events
         if (e.target.classList.contains('download-qr') || e.target.parentElement.classList.contains('download-qr')) {
             e.preventDefault();
             e.stopPropagation();
             
             const button = e.target.classList.contains('download-qr') ? e.target : e.target.parentElement;
             const tableNumber = button.getAttribute('data-table');
             const qrContainer = button.parentElement.querySelector('.qr-code');
             
             if (qrContainer && qrContainer.qrCanvas) {
                 try {
                     const link = document.createElement('a');
                     link.download = 'QR_Meja_' + tableNumber + '.png';
                     link.href = qrContainer.qrCanvas.toDataURL();
                     link.click();
                 } catch (error) {
                     console.error('Error downloading QR code:', error);
                 }
             }
         }
     }
    
    // Copy link function
    window.copyLink = function(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return;
        
        input.select();
        input.setSelectionRange(0, 99999);
        
        try {
            document.execCommand('copy');
            
            // Show success message
            const btn = input.nextElementSibling;
            if (btn) {
                const originalIcon = btn.innerHTML;
                btn.innerHTML = '<i class="mdi mdi-check"></i>';
                btn.classList.remove('btn-outline-secondary');
                btn.classList.add('btn-success');
                
                setTimeout(function() {
                    if (btn) {
                        btn.innerHTML = originalIcon;
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-outline-secondary');
                    }
                }, 2000);
            }
        } catch (err) {
            console.error('Gagal menyalin link: ', err);
        }
    };
    
    // Cleanup function
     function cleanup() {
         // Remove event listeners from download buttons
         const downloadButtons = document.querySelectorAll('.download-qr');
         downloadButtons.forEach(function(button) {
             button.removeEventListener('click', handleDownloadClick);
         });
         
         // Clear QR code instances
         qrCodeInstances.forEach(function(instance) {
             if (instance.element) {
                 instance.element.qrCanvas = null;
             }
         });
         qrCodeInstances = [];
         
         // Clear global flag
         window.barcodePageInitialized = false;
         
         // Clear global function
         if (window.copyLink) {
             window.copyLink = null;
         }
     }
    
    // Initialize when DOM is ready
     if (document.readyState === 'loading') {
         document.addEventListener('DOMContentLoaded', function() {
             initializeQRCodes();
             
             // Add download click handler only to download buttons
             const downloadButtons = document.querySelectorAll('.download-qr');
             downloadButtons.forEach(function(button) {
                 button.addEventListener('click', handleDownloadClick);
             });
         });
     } else {
         initializeQRCodes();
         
         // Add download click handler only to download buttons
         const downloadButtons = document.querySelectorAll('.download-qr');
         downloadButtons.forEach(function(button) {
             button.addEventListener('click', handleDownloadClick);
         });
     }
    
    // Cleanup when page is about to unload
    window.addEventListener('beforeunload', cleanup);
    
    // Cleanup when navigating away (for SPA-like behavior)
    window.addEventListener('pagehide', cleanup);
    
})();
</script>

<style>
.qr-code-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 8px;
    gap: 4px;
}
.qr-code {
    display: flex;
    justify-content: center;
    align-items: center;
}
.qr-code canvas {
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    width: 60px !important;
    height: 60px !important;
}
.download-qr {
    font-size: 8px;
    padding: 2px 4px;
    border-radius: 3px;
    width: 60px;
    height: 20px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.badge {
    font-size: 0.75rem;
}

code {
    font-size: 8px;
    padding: 1px 3px;
    background: #f1f3f4;
    border-radius: 2px;
    word-break: break-all;
    font-family: 'Courier New', monospace;
}

.input-group-sm .form-control {
    font-size: 8px;
    padding: 2px 4px;
    height: auto;
}

.input-group-sm .btn {
    font-size: 8px;
    padding: 2px 4px;
    height: auto;
}

.btn-group .btn {
    font-size: 9px;
    padding: 2px 6px;
    margin-right: 1px;
    border-radius: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.btn-sm {
    font-size: 9px;
    padding: 2px 6px;
    border-radius: 2px;
}

.table {
    font-size: 12px;
    margin-bottom: 0;
}

.table td, .table th {
    vertical-align: middle;
    padding: 6px 4px;
    border-top: 1px solid #e9ecef;
}

.table th {
    font-size: 11px;
    font-weight: 600;
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    text-align: center;
}

.table td:nth-child(1) {
    width: 8%;
    text-align: center;
    font-weight: 600;
    font-size: 11px;
}

.table td:nth-child(2) {
    width: 12%;
    font-family: 'Courier New', monospace;
    font-size: 9px;
    text-align: center;
}

.table td:nth-child(3) {
    width: 8%;
    text-align: center;
    font-size: 10px;
}

.table td:nth-child(4) {
    width: 12%;
    text-align: center;
    padding: 4px 2px;
}

.table td:nth-child(5) {
    width: 35%;
    font-size: 9px;
    word-break: break-all;
    line-height: 1.2;
}

.table td:nth-child(6) {
    width: 15%;
    font-size: 9px;
    text-align: center;
}

.table td:nth-child(7) {
    width: 10%;
    text-align: center;
    padding: 4px 2px;
}

.table-responsive {
    border-radius: 6px;
    overflow-x: hidden;
    overflow-y: auto;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.table-responsive table {
    width: 100%;
    table-layout: fixed;
    margin-bottom: 0;
}

.badge {
    font-size: 8px;
    padding: 2px 4px;
    border-radius: 2px;
}

.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.card {
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px 15px 0 0 !important;
}
</style>

<?= $this->endSection() ?>