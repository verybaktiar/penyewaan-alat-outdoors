<?php
  
/**
 * Write code on Method
 *
 * @return response()
 */

if (! function_exists('moneyFormat')) {
    function rem_zero_val($val){
        if(!empty($val)){
            $w = round($val * 100) / 100;
            $x = number_format($w, 2, ',', '.');
            $y = preg_replace("/\.?0*$/",'',$x);
            $z = rtrim($y,',');
            return $z;
        }

        return '';
    }

    function ke_rupiah($val){
        if(!empty($val)){
            return 'Rp.' . rem_zero_val($val);
        }

        return '';
    }
}