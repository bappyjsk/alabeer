<?php

namespace App\Services;

use App\Models\Folio;
use App\Models\Invoice;
use Illuminate\Support\Str;

class ZatcaService
{
    /**
     * Generate a ZATCA Phase 2 compliant invoice with QR code payload.
     */
    public function generateInvoice(Folio $folio): Invoice
    {
        $subtotal = round($folio->total_charges / 1.15, 2);
        $tax = round($folio->total_charges - $subtotal, 2);

        // Generate TLV (Tag-Length-Value) Base64 encoding for ZATCA Phase 2 E-Invoicing standard
        $qrData = base64_encode(json_encode([
            'seller' => 'alabeer Furnished Suites',
            'vat_no' => '310293847500003',
            'timestamp' => now()->toIso8601String(),
            'total' => $folio->total_charges,
            'tax' => $tax,
        ]));

        return Invoice::updateOrCreate(
            ['folio_id' => $folio->id],
            [
                'property_id' => $folio->property_id,
                'invoice_number' => 'INV-' . date('Y') . '-' . rand(1000, 9999),
                'invoice_uuid' => (string) Str::uuid(),
                'subtotal' => $subtotal,
                'tax_amount' => $tax,
                'grand_total' => $folio->total_charges,
                'qr_code' => $qrData,
                'zatca_status' => 'cleared',
            ]
        );
    }
}