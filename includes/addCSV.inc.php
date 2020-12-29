<?php

$csv = array_map('str_getcsv', file('./file.csv'));
foreach ($csv as $key => $value) {
    if ($key < 1) {
        continue;
    }

    $result[] = explode(';', $value[0]);
}

foreach ($result as $value) {

    $value['name'] = $value[0];
    unset($value[0]);
    $value['email'] = $value[1];
    unset($value[1]);
    $value['phone'] = $value[2];
    unset($value[2]);
    $value['date'] = $value[3];
    unset($value[3]);

}

foreach ($result as list($name, $email, $phone, $date)) {

    $validation = new VisitorValidation($value);
    $errors = $validation->validateForm();
    // If name, email or phone is same update whole field

    if ($visitors->returnDublicates($name, $email, $phone)) {
        $values = $visitors->returnDublicates($name, $email, $phone);
        foreach ($values as $value) {
            $visitors->updateVisitor($name, $email, $phone, $date, $value['id']);
        }
        //  If dublicate was not found add to db
    }if (!$errors) {
        $visitors->createVisitor($name, $email, $phone, $date);
    } else {

        echo 'Errors: ' . PHP_EOL;
        print_r($errors);

    }
}
