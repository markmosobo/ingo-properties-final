<?php

namespace App\Services;

use App\Models\PmsProperty;

class CommissionService
{
    public function resolve(PmsProperty $property)
    {
        $landlord = $property->landlord;

        // SAFETY CHECK
        if (!$landlord) {
            return [
                'source' => 'system',
                'type' => 'none',
                'value' => 0
            ];
        }

        // 1. PROPERTY LEVEL (HIGHEST PRIORITY)
        if (!is_null($property->commission)) {
            return [
                'source' => 'property',
                'type' => 'percentage',
                'value' => (float) $property->commission
            ];
        }

        if (!is_null($property->fixed_commission)) {
            return [
                'source' => 'property',
                'type' => 'fixed',
                'value' => (float) $property->fixed_commission
            ];
        }

        // 2. LANDLORD LEVEL (FALLBACK)
        if (!is_null($landlord->commission)) {
            return [
                'source' => 'landlord',
                'type' => 'percentage',
                'value' => (float) $landlord->commission
            ];
        }

        if (!is_null($landlord->fixed_commission)) {
            return [
                'source' => 'landlord',
                'type' => 'fixed',
                'value' => (float) $landlord->fixed_commission
            ];
        }

        // 3. FINAL FALLBACK (SAFE DEFAULT)
        return [
            'source' => 'system',
            'type' => 'none',
            'value' => 0
        ];
    }
}