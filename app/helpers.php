<?php
function generateUniqueCodeNumber($model, $column)
{
    $number = mt_rand(1000000, 9999999); // better than rand()

    // call the same function if the barcode exists already
    if (barcodeNumberExists($model, $column, $number)) {
        return generateUniqueCodeNumber($model, $column);
    }

    // otherwise, it's valid and can be used
    return $number;
}

function barcodeNumberExists($model, $column, $number)
{
    // query the database and return a boolean
    // for instance, it might look like this in Laravel
//    return $model::whereBarcodeNumber($number)->exists();
    // return $model::where('client_id', $number)->exists();
    return $model::where($column, $number)->exists();
}

function test()
{
    return dd("I am helper test function");
}

function changeDateFormate($date, $dateFormat)
{
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($dateFormat);
}

function productImagePath($imageName)
{
    return public_path('images/products/'.$imageName);
}
