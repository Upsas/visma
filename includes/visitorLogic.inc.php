<?php

$visitors = new VisitorsContr();
$validation = new VisitorValidation($_POST);
if (isset($_POST['submit'])) {
    $errors = $validation->validateForm();
    if (!$errors) {
        $visitors->createVisitor($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['datetime']);
        header('location: http://localhost/visma_praktika');
        exit;
    }
}
if (isset($_POST['edit'])) {
    $errorsEdit = $validation->validateForm();
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['datetime'])) {
        if (!$errorsEdit) {
            $visitors->updateVisitor($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['datetime'], $_POST['id']);
            header('location: http://localhost/visma_praktika');
            exit;
        }
    }
}
if (isset($_POST['delete'])) {
    $visitors->destroyVisitor($_POST['id']);
    header('location: http://localhost/visma_praktika');
    exit;
}
