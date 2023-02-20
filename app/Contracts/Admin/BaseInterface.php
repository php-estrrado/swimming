<?php

namespace App\Contracts\Admin;

interface BaseInterface {

    public function getAllRows($tablename, $field, $order, $active, $status);

    public function getRows($tablename, $field, $value, $active, $status);

    public function getRow($tablename, $field, $value, $active, $status);

    public function saveRow($tablename, $field, $value, $data);

    public function deleteRows($tablename, $field, $values, $type, $sort);

    public function deleteRow($tablename, $field, $value, $type, $sort);

    public function getRowCount($tablename, $field, $value, $active, $status);

    public function checkStatus($tablename, $field, $value, $id);

    public function changeStatus($tablename, $userid, $status);

    public function uploadEditorImage();
}
