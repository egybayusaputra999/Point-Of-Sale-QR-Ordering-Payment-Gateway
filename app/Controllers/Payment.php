<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Config\Midtrans as MidtransConfig;

class Payment extends Controller
{
    protected $midtransConfig;
    
    public function __construct()
    {
        $this->midtransConfig = new MidtransConfig();
        
        // Set Midtrans configuration
        Config::$serverKey = $this->midtransConfig->serverKey;
        Config::$isProduction = $this->midtransConfig->isProduction;
        Config::$isSanitized = $this->midtransConfig->isSanitized;
        Config::$is3ds = $this->midtransConfig->is3ds;
    }
    
    /**
     * Create Snap Token for payment
     */
    public function createSnapToken()
    {
        try {
            // Get POST data
            $orderId = $this->request->getPost('order_id');
            $grossAmount = $this->request->getPost('gross_amount');
            $customerName = $this->request->getPost('customer_name');
            $customerPhone = $this->request->getPost('customer_phone');
            $customerEmail = $this->request->getPost('customer_email');
            $tableNumber = $this->request->getPost('table_number');
            $items = $this->request->getPost('items');
            
            // Validate required fields
            if (empty($orderId) || empty($grossAmount)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Order ID dan gross amount harus diisi'
                ]);
            }
            
            // Prepare transaction details
            $transactionDetails = [
                'order_id' => $orderId,
                'gross_amount' => (int)$grossAmount
            ];
            
            // Prepare customer details
            $customerDetails = [
                'first_name' => $customerName ?: 'Customer'
            ];
            
            // Only add phone if provided
            if (!empty($customerPhone)) {
                $customerDetails['phone'] = $customerPhone;
            }
            
            // Only add email if provided and valid
            if (!empty($customerEmail) && filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
                $customerDetails['email'] = $customerEmail;
            }
            
            // Prepare item details
            $itemDetails = [];
            if (!empty($items) && is_array($items)) {
                foreach ($items as $item) {
                    $itemDetails[] = [
                        'id' => $item['id'],
                        'price' => (int)$item['price'],
                        'quantity' => (int)$item['quantity'],
                        'name' => $item['name']
                    ];
                }
            }
            
            // Build transaction parameters
            $transactionParams = [
                'transaction_details' => $transactionDetails,
                'customer_details' => $customerDetails
            ];
            
            if (!empty($itemDetails)) {
                $transactionParams['item_details'] = $itemDetails;
            }
            
            // Enable credit card 3DS
            $transactionParams['credit_card'] = [
                'secure' => true
            ];
            
            // Add custom field for table number
            $transactionParams['custom_field1'] = $tableNumber;
            
            // Get Snap Token
            $snapToken = \Midtrans\Snap::getSnapToken($transactionParams);
            
            return $this->response->setJSON([
                'status' => 'success',
                'snap_token' => $snapToken,
                'client_key' => $this->midtransConfig->clientKey
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Midtrans Snap Token Error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal membuat token pembayaran: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Handle payment notification from Midtrans
     */
    public function notification()
    {
        try {
            $notification = new \Midtrans\Notification();
            
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $orderId = $notification->order_id;
            $grossAmount = $notification->gross_amount;
            
            // Log notification for debugging
            log_message('info', 'Midtrans Notification: ' . json_encode([
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'gross_amount' => $grossAmount
            ]));
            
            // Handle different transaction statuses
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    // Transaction is challenged by FDS
                    $this->updateTransactionStatus($orderId, 'challenge');
                } else if ($fraudStatus == 'accept') {
                    // Transaction is successful
                    $this->updateTransactionStatus($orderId, 'success');
                }
            } else if ($transactionStatus == 'settlement') {
                // Transaction is successful
                $this->updateTransactionStatus($orderId, 'success');
            } else if ($transactionStatus == 'pending') {
                // Transaction is pending
                $this->updateTransactionStatus($orderId, 'pending');
            } else if ($transactionStatus == 'deny') {
                // Transaction is denied
                $this->updateTransactionStatus($orderId, 'denied');
            } else if ($transactionStatus == 'expire') {
                // Transaction is expired
                $this->updateTransactionStatus($orderId, 'expired');
            } else if ($transactionStatus == 'cancel') {
                // Transaction is cancelled
                $this->updateTransactionStatus($orderId, 'cancelled');
            }
            
            return $this->response->setJSON(['status' => 'ok']);
            
        } catch (\Exception $e) {
            log_message('error', 'Midtrans Notification Error: ' . $e->getMessage());
            return $this->response->setJSON(['status' => 'error']);
        }
    }
    
    /**
     * Update transaction status in database
     */
    private function updateTransactionStatus($orderId, $status)
    {
        $db = \Config\Database::connect();
        
        // Update transaksi table
        $db->table('transaksi')
           ->where('id_transaksi', $orderId)
           ->update([
               'status_pembayaran' => $status,
               'updated_at' => date('Y-m-d H:i:s')
           ]);
        
        // If payment is successful, you might want to update antrian status as well
        if ($status === 'success') {
            $transaksi = $db->table('transaksi')
                           ->where('id_transaksi', $orderId)
                           ->get()
                           ->getRowArray();
            
            if ($transaksi) {
                $db->table('antrian')
                   ->where('id_antrian', $transaksi['id_antrian'])
                   ->update([
                       'status' => 'paid',
                       'updated_at' => date('Y-m-d H:i:s')
                   ]);
            }
        }
    }
    
    /**
     * Check transaction status
     */
    public function checkStatus($orderId)
    {
        try {
            $status = \Midtrans\Transaction::status($orderId);
            
            return $this->response->setJSON([
                'status' => 'success',
                'transaction_status' => $status->transaction_status,
                'fraud_status' => $status->fraud_status ?? null,
                'order_id' => $status->order_id,
                'gross_amount' => $status->gross_amount
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Midtrans Check Status Error: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengecek status pembayaran: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Payment page
     */
    public function index()
    {
        $data = [
            'title' => 'Payment Gateway',
            'snap_js_url' => $this->midtransConfig->getSnapJsUrl(),
            'client_key' => $this->midtransConfig->clientKey
        ];
        
        return view('payment', $data);
    }
}