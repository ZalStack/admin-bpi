<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru Masuk</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #334155; line-height: 1.6;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f6f9; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #650d1f 0%, #520A18 100%); padding: 28px 32px; text-align: left;">
                            <h1 style="margin: 0; font-size: 20px; font-weight: 700; color: #ffffff; letter-spacing: -0.3px;">
                                Pesan Kontak Baru Masuk
                            </h1>
                            <p style="margin: 6px 0 0 0; font-size: 13px; color: #e2e8f0; opacity: 0.9;">
                                Terdapat pesan baru yang dikirimkan melalui form kontak website.
                            </p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 28px 32px;">
                            
                            <!-- Sender Meta Table -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px; background-color: #f8fafc; border-radius: 8px; border: 1px solid #edf2f7; padding: 16px;">
                                <tr>
                                    <td style="padding: 6px 12px; font-size: 12px; font-weight: 600; color: #64748b; width: 100px;">Nama:</td>
                                    <td style="padding: 6px 12px; font-size: 14px; font-weight: 600; color: #1e293b;">{{ $kontakForm->nama }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 12px; font-size: 12px; font-weight: 600; color: #64748b;">Email:</td>
                                    <td style="padding: 6px 12px; font-size: 14px; font-weight: 500; color: #2B4E94;">
                                        <a href="mailto:{{ $kontakForm->email }}" style="color: #2B4E94; text-decoration: none;">{{ $kontakForm->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 12px; font-size: 12px; font-weight: 600; color: #64748b;">Waktu:</td>
                                    <td style="padding: 6px 12px; font-size: 13px; color: #475569;">
                                        {{ $kontakForm->created_at ? $kontakForm->created_at->format('d M Y, H:i') : date('d M Y, H:i') }} WIB
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 12px; font-size: 12px; font-weight: 600; color: #64748b;">Subjek:</td>
                                    <td style="padding: 6px 12px; font-size: 14px; font-weight: 600; color: #0f172a;">{{ $kontakForm->subjek }}</td>
                                </tr>
                            </table>

                            <!-- Message Content Box -->
                            <div>
                                <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 8px;">
                                    Isi Pesan:
                                </div>
                                <div style="background-color: #ffffff; border-left: 4px solid #520A18; border-top: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; border-radius: 0 8px 8px 0; padding: 18px 20px; font-size: 14px; line-height: 1.7; color: #334155; white-space: pre-wrap;">{{ $kontakForm->pesan }}</div>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 20px 32px; text-align: center; border-top: 1px solid #edf2f7;">
                            <p style="margin: 0; font-size: 12px; color: #94a3b8; line-height: 1.5;">
                                Email notifikasi otomatis ini dikirim oleh sistem website.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
