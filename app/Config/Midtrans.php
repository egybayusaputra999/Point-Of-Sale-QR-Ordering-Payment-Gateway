<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Midtrans extends BaseConfig
{
    /**
     * Midtrans Server Key
     * Get from: https://dashboard.midtrans.com/settings/config_info
     */
    public $serverKey = '';

    /**
     * Midtrans Client Key
     * Get from: https://dashboard.midtrans.com/settings/config_info
     */
    public $clientKey = '';

    /**
     * Set to true for production environment
     * Set to false for sandbox/development environment
     */
    public $isProduction = false;

    /**
     * Set sanitization on (default)
     */
    public $isSanitized = true;

    /**
     * Set 3DS transaction for credit card to true
     */
    public $is3ds = true;

    /**
     * Midtrans API URLs
     */
    public $sandboxBaseUrl = 'https://app.sandbox.midtrans.com';
    public $productionBaseUrl = 'https://app.midtrans.com';

    /**
     * Snap JS URLs
     */
    public $sandboxSnapJs = 'https://app.sandbox.midtrans.com/snap/snap.js';
    public $productionSnapJs = 'https://app.midtrans.com/snap/snap.js';

    /**
     * Get current environment base URL
     */
    public function getBaseUrl(): string
    {
        return $this->isProduction ? $this->productionBaseUrl : $this->sandboxBaseUrl;
    }

    /**
     * Get current environment Snap JS URL
     */
    public function getSnapJsUrl(): string
    {
        return $this->isProduction ? $this->productionSnapJs : $this->sandboxSnapJs;
    }
}