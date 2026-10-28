This chapter explains things that **apply to every menu**. Take 10 minutes to read it. The other chapters will be much easier to follow afterwards.

## 1. Two languages (language tabs)

The BPI website is available in **Indonesian** and **English**. That is why almost every form in the CMS has **language tabs** like these:

`ID · Bahasa Indonesia  Default`   `EN · English`

- Click the **ID** tab to fill in the Indonesian text, then click the **EN** tab to fill in the English text.
- The tab marked **Default** is the main website language (currently Indonesian).
- Both tabs are saved together when you press the save button **once**. You do not need to save each tab.
- Fields that do not depend on language (such as images, order, status, year) are outside the tabs and only need to be filled in once.

**What if the EN tab is left empty?** You can still save. When you press save, every empty field in the **EN** tab is **automatically filled with a copy of the text from the ID tab**. As a result, visitors who choose English will see **Indonesian** text in those fields. The website never shows an empty space, but it is best to fill in both languages for a consistent look.

Two things to keep in mind:

- After saving, the **EN** tab contains a **copy** of the Indonesian text, so when you open the form again the EN fields no longer look empty. You can replace it with an English translation at any time and save.
- The copy **does not change** when you later change the text in the ID tab. After changing the Indonesian text, update the EN tab too, or **empty** the EN field and save so it is copied again from the new Indonesian text.

> **Note:** This rule **does not apply** to [Page Texts](bab:teks-halaman) and Footer & Legal. There, an empty field means the website uses **its own built-in text**.

> **Tip:** Write and check the Indonesian version first, then translate it into English. You can use Google Translate or DeepL, but always reread the result, especially position titles, organization names, and film terms.

> **Important:** If a **red dot** appears on a language tab after you press save, something in **that tab** is wrong or missing. Click the tab to see which field has the problem. You can see an example in the picture in section 2 below.

## 2. Required fields and error messages

Fields marked with a **red asterisk (\*)** are required. In the language tabs, the requirement only applies to the **Default language** (ID). The other language tab (EN) may be left empty; it will be copied from the ID tab, as explained in section 1.

If something is wrong when you save, the data is **not saved**. In the example below, the **Add Banner** form was saved without a title and description, and three signs appear:

- a red box at the top of the page saying **"There are errors in the form:"** with a list of the errors,
- a **red dot** on the language tab that has the problem (in this example only the **ID** tab, because the EN tab may be empty), and
- red text right below the field that has the problem.

![The Add Banner form after a failed save: a red box listing the errors, a red dot on the language tab, and a message under the Title field](/images/panduan/pesan-kesalahan.webp)

Error messages often use the **technical name** of a field. How to read it: `translations.id.judul` means the **Title / Judul** field in the **ID** tab, and `translations.en.deskripsi` means the **Description / Deskripsi** field in the **EN** tab.

The most common messages and what they mean:

| Message on screen | Meaning | What to do |
|---|---|---|
| *The … field is required.* | A required field is empty | Fill in the field |
| *The … must not be greater than 2048 kilobytes.* | The image file is too large (more than 2 MB) | Make the image smaller, see section 5 below |
| *The … must be a file of type: …* / *must be an image* | The file format is not accepted | Use JPG, PNG, WEBP, or GIF |
| *The … must be a valid URL.* | The link address is incomplete | Start it with `https://`, for example `https://bpi.or.id` |
| *The … has already been taken.* / *already in use* | Another record already uses this value | Use a different value |
| *The … must not be greater than 255 characters.* | The text is too long | Shorten the text |
| *The … must be a valid email address.* | The email format is wrong | Check the email, for example `name@bpi.or.id` |

> **Tip:** After a failed save, what you typed usually stays in the form, **except image files**. Choose the image file again before pressing save.

## 3. Visibility status: Active / Inactive

Almost every item has a status:

- **Active** (green) means it is **shown** on the website.
- **Inactive** (gray) means it is **hidden** from the website, but the data **stays saved** in the CMS.

How to change it:

- **Fastest:** on the list page, **click the Active/Inactive label** on that row. The status changes immediately without pressing save.
- **Through the form:** open Edit, tick or untick the **Active** / **Status** box, then save.

> **Tip:** Want to hide something for a while, such as a banner for an event that has ended? **Make it Inactive, do not delete it.** If you need it again later, just activate it.

### News and Projects only: Draft / Published / Archived

News and projects use a publication status:

| Status | Meaning | Shown on the website? |
|---|---|---|
| **Draft** | Still a draft / not ready yet | No |
| **Published** | Published | **Yes** |
| **Archived** | Archived (no longer relevant) | No |

On the list page, clicking the status label switches between **Published ↔ Draft**. To choose **Archived**, open the Edit form and select it in **Publication Status**.

> **Warning:** If you click the status label of an **Archived** item on the list page, it immediately becomes **Published** and appears on the website. To change the status of an archived item, use the Edit form.

## 4. Display order (Order)

The **Order** or **Display Order** field decides the order on the website. **Smaller numbers come first** (1, 2, 3, and so on).

> **Tip:** Leave gaps between numbers, for example 10, 20, 30. Later, if you want to insert a new item between two others, you can give it 15 without changing the order of the other items.

If two items have the same order number, the one created first is shown first.

## 5. Uploading images

### File rules

- Accepted formats: **JPG, PNG, WEBP, and GIF**.
- Maximum file size: **2 MB** per image (QR Code logo only: **1 MB**).
- **SVG** files (and **HEIC** files from iPhones) are **not accepted**. Convert them to PNG or JPG first. The file picker in the CMS only shows files in accepted formats.

### What the system does automatically

You do not need to resize images by hand, because the system will:

1. **Shrink** images that are too large, based on each menu's limit (see the table below). Images smaller than the limit keep their size.
2. **Compress** images into **WebP** format so the website loads faster. Quality stays good and transparent PNG backgrounds stay transparent.
3. **Name the file** after the item's title or name, for example `festival-film-indonesia-x7k2p9.webp`.
4. **Delete the old file** automatically when you replace an image or delete the item.

### Recommended image sizes

| Menu | Recommended shape | Longest side after the system shrinks it |
|---|---|---|
| Banner | Landscape (wide), at least 1920 px wide | 1920 px |
| News & project covers | Landscape, 16:9 ratio (for example 1920 × 1080 px) | 1920 px |
| News & project galleries | Landscape or portrait | 1920 px |
| Programs, Roadmap, About | Landscape | 1920 px |
| Org. structure photos | Portrait or square, face in the center | 1000 px |
| Stakeholder images | Logo, square | 800 px |
| Partner logos | PNG with a transparent background | 600 px |
| QR Code center logo | Square PNG with a transparent background | 512 px |

> **Tip:** Photos from phones or cameras are usually 3–10 MB, so they are rejected for being over 2 MB. Make them smaller first with a free website such as **squoosh.app** or **tinypng.com**. Another way: open the photo in Paint (Windows), choose **Resize**, set the width to 1920 pixels, and save.

### Removing an image without replacing it

In the Edit form, below the current image, there is a red **Delete Image** button.

> **Warning:** The **Delete Image** button deletes the image immediately, **without** pressing save, and it cannot be undone. If you only want to replace the image, just choose a new file and do not press **Delete Image**.

## 6. Choosing an icon

Some items (such as mission points, programs, projects, stakeholders) can have a **small icon**. To choose one:

1. Click the **Select** button next to the icon field. The **Select Icon Visually** window opens.
2. Search by typing an **English** keyword (for example *film*, *camera*, *people*, *law*, *globe*, *rocket*, *money*), or click a category such as 🎬 Filmmaking, 💡 Innovation, 👥 HR & Partners, 🎓 Education, ⚖️ Regulation, or 🌐 Global & Business.
3. Click the icon you want. The icon code (for example `fa-solid fa-film`) is filled in automatically.

Do not type icon codes by hand unless you know *Font Awesome* icon codes.

## 7. The text editor (Rich Text Editor)

For long texts, such as news articles, the Privacy Policy, and the Terms & Conditions, the CMS has an editor similar to Microsoft Word. The buttons at the top:

| Button | What it does |
|---|---|
| **Normal / Heading 2 / 3 / 4** | Turns text into a section heading (sub-title). Use Heading 2 for main sub-titles. |
| **B** / *I* / U / S | Bold, italic, underline, strikethrough |
| **A** (color) | Text color and background color |
| Numbered / bulleted list | Creates a 1, 2, 3 list or a bulleted list |
| Alignment | Left, center, right, or justified |
| Quote (") | Shows text as a quote |
| Link (🔗) | Makes text clickable, leading to a web address |
| Clear formatting (Tx) | Returns the selected text to plain formatting |

> **Tip:** When copying text from Word, a PDF, or another website, paste it with **Ctrl + Shift + V** to keep the formatting clean. Then format it again using the editor buttons. Avoid using many text colors so the website stays tidy.

## 8. Saving, canceling, and deleting

- **Saving:** the save button has a different name in each menu (for example **Save**, **Save Partner**, **Update News**, **Save Changes**), but it is always maroon and at the bottom of the form. When it works, a green box appears saying *"… added successfully"* or *"… updated successfully"*.
- **Canceling:** click **Cancel** or **Back**. Anything not saved is discarded.
- **Deleting:** click the trash icon, then click **OK** in the confirmation box *"Are you sure you want to delete this data?"*.

> **Warning:** Deleted data is **gone for good**. The CMS has no recycle bin to restore it, and related images are deleted too. If you are unsure, use the **Inactive** status instead.

## 9. Good working habits

- **Check the result on the website** every time you save.
- **Do not edit the same item at the same time** as a colleague. The last save overwrites earlier changes.
- **Do not open the same form in two browser tabs.** Work from one tab only.
- **Keep the original material** (full-resolution photos, article drafts) in an office folder or Google Drive as a backup.
- **Use formal language** and check the spelling of people's names, positions, and organizations before publishing.
