<?php
function isValidGSTIN($gstin) {
    $gstin = strtoupper(trim($gstin));
    $gstinPattern = '/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/';

    if (!preg_match($gstinPattern, $gstin)) {
        return false; // Invalid format
    }
    $stateCode = substr($gstin, 0, 2);
    return true;
}
?>
