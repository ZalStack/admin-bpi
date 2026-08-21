<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use App\Traits\CrudOperationsTrait;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    use ApiResponseTrait, CrudOperationsTrait;

    protected $model;
    protected $modelName;
    protected $validationRules = [];
    protected $updateValidationRules = [];
    protected $withRelations = [];
    protected $imageField = null;
    protected $imagePath = null;
    protected $searchFields = [];
    protected $orderBy = ['created_at' => 'desc'];

    public function __construct()
    {
        if (is_string($this->model)) {
            $this->model = new $this->model;
        }
    }

    /**
     * Index - Get all resources
     */
    public function index()
    {
        return $this->getAll($this->model, $this->withRelations, $this->orderBy);
    }

    /**
     * Show - Get single resource
     */
    public function show($id)
    {
        return $this->getById($this->model, $id, $this->withRelations);
    }

    /**
     * Store - Create new resource
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->all();

        // Handle file upload
        if ($this->imageField && $request->hasFile($this->imageField)) {
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath
            );
        }

        return $this->createResource($this->model, $data);
    }

    /**
     * Update - Update resource
     */
    public function update(Request $request, $id)
    {
        $rules = $this->updateValidationRules ?: $this->validationRules;
        $validator = validator($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->all();
        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        // Handle file upload
        if ($this->imageField && $request->hasFile($this->imageField)) {
            $oldFile = $resource->{$this->imageField};
            $data[$this->imageField] = $this->uploadFile(
                $request->file($this->imageField),
                $this->imagePath,
                $oldFile
            );
        }

        // Remove image field if no new file uploaded
        if ($this->imageField && !$request->hasFile($this->imageField)) {
            unset($data[$this->imageField]);
        }

        return $this->updateResource($this->model, $id, $data);
    }

    /**
     * Destroy - Delete resource
     */
    public function destroy($id)
    {
        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        // Delete image if exists
        if ($this->imageField && $resource->{$this->imageField}) {
            $this->deleteFile($this->imagePath, $resource->{$this->imageField});
        }

        return $this->deleteResource($this->model, $id);
    }

    /**
     * Toggle status
     */
    public function toggleStatus($id)
    {
        $resource = $this->model->find($id);

        if (!$resource) {
            return $this->notFoundResponse();
        }

        $resource->status = !$resource->status;
        $resource->save();

        return $this->successResponse([
            'id' => $resource->id,
            'status' => $resource->status
        ], 'Status updated successfully');
    }
}
