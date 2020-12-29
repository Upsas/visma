<?php
include './includes/autoloader.inc.php';
$visitors = new VisitorsContr();
$name = $email = $id = $phone = $date = '';
echo "What do you want to do? Type one of these: 'show', 'add', 'delete', 'edit' or 'csv': ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);

switch (trim($line)) {
    case 'show':
        if (count($visitors->returnAllVisitor()) > 0) {
            foreach ($visitors->returnAllVisitor() as $visitor) {
                echo 'id: ' . $visitor['id'] . "\n";
                echo 'name: ' . $visitor['name'] . "\n";
                echo 'email: ' . $visitor['email'] . "\n";
                echo 'phone: ' . $visitor['phone'] . "\n";
                echo 'date: ' . $visitor['date'] . "\n";
            }
        } else {
            echo 'There is no data to show';
        }
        break;
    case 'add':
        echo "example: name: tom, email: exam@info.com, phone: 867524893, date: 2020-12-20 19:27 " . PHP_EOL;
        echo "Write values in order: name, email, phone and date: ";
        $add = fopen("php://stdin", "r");
        $lineadd = fgets($add);
        $values = explode(" ", rtrim($lineadd));
        // changing form index to assoc array
        $values['name'] = $values[0];
        unset($values[0]);
        $values['email'] = $values[1];
        unset($values[1]);
        $values['phone'] = $values[2];
        unset($values[2]);

        $validateCLI = new VisitorValidation($values);
        $errors = $validateCLI->validateForm();

        if (count($values) === 5) {
            $name = $values['name'];
            $email = $values['email'];
            $phone = $values['phone'];
            $date = $values[3] . ' ' . $values[4];
        } else {
            echo 'Wrong input';
            exit;
        }
        if (!empty($name) && !empty($email) && !empty($phone) && !empty($date)) {
            if (!$errors) {
                $visitors->createVisitor($name, $email, $phone, $date);
                echo 'Data added succesfully';
                exit;
            } else {
                echo 'Errors: ' . "\n";
                print_r($errors);
                exit;
            }
        }
        break;
    case 'delete':
        echo "Write visitor id what you want to delete: ";
        $delete = fopen("php://stdin", "r");
        $deleteValue = fgets($delete);
        $deleteId = explode(" ", rtrim($deleteValue));
        if (!empty($deleteId) && (count($deleteId)) === 1) {
            if ($visitors->destroyVisitor($deleteId[0])) {
                echo 'Data delete succesfully' . PHP_EOL;
                exit;
            } else {
                echo 'Visitor with this ID was not found';
                exit;
            }
        }
        break;
    case 'edit':
        echo "Write new values in order:  name, email, phone, date and visitor_id: ";
        $edit = fopen("php://stdin", "r");
        $lineEdit = fgets($edit);
        $valuesEdit = explode(" ", rtrim($lineEdit));
        $valuesEdit['name'] = $valuesEdit[0];
        unset($valuesEdit[0]);
        $valuesEdit['email'] = $valuesEdit[1];
        unset($valuesEdit[1]);
        $valuesEdit['phone'] = $valuesEdit[2];
        unset($valuesEdit[2]);
        $validateCLI = new VisitorValidation($valuesEdit);
        $errors = $validateCLI->validateForm();
        if (count($valuesEdit) === 6) {
            $nameEdit = $valuesEdit['name'];
            $emailEdit = $valuesEdit['email'];
            $phoneEdit = $valuesEdit['phone'];
            $dateEdit = $valuesEdit[3] . ' ' . $valuesEdit[4];
            $idEdit = $valuesEdit[5];

        } else {
            echo 'Wrong input';
            exit;
        }

        if (!empty($nameEdit) && !empty($emailEdit) && !empty($phoneEdit) && !empty($dateEdit) && !empty($idEdit)) {
            if (!$errors) {
                $visitors->updateVisitor($nameEdit, $emailEdit, $phoneEdit, $dateEdit, $idEdit);
                echo 'Data updated succesfully';
                exit;
            } else {
                echo 'Errors: ' . "\n";
                print_r($errors);
                exit;
            }
        } else {
            echo 'Dont leave empty fields';
        }
        break;
    case 'csv':
        if (file_exists('./file.csv')) {
            include_once './includes/addCSV.inc.php';
            echo 'CSV file was succesfully added/updated';
            exit;
        } else {
            echo 'Wrong file directory';
        }
        break;
    default:
        echo 'Wrong input';
        exit;
}
