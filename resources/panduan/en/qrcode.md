The **QR Code** menu creates **QR codes with the BPI logo**, ready to print on posters, banners, invitations, or presentations. When scanned with a phone camera, the code opens a web address.

Open menu: [QR Code](cms:admin.qrcode.index)

## Shortlink or Custom URL?

Before creating a QR code, decide what it contains:

| Option | Advantages | Disadvantages |
|---|---|---|
| **Shortlink** *(recommended)* | The destination can be changed **after printing**, and scans are counted | The shortlink must first be created in the [Shortlink](bab:shortlink) menu |
| **Custom URL** | Ready right away without a shortlink | The destination **cannot be changed** after printing, and scans are not counted |

> **Tip:** For printed material (posters, banners, brochures), **always use a Shortlink**. If the destination changes, for example a new registration form, just change the shortlink's destination without reprinting.

## Creating a QR code

1. Click **Add QR Code**.
2. Fill in **Title** (required): an internal name, also used as the **file name** when downloading, for example *Annual Meeting 2026 Banner*.
3. Under **QR Content**, choose:
   - **Shortlink**, then pick a shortlink from the list. Its destination is shown below the list (**Redirects to:**), or
   - **Custom URL**, then fill in the full **Destination URL** with `https://`.
4. Under **Style**, choose the **QR Color** (code color) and **Background Color**.
5. Under **Center Logo**, choose:
   - **BPI Logo**: the BPI logo in the center (default),
   - **Upload Logo**: upload another logo (transparent PNG, JPG, or WEBP, maximum 1 MB), or
   - **No Logo**: no logo.
6. (Optional) Fill in **Caption**: text below the code, for example *Scan to register* (maximum 60 characters).
7. Check the result in **Live Preview**.
8. Click **Save QR Code**.

## Downloading a QR code

On the QR Code list page (or in the form's **Live Preview**), click:

- **PNG**: a normal image, good for documents, presentations, and social media.
- **SVG**: a format that stays sharp at any size, good for **banners and large printed material**. Give the SVG file to the printer or designer.

Downloaded files are 1024 pixels and ready to print.

## Making QR codes easy to scan

- Use a **dark** code on a **light** background, for example black or maroon on white. Do not reverse it, and avoid two similar colors.
- Print it at least **2.5 × 2.5 cm**. For banners seen from far away, make it much larger.
- Leave empty space around the code, and do not place the code on top of a photo.
- **Always test-scan** with 2–3 different phones before printing in large numbers.

> **Important:** If a QR code uses a shortlink with **Inactive** status, scanning it shows a "not found" page. The QR Code list page marks this with a **Shortlink inactive** label.

## The QR Code list page

Each row shows a preview of the code, its title, content, caption, and target. For QR codes using a shortlink, the **number of scans/clicks** is shown too. Use ✏️ to change a QR code's look or destination, and 🗑️ to delete it.

> **Note:** Deleting a QR code in the CMS does **not** disable codes that are already printed. A QR code that uses a shortlink keeps working as long as the shortlink is active.
