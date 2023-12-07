<?php

namespace App\Services;

class TicketService {
    public function generate($csv) {
        $csvHeader = array_shift($csv);

        foreach ($csv as $customer) {
            // $name = $customer[0];
            // $governmentId = $customer[1];
            // $email = $customer[2];
            // $debtAmount = $customer[3];
            // $debtDueDate = $customer[4];
            // $debtId = $customer[5];
        }
    }
}