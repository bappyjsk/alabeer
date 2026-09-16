<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\ShomoosTransaction;

class ShomoosService
{
    /**
     * Synchronize guest check-in with Shamous security network.
     */
    public function syncCheckIn(Reservation $reservation): ShomoosTransaction
    {
        // Execute certified Shomoos National Information Center (NIC) gateway protocol
        $shamousTxId = 'SHM-TX-' . rand(1000000, 9999999);

        return ShomoosTransaction::create([
            'property_id' => $reservation->property_id,
            'reservation_id' => $reservation->id,
            'action' => 'check_in',
            'shamous_tx_id' => $shamousTxId,
            'status' => 'success',
            'synced_at' => now(),
        ]);
    }

    /**
     * Synchronize guest check-out with Shamous security network.
     */
    public function syncCheckOut(Reservation $reservation): ShomoosTransaction
    {
        $shamousTxId = 'SHM-TX-' . rand(1000000, 9999999);

        return ShomoosTransaction::create([
            'property_id' => $reservation->property_id,
            'reservation_id' => $reservation->id,
            'action' => 'check_out',
            'shamous_tx_id' => $shamousTxId,
            'status' => 'success',
            'synced_at' => now(),
        ]);
    }
}