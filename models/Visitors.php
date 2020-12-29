<?php
// All queries with DB
class VisitorsModel extends Dbh
{

    protected function getAllVisitors()
    {
        // We dont need prepeared statment because there is no input
        $sql = "SELECT * FROM visitors";
        return $this->connect()->query($sql)->fetchAll();
    }
    protected function prepeareGetDublicates()
    {
        $sql = "SELECT `name`, `email`, `phone`, `id` FROM `visitors` where `name` =  ? OR `email` = ? OR `phone` = ?";
        return $this->connect()->prepare($sql);

    }

    protected function prepareAddVisitor()
    {
        $sql = "INSERT INTO `visitors` (`id`, `name`, `email`, `phone`, `date`, `data_created`, `data_updated`) VALUES (NULL, ?, ?, ?, ?, NULL, NULL)";
        return $this->connect()->prepare($sql);
    }

    protected function prepareDeleteVisitor()
    {
        $sql = "DELETE FROM `visitors` WHERE `visitors`.`id` = ?";
        return $this->connect()->prepare($sql);
    }
    protected function prepareEditVisitor()
    {
        $sql = "UPDATE `visitors` SET `name` = ?, `email` = ?, `phone` = ?, `date` = ? WHERE `visitors`.`id` = ?
        ";
        return $this->connect()->prepare($sql);
    }

}
