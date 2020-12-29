<?php

class VisitorsContr extends Visitors
{

    public function returnAllVisitor()
    {
        return $this->getVisitors();
    }

    public function returnDublicates($name, $email, $phone)
    {
        return $this->checkDublicates($name, $email, $phone);
    }

    public function createVisitor($name, $email, $phone, $date)
    {

        $this->addVisitor($name, $email, $phone, $date);

    }
    public function destroyVisitor($id)
    {

        $this->deleteVisitor($id);

    }

    public function updateVisitor($name, $email, $phone, $date, $id)
    {
        $this->editVisitor($name, $email, $phone, $date, $id);

    }

}
