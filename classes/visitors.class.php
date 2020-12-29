<?php

include './models/Visitors.php';

class Visitors extends VisitorsModel
{

    protected function getVisitors()
    {
        return $this->getAllVisitors();
    }

    protected function checkDublicates($name, $email, $phone)
    {
        $stmt = $this->prepeareGetDublicates();
        $stmt->execute([$name, $email, $phone]);
        $values = $stmt->fetchAll();
        return $values;
    }

    protected function addVisitor($name, $email, $phone, $date)
    {

        $this->prepareAddVisitor()->execute([$name, $email, $phone, $date]);
    }
    protected function deleteVisitor($id)
    {

        $this->prepareDeleteVisitor()->execute([$id]);
    }
    protected function editVisitor($name, $email, $phone, $date, $id)
    {

        $this->prepareEditVisitor()->execute([$name, $email, $phone, $date, $id]);
    }

}
