The **Org. Structure** menu manages **BPI's board members**: the leadership, councils, departments (*bidang*), committees (*komite*), taskforces (*satgas*), and working groups (*pokja*). This data builds the **organizational chart** on the website's About page.

Open menu: [Org. Structure](cms:admin.struktur.index)

This page has three main buttons:

| Button | What it is for |
|---|---|
| **Add Member** | Adds a new member |
| **Chart Layout** | Arranges the department and unit boxes in the chart |
| **Section Texts** | Changes the headings and labels of the organizational structure section (see [Page Texts](bab:teks-halaman)) |

## How members are grouped

A person's position in the chart is set by three fields: **Category**, **Sub-Category**, and **Hierarchy Level**. Each option is in English, with the official BPI term in brackets, for example **Core Leadership (Pimpinan Inti)**.

The picture below shows the chart on the website. On the left: the **Majelis Dewan** (councils: Dewan Pengawas / Supervisory, Dewan Penasehat / Advisory, Dewan Pakar / Expert) on both sides of the **Pimpinan Inti** (core leadership: the Ketua Umum / Chairperson), with the Secretary-General, Treasurer, and Deputy Secretaries-General below. On the right: the **Bidang Strategis** (department) boxes, then the **Komite, Pokja, dan Satgas** (committees, working groups, and taskforces) boxes.

![The organizational chart on the website: councils, core leadership, secretariat and treasury, departments, and committees, working groups, and taskforces](/images/panduan/bagan-website.webp)

**Category** is the main group:

| Category (as shown in the form) | Meaning |
|---|---|
| **Core Leadership** (Pimpinan Inti) | Ketua Umum (Chairperson), Sekretaris Jenderal (Secretary-General), Bendahara Umum (Treasurer), Wakil Sekjen (Deputy Secretary-General) |
| **Councils** (Majelis Dewan) | Dewan Pengawas (Supervisory), Dewan Penasehat (Advisory), Dewan Pakar (Expert) |
| **Strategic Departments** (Bidang Strategis BPI) | Heads and members of the departments (Bidang Organisasi, Bidang Festival, etc.) |
| **Taskforces & Working Groups** (Satgas & Pokja BPI) | Taskforces (Satuan Tugas) and working groups (Kelompok Kerja) |
| **Committees** (Komite BPI) | Committees, for example the Festival Film Indonesia Committee |

**Hierarchy Level** is the rank within the group:

| Level | For |
|---|---|
| **Tier 1 - Chairperson / Council Member** | The Chairperson and council members |
| **Tier 2 - Secretary-General / Treasurer / Deputy Secretary-General** | The Secretary-General, Treasurer, and Deputy Secretaries-General |
| **Tier 3 - Head of Department / Unit** | Heads of departments and units (taskforce, working group, committee) |
| **Tier 4 - Member** | Members |

### Examples of correct entries

Use this table as a reference. It follows the data already in the CMS. The Category and Sub-Category columns use the short names, without the part in brackets:

| Position | Category | Sub-Category | Level | Department / Unit |
|---|---|---|---|---|
| Ketua Umum (Chairperson) | Core Leadership | Core Leadership | Tier 1 | Pimpinan Inti |
| Sekretaris Jenderal | Core Leadership | Core Leadership | Tier 2 | Sekretariat Jenderal |
| Bendahara Umum (Treasurer) | Core Leadership | Core Leadership | Tier 2 | Kebendaharaan Umum |
| Wakil Sekjen Bidang … | Core Leadership | Deputy Secretary-General | Tier 2 | Sekretariat Jenderal |
| Supervisory Council member | Councils | Supervisory Council | Tier 1 | Dewan Pengawas |
| Advisory Council member | Councils | Advisory Council | Tier 1 | Dewan Penasehat |
| Expert Council member | Councils | Expert Council | Tier 1 | Dewan Pakar |
| Head of Festival Department | Strategic Departments | Department | Tier 3 | Bidang Festival |
| Festival Department member | Strategic Departments | Department | Tier 4 | Bidang Festival |
| Head of the Film Law Revision Working Group | Taskforces & Working Groups | Working Group | Tier 3 | Pokja Revisi UU Perfilman |
| Film Law Revision Working Group member | Taskforces & Working Groups | Working Group | Tier 4 | Pokja Revisi UU Perfilman |
| Head of the Anti-Piracy Taskforce | Taskforces & Working Groups | Taskforce | Tier 3 | Satgas Anti Pembajakan |
| Head of the FFI 2026 Committee | Committees | Committee | Tier 3 | Komite Festival Film Indonesia 2026 |

> **Important:** Department, taskforce, working group, and committee members are **grouped by the name in the Department / Unit field** (ID tab). This name must be **exactly the same** for every member of one department or unit, including upper/lower case and spaces. For example, if the head is entered as *Bidang Festival* but a member as *Bidang festival* or *Bidang  Festival* (two spaces), the chart shows **two separate boxes**. To be safe, pick the name from the suggestion list that appears when you start typing.

## Adding a member

1. Click **Add Member**.
2. Fill in **Full Name** (required), with academic titles if needed.
3. Choose **Category**, **Sub-Category**, and **Hierarchy Level** following the example table above.
4. (Optional) Fill in contact details: **Email**, **LinkedIn URL**, **Instagram URL**, and **Phone / WhatsApp**. For LinkedIn and Instagram, use the full address, for example `https://instagram.com/username`.
5. Fill in **Display Order**: the card order within its tier (1, 2, 3, and so on).
6. Tick **Status: Active (Visible on Website)**.
7. In the **ID** tab, fill in:
   - **Position / Jabatan** (required): for example *Ketua Bidang Festival*.
   - **Department / Unit**: for example *Bidang Festival*. A suggestion list appears when you start typing; pick from it when possible.
   - **Biography / Profile Description** (optional): a short profile.
8. In the **EN** tab, fill in the English version, for example *Head of Festival Department* and *Festival Department*.
9. Under **Official Photo**, choose the official photo.
10. Click **Save Member**.

> **Tip:** Use **portrait or square** photos with the face in the center and a plain background. Try to keep all photos in the same style (background, lighting, and distance) so the chart looks tidy. Photos are automatically shrunk to at most 1000 pixels.

## Changing or deactivating a member

- **Change:** click ✏️, change the data, then click **Update Member**.
- **When the board changes:** you can **edit** the name, photo, and biography on that position's record, or create a new member and set the old one to **Inactive**.
- **Hide:** click the **Active** label until it changes to **Inactive**.

## Arranging the org chart (Chart Layout)

The **Chart Layout** page arranges the **order of the department boxes** and the **order of the unit boxes** (committees, taskforces, working groups) in the website chart, without changing order numbers one by one.

1. On the Org. Structure page, click **Chart Layout**.
2. In the **BPI Departments** tab, the department boxes are shown in three rows, just like on the website:
   - **Row 1**: slots 1–5 (main departments, at most 5 boxes)
   - **Row 2**: slots 6–10
   - **Row 3**: slot 11 onwards (centered at the bottom)
3. Click the arrow buttons **‹** (move left) or **›** (move right) in the top-right corner of a box to swap it with the box next to it. The slot numbers (**Slot #1**, **Slot #2**, and so on) change too.
4. Click the **Committees, Taskforces & Working Groups** tab and arrange the committee, taskforce, and working group boxes the same way.
5. Click **Save Layout** in the top right. Wait for the message saying the layout has been saved.
6. Click **Members List** to return to the member list.

![The Chart Layout page: the BPI Departments tab with department boxes in Row 1, Row 2, and Row 3, each with arrow buttons, and the Save Layout button in the top right](/images/panduan/chart-layout.webp)

> **Note:** Chart Layout only shows **Active** members. A department or unit that does not appear here probably has no active members yet, or its Department / Unit name is spelled differently (see the **Important** box above).

> **Important:** Saving the Chart Layout **changes the Display Order numbers** of members to match the box positions. This is normal. If you arrange the chart with Chart Layout, avoid changing the Display Order numbers of department and unit members by hand afterwards.
