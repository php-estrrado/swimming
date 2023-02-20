<?php

namespace App\Repositories\Admin;

use App\Contracts\Admin\BaseInterface as BaseInterface;
use App\Models\Admin\Base;

abstract class BaseRepository implements BaseInterface {

    private $base;

    protected function __construct(Base $base) {
        $this->base = $base;
    }

    public function getAllRows($tablename, $field, $order, $active, $status) {
        return $this->base->getAllRows($tablename, $field, $order, $active, $status);
    }

    public function getRows($tablename, $field, $value, $active, $status) {
        return $this->base->getRows($tablename, $field, $value, $active, $status);
    }

    public function getRow($tablename, $field, $value, $active, $status) {
        return $this->base->getRow($tablename, $field, $value, $active, $status);
    }

    public function saveRow($tablename, $field, $value, $data) {
        return $this->base->saveRow($tablename, $field, $value, $data);
    }

    public function deleteRows($tablename, $field, $values, $type, $sort) {
        return $this->base->deleteRows($tablename, $field, $values, $type, $sort);
    }

    public function deleteRow($tablename, $field, $value, $type, $sort) {
        return $this->base->deleteRow($tablename, $field, $value, $type, $sort);
    }

    public function getRowCount($tablename, $field, $value, $active, $status) {
        return $this->base->getRowCount($tablename, $field, $value, $active, $status);
    }

    public function checkStatus($tablename, $field, $value, $id) {
        return $this->base->checkStatus($tablename, $field, $value, $id);
    }

    public function changeStatus($tablename, $userid, $status) {
        return $this->base->changeStatus($tablename, $userid, $status);
    }

    public function uploadEditorImage() {
        return $this->base->uploadEditorImage();
    }

}
