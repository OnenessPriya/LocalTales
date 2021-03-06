<?php

namespace App\Contracts;

interface OrderContract
{
    public function listAll();
    public function listById($id);
    public function listByStatus($status);
    public function searchOrder(string $term);
    public function create(array $data);
    public function update($id, array $data);
    public function toggle($id, $status);
    // public function delete($id);
}
