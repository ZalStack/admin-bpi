<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\KontakForm;
use Illuminate\Http\Request;

class KontakFormApiController extends BaseApiController
{
    protected $model = KontakForm::class;
    protected $orderBy = ['created_at' => 'desc'];

    protected $validationRules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subjek' => 'required|string|max:255',
        'pesan' => 'required|string',
        'status' => 'nullable|string|max:50'
    ];

    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->all();
        $data['status'] = $data['status'] ?? 'unread';

        return $this->createResource($this->model, $data);
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = validator($request->all(), [
            'status' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        $resource->status = $request->status;
        $resource->save();

        return $this->successResponse($resource, 'Status updated successfully');
    }

    public function getByStatus($status)
    {
        $resources = $this->model->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getUnread()
    {
        $resources = $this->model->where('status', 'unread')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function markAsRead($id)
    {
        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        $resource->status = 'read';
        $resource->save();

        return $this->successResponse($resource, 'Marked as read');
    }

    public function markAsUnread($id)
    {
        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        $resource->status = 'unread';
        $resource->save();

        return $this->successResponse($resource, 'Marked as unread');
    }

    public function destroy($id)
    {
        return $this->deleteResource($this->model, $id);
    }
}
