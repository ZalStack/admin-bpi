A **shortlink** turns a long web address into a short one that is easy to remember and share, using the BPI website domain.

**Example:** the long address `https://docs.google.com/forms/d/e/1FAIpQLSf.../viewform` can become `bpi.or.id/daftar-ffi-2026`.

What it is good for:

- Easy to share on social media, WhatsApp, posters, or presentations.
- **Clicks are counted automatically**, so you know how many times the link was opened.
- **The destination can be changed at any time** without changing the short link. This is useful for QR codes that are already printed.

Open menu: [Shortlink](cms:admin.shortlink.index)

## Creating a shortlink

1. Click **Add Shortlink**.
2. Fill in **Destination URL** (required): the full target address, starting with `https://`.
3. Fill in **Short Code**: the last part of the short link, for example `annual-report-2026`.
   - It must be 3–50 characters and may only contain **lowercase letters, numbers, and hyphens (-)**.
   - It can be left empty. The system then creates a random code, for example `x7k2p9`.
   - A preview of the **Short URL** appears below the field.
4. (Optional) Fill in **Title / Note**: an internal note to recognize it easily, for example *FFI 2026 Registration Form*.
5. Tick **Status: Active**.
6. Click **Save Shortlink**.

> **Note:** Some codes **cannot be used** because website pages already use them, for example `about`, `contact`, `news`, `project`, `berita`, `kontak`, `admin`, and `login`. If the message *"This code is reserved…"* appears, choose another code.

## The shortlink list page

The top of the page shows the number of shortlinks and the **total clicks**. Each row shows:

- **Short Link**: the short link. Click the copy icon to copy it.
- **Destination**: the target address.
- **Clicks**: the number of clicks and when it was last clicked.
- **Status**: Active / Inactive. An **Inactive** shortlink shows a "not found" page when opened.
- **Action**: QR Code icon, ✏️ Edit, 🗑️ Delete.

### Quick QR code from a shortlink

Click the **QR Code** icon on a shortlink row. A window with a QR code appears, with these buttons:

- **Download PNG** / **Download SVG**: download a standard QR code.
- **Customize & save as QR Code →**: create a QR code with your own colors, logo, and caption. See the [QR Code](bab:qrcode) chapter.

## Changing a shortlink

- **Change the destination:** click ✏️, change **Destination URL**, then save. The short link and any printed QR codes automatically lead to the new destination.
- **Change the code:** click ✏️, then change **Short Code**. Read the warning below before doing this.

> **Warning:** Changing the **Short Code** makes the old link **stop working**, including links already shared and QR codes already printed. Only change the code if the link has never been shared.

## Deleting a shortlink

A shortlink that is **still used by a QR code** cannot be deleted. A message says the related QR codes must be changed or deleted first. If you only want to stop the link, set its status to **Inactive**.
