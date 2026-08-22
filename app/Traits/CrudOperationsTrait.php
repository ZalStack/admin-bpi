<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait CrudOperationsTrait
{
    use ApiResponseTrait;

    /**
     * Get all resources
     */
    protected function getAll(string $model, array $with = [], array $orderBy = ['created_at' => 'desc'])
    {
        $query = $model::query();

        if (! empty($with)) {
            $query->with($with);
        }

        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $this->successResponse($query->get());
    }

    /**
     * Get single resource by ID
     */
    protected function getById(string $model, $id, array $with = [])
    {
        $query = $model::query();

        if (! empty($with)) {
            $query->with($with);
        }

        $data = $query->find($id);

        if (! $data) {
            return $this->notFoundResponse();
        }

        return $this->successResponse($data);
    }

    /**
     * Create resource
     */
    protected function createResource(string $model, array $data)
    {
        $resource = $model::create($data);

        return $this->successResponse($resource, 'Resource created successfully', 201);
    }

    /**
     * Update resource
     */
    protected function updateResource(string $model, $id, array $data)
    {
        $resource = $model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        $resource->update($data);

        return $this->successResponse($resource, 'Resource updated successfully');
    }

    /**
     * Delete resource
     */
    protected function deleteResource(string $model, $id)
    {
        $resource = $model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        $resource->delete();

        return $this->successResponse(null, 'Resource deleted successfully');
    }

    /**
     * Toggle status
     */
    protected function toggleStatus(string $model, $id, string $statusColumn = 'status')
    {
        $resource = $model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        $resource->$statusColumn = ! $resource->$statusColumn;
        $resource->save();

        return $this->successResponse([
            'id' => $resource->id,
            'status' => $resource->$statusColumn,
        ], 'Status updated successfully');
    }

    /**
     * Handle file upload.
     * Nama file dibangkitkan acak (hashName); ekstensi dari nama file
     * klien tidak dipercaya.
     */
    protected function uploadFile($file, string $path, ?string $oldFile = null): string
    {
        if ($oldFile) {
            Storage::disk('public')->delete($path.'/'.$oldFile);
        }

        return basename($file->store($path, 'public'));
    }

    /**
     * Delete file
     */
    protected function deleteFile(string $path, string $fileName): void
    {
        if ($fileName) {
            Storage::disk('public')->delete($path.'/'.$fileName);
        }
    }
}
