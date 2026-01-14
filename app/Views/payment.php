<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .payment-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .payment-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .btn-pay {
            background: #00bcd4;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            color: white;
            transition: all 0.3s;
        }
        .btn-pay:hover {
            background: #0097a7;
            color: white;
        }
        .result-container {
            background: #e8f5e8;
            border: 1px solid #4caf50;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
            display: none;
        }
        .loading {
            display: none;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-container">
            <h2 class="text-center mb-4">Payment Gateway Midtrans</h2>
            
            <div class="payment-form">
                <h4>Detail Pembayaran</h4>
                <form id="payment-form">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order_id" class="form-label">Order ID</label>
                            <input type="text" class="form-control" id="order_id" name="order_id" value="ORDER-<?= time() ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gross_amount" class="form-label">Total Pembayaran (Rp)</label>
                            <input type="number" class="form-control" id="gross_amount" name="gross_amount" value="10000" min="1000" required>
                        </div>
                    </div>
                    
                    <h5>Detail Pelanggan</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nama Depan</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="Budi" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Nama Belakang</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="Pratama" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="budi.pra@example.com" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="08111222333" required>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-pay" id="pay-button">
                            <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="loading" id="loading">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memproses pembayaran...</p>
            </div>
            
            <div class="result-container" id="result">
                <h5>Hasil Pembayaran</h5>
                <pre id="result-json"></pre>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap JS -->
    <script src="<?= $snap_js_url ?>" data-client-key="<?= $client_key ?>"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <script>
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const paymentData = {
                order_id: formData.get('order_id'),
                gross_amount: parseInt(formData.get('gross_amount')),
                customer_details: {
                    first_name: formData.get('first_name'),
                    last_name: formData.get('last_name'),
                    email: formData.get('email'),
                    phone: formData.get('phone')
                },
                item_details: [{
                    id: 'item1',
                    price: parseInt(formData.get('gross_amount')),
                    quantity: 1,
                    name: 'Pembayaran Order ' + formData.get('order_id')
                }]
            };
            
            // Show loading
            document.getElementById('loading').style.display = 'block';
            document.getElementById('pay-button').disabled = true;
            
            // Create Snap Token
            fetch('<?= base_url('payment/createSnapToken') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(paymentData)
            })
            .then(response => response.json())
            .then(data => {
                // Hide loading
                document.getElementById('loading').style.display = 'none';
                document.getElementById('pay-button').disabled = false;
                
                if (data.status === 'success') {
                    // Open Snap payment popup
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            console.log('Payment Success:', result);
                            showResult('success', result);
                            
                            // You can redirect to success page or update UI
                            // window.location.href = '<?= base_url('payment/success') ?>';
                        },
                        onPending: function(result) {
                            console.log('Payment Pending:', result);
                            showResult('pending', result);
                        },
                        onError: function(result) {
                            console.log('Payment Error:', result);
                            showResult('error', result);
                        },
                        onClose: function() {
                            console.log('Payment popup closed');
                            alert('Anda menutup popup pembayaran sebelum menyelesaikan pembayaran');
                        }
                    });
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loading').style.display = 'none';
                document.getElementById('pay-button').disabled = false;
                alert('Terjadi kesalahan saat memproses pembayaran');
            });
        });
        
        function showResult(status, result) {
            const resultContainer = document.getElementById('result');
            const resultJson = document.getElementById('result-json');
            
            resultJson.textContent = JSON.stringify(result, null, 2);
            resultContainer.style.display = 'block';
            
            // Change container style based on status
            if (status === 'success') {
                resultContainer.className = 'result-container alert alert-success';
            } else if (status === 'pending') {
                resultContainer.className = 'result-container alert alert-warning';
            } else {
                resultContainer.className = 'result-container alert alert-danger';
            }
            
            // Scroll to result
            resultContainer.scrollIntoView({ behavior: 'smooth' });
        }
        
        // Format currency input
        document.getElementById('gross_amount').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9]/g, '');
            if (value < 1000) {
                e.target.setCustomValidity('Minimum pembayaran adalah Rp 1.000');
            } else {
                e.target.setCustomValidity('');
            }
        });
    </script>
</body>
</html>