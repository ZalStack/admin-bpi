<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\KontakForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    private const RECIPIENT = 'sekretariat@bpi.or.id';

    public function store(Request $request)
    {
        // Honeypot anti-bot: field tersembunyi 'website' harus kosong.
        if ($request->filled('website')) {
            return $this->successResponse(null, 'Message sent successfully');
        }

        $validator = validator($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $data = $request->only(['nama', 'email', 'subjek', 'pesan']);
        $data['status'] = 'unread';

        $resource = $this->model::create($data);

        $this->sendContactEmail($resource);

        return $this->successResponse($resource, 'Message sent successfully', 201);
    }

    private function sendContactEmail(KontakForm $form): void
    {
        $to = self::RECIPIENT;
        $from = $form->email;
        $fromName = $form->nama;
        $subject = $form->subjek;

        $boundary = md5(uniqid(time()));
        $appName = config('app.name', 'Admin BPI');
        $date = $form->created_at->format('d M Y, H:i');

        $nama = htmlspecialchars($form->nama, ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($form->email, ENT_QUOTES, 'UTF-8');
        $subjek = htmlspecialchars($form->subjek, ENT_QUOTES, 'UTF-8');
        $pesan = nl2br(htmlspecialchars($form->pesan, ENT_QUOTES, 'UTF-8'));

        $htmlBody = <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="margin:0;padding:0;background:#f4f7fa;font-family:'Segoe UI',Tahoma,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fa;padding:30px 0;">
<tr><td align="center">
<table width="600" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.08);">
<tr><td style="background:linear-gradient(135deg,#2B4E94,#1a3a6e);padding:30px 40px;text-align:center;">
<h1 style="color:#fff;margin:0;font-size:22px;">Pesan Baru dari Formulir Kontak</h1>
<p style="color:rgba(255,255,255,0.8);margin:8px 0 0;font-size:13px;">{$appName}</p>
</td></tr>
<tr><td style="padding:30px 40px;">
<table width="100%" cellpadding="0" cellspacing="0">
<tr><td style="padding:12px 0;border-bottom:1px solid #eef0f4;">
<span style="color:#8896ab;font-size:12px;text-transform:uppercase;">Nama Pengirim</span><br>
<span style="color:#1e293b;font-size:15px;font-weight:600;">{$nama}</span>
</td></tr>
<tr><td style="padding:12px 0;border-bottom:1px solid #eef0f4;">
<span style="color:#8896ab;font-size:12px;text-transform:uppercase;">Email</span><br>
<a href="mailto:{$email}" style="color:#2B4E94;font-size:15px;font-weight:600;text-decoration:none;">{$email}</a>
</td></tr>
<tr><td style="padding:12px 0;border-bottom:1px solid #eef0f4;">
<span style="color:#8896ab;font-size:12px;text-transform:uppercase;">Subjek</span><br>
<span style="color:#1e293b;font-size:15px;font-weight:600;">{$subjek}</span>
</td></tr>
<tr><td style="padding:12px 0;">
<span style="color:#8896ab;font-size:12px;text-transform:uppercase;">Pesan</span><br>
<div style="background:#f8fafc;border:1px solid #eef0f4;border-radius:8px;padding:16px;margin-top:6px;">
<p style="color:#1e293b;font-size:14px;line-height:1.7;margin:0;">{$pesan}</p>
</div>
</td></tr>
</table>
</td></tr>
<tr><td style="padding:0 40px 30px;">
<a href="mailto:{$email}?subject=Re: {$subjek}" style="display:inline-block;background:#2B4E94;color:#fff;text-decoration:none;padding:12px 28px;border-radius:8px;font-size:14px;font-weight:600;">Balas via Email</a>
</td></tr>
<tr><td style="background:#f8fafc;padding:16px 40px;text-align:center;border-top:1px solid #eef0f4;">
<p style="color:#8896ab;font-size:11px;margin:0;">Email ini dikirim otomatis oleh {$appName} pada {$date}</p>
</td></tr>
</table>
</td></tr>
</table>
</body>
</html>
HTML;

        $plainBody = "Pesan Baru dari Formulir Kontak\n"
            ."Nama: {$nama}\n"
            ."Email: {$from}\n"
            ."Subjek: {$subjek}\n\n"
            .strip_tags($pesan)."\n";

        $headers = "From: {$fromName} <{$from}>\r\n"
            ."Reply-To: {$from}\r\n"
            ."MIME-Version: 1.0\r\n"
            ."Content-Type: multipart/alternative; boundary=\"{$boundary}\"\r\n"
            ."X-Mailer: PHP-".PHP_VERSION."\r\n";

        $body = "--{$boundary}\r\n"
            ."Content-Type: text/plain; charset=UTF-8\r\n"
            ."Content-Transfer-Encoding: 7bit\r\n\r\n"
            .$plainBody."\r\n\r\n"
            ."--{$boundary}\r\n"
            ."Content-Type: text/html; charset=UTF-8\r\n"
            ."Content-Transfer-Encoding: 7bit\r\n\r\n"
            .$htmlBody."\r\n\r\n"
            ."--{$boundary}--";

        try {
            mail($to, $subject, $body, $headers);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email kontak form: '.$e->getMessage());
        }
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
