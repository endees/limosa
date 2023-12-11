<?php

namespace App\Models\Form;

class DataHandler
{
    public function getBirthDateFromPesel(string $pesel): string
    {
        $vy = substr($pesel, 0, 2);
        $vm = substr($pesel, 2, 2);
        $vd = substr($pesel, 4, 2);

        // decode century
        if ($vm < 20) {
            $vy += 1900;
        } elseif ($vm < 40) {
            $vy += 2000;
        } elseif ($vm < 60) {
            $vy += 2100;
        } elseif ($vm < 80) {
            $vy += 2200;
        } else {
            $vy += 1800;
        }
        $vm %= 20;
        $birth = "$vd/$vm/$vy";
        return $birth;
    }

    public function getGenderFromPesel(string $pesel): string
    {
        $gender = substr($pesel, 9, 1) % 2;
        $gender = ($gender % 2 == 0) ? 'female' : 'male';
        return $gender;
    }
}
