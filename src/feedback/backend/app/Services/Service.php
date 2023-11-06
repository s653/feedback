<?php

namespace App\Services;

interface Service {
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function delete($id);
}
