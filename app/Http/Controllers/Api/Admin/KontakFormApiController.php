<?php

namespace App\Http\Controllers\Api\Admin;

use App\Mail\PesanKontakMasukMail;
use App\Models\KontakForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class KontakFormApiController extends BaseApiController
{
    protected $model = KontakForm::class;

    protected array $orderBy = ['created_at' => 'desc'];

    protected array $validationRules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subjek' => 'required|string|max:255',
        'pesan' => 'required|string|max:2000',
    ];

    public function store(Request $request)
    {
        // Honeypot anti-bot: field tersembunyi 'website' harus kosong.
        // Jika terisi, tolak diam-diam agar bot tidak mencoba lagi.
        if ($request->filled('website')) {
            return $this->successResponse(null, 'Message sent successfully');
        }

        $validator = validator($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // Hanya field yang diizinkan; status dipaksa server-side
        // agar penyerang tidak bisa menyembunyikan spam dari unread.
        $data = $request->only(['nama', 'email', 'subjek', 'pesan']);
        $data['status'] = 'unread';

        $resource = $this->model::create($data);

        // Kirim email notifikasi ke email resmi perusahaan/admin
        try {
            $recipient = config('mail.contact_recipient') ?: config('mail.from.address');
            if (! empty($recipient) && filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                Mail::to($recipient)->send(new PesanKontakMasukMail($resource));
            }
        } catch (\Throwable $e) {
            Log::warning('Gagal mengirim email notifikasi kontak baru: ' . $e->getMessage());
        }

        return $this->successResponse($resource, 'Message sent successfully', 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = validator($request->all(), [
            'status' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $resource = $this->model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        $resource->status = $request->status;
        $resource->save();

        return $this->successResponse($resource, 'Status updated successfully');
    }

    public function getByStatus($status)
    {
        $resources = $this->model::where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function getUnread()
    {
        $resources = $this->model::where('status', 'unread')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->successResponse($resources);
    }

    public function markAsRead($id)
    {
        $resource = $this->model::find($id);

        if (! $resource) {
            return $this->notFoundResponse();
        }

        $resource->status = 'read';
        $resource->save();

        return $this->successResponse($resource, 'Marked as read');
    }

    public function markAsUnread($id)
    {
        $resource = $this->model::find($id);

        if (! $resource) {
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
