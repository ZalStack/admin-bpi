<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

trait CrudOperationsTrait
{
    use ApiResponseTrait;

    /**
     * Get all resources
     */
    protected function getAll(string $model, array $with = [], array $orderBy = ['created_at' => 'desc']): JsonResponse
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
     * Get all resources with pagination support.
     * Supports ?page=1&per_page=15 query parameters.
     */
    protected function getAllPaginated(string $model, array $with = [], array $orderBy = ['created_at' => 'desc'], ?int $defaultPerPage = 15): JsonResponse
    {
        $query = $model::query();

        if (! empty($with)) {
            $query->with($with);
        }

        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        $perPage = (int) request()->input('per_page', $defaultPerPage);
        $perPage = max(1, min($perPage, 100));

        $paginator = $query->paginate($perPage);

        return $this->successResponse([
            'items' => $paginator->items(),
            'pagination' => [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'has_more_pages' => $paginator->hasMorePages(),
            ],
        ]);
    }

    /**
     * Get cached query result. Perfect for list endpoints that don't change frequently.
     * Cache is automatically invalidated when data is modified.
     */
    protected function getCachedQuery(string $cacheKey, callable $callback, int $ttl = 300): JsonResponse
    {
        $data = cache()->remember($cacheKey, $ttl, $callback);

        return $this->successResponse($data);
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
