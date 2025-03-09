<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EventModel;

class EventApiController extends ResourceController
{
    protected $modelName = 'App\Models\EventModel';
    protected $format    = 'json';

    public function index()
    {
        $data = $this->model->findAll();
        if (empty($data)) {
            return $this->failNotFound('No events found');
        }
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Event not found');
        }
        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->insert($data)) {
            return $this->fail($this->model->errors());
        }
        return $this->respondCreated(['message' => 'Event created successfully']);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->update($id, $data)) {
            return $this->fail($this->model->errors());
        }
        return $this->respond(['message' => 'Event updated successfully']);
    }

    public function delete($id = null)
    {
        if (!$this->model->delete($id)) {
            return $this->failNotFound('Event not found');
        }
        return $this->respondDeleted(['message' => 'Event deleted successfully']);
    }
}