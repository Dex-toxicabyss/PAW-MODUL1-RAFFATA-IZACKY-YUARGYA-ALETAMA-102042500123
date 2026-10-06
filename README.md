# PAW Practical Projects

A collection of native PHP practical projects for **Pemrograman Aplikasi Web (PAW)**. The repository keeps Modul 1 and Jurnal 1 as separate sibling folders so each submission can be opened and run independently.

## Projects

| Project | Description | Main files |
|---|---|---|
| `PAW_MODUL-1_RAFFATA IZACKY YUARGYA ALETAMA_102042500123` | Cia Store product catalog built from a PHP array, with product cards, Rupiah pricing, stock status, and availability actions. | `index.php`, `style.css` |
| `PAW_JURNAL-1_RAFFATA_102042500123` | Jurnal 1 assistant-practicum registration system with PHP validation, session storage, and a generated registration card. | `index.php`, `style.css`, `images/` |

## Modul 1 — Cia Store product catalog

The Modul 1 implementation follows the **Formulir Pembelian Mobil Online / Cia Store** practical brief shown in the assignment material:

- Store name and branded header: **Cia Store**
- Six different technology products stored in a PHP `$products` array
- Product information shown for every item: name, category, price, and stock quantity
- Product cards generated through `foreach`, not hard-coded one by one in HTML
- Conditional PHP logic for availability: stock above `0` is **Tersedia**, stock equal to `0` is **Stok Habis**
- **Beli Sekarang** action for available products
- Disabled **Tidak Tersedia** action when a product is out of stock
- Indonesian Rupiah formatting with `number_format()`
- Total product count, available product count, and total unit stock calculated from the stored array
- Responsive header, hero section, product catalog, and footer
- Native PHP, HTML5, and CSS3 only; no framework, database, or external API

The visual treatment is intentionally different from Jurnal 1: Modul 1 uses a Cia Store editorial catalog layout with product cards, a feature hero, stock statistics, and a muted technology-goods palette.

## Jurnal 1 features

- Native PHP form handling with `POST`
- Session-based storage through `$_SESSION['data_pendaftar']`
- Registration form and `?page=id_card` display mode
- Validation for name, WhatsApp number, institutional email, course selection, and motivation
- Retained input values after validation errors
- Registration-card output with escaped user data
- Responsive LabPass interface and print-ready card layout
- Responsive registration interface with the tracked PHP and CSS files

The Jurnal 1 client-side behavior uses **Vanilla JavaScript** only: input/change event listeners update the form-readiness indicator and motivation character counter, while `window.print()` supports registration-card printing. No JavaScript framework or library is used.

## Technology

- PHP Native
- HTML5
- CSS3
- Vanilla JavaScript in Jurnal 1 for lightweight UI feedback and printing
- PHP session handling in Jurnal 1

No framework, database, authentication service, payment system, or external API is required.

## Repository structure

```text
PAW-MODUL1-RAFFATA-IZACKY-YUARGYA-ALETAMA-102042500123/
├── PAW_MODUL-1_RAFFATA IZACKY YUARGYA ALETAMA_102042500123/
│   ├── index.php
│   └── style.css
├── PAW_JURNAL-1_RAFFATA_102042500123/
│   ├── index.php
│   ├── style.css
│   └── images/
│       ├── bg-campus.png
│       └── logo.png
├── README.md
└── LICENSE
```

## Run locally

From the repository root, start PHP's built-in server:

```bash
php -S localhost:8000 -t .
php -S localhost:8001 -t .
```
Recommended validation commands:

```bash
php -l "PAW_MODUL-1_RAFFATA IZACKY YUARGYA ALETAMA_102042500123/index.php"
php -l PAW_JURNAL-1_RAFFATA_102042500123/index.php
```

## Academic scope

These projects are academic exercises for practicing PHP arrays, loops, conditional rendering, form handling, validation, sessions, HTML structure, CSS styling, and basic client-side interaction. They are not intended to represent production systems.

## Author

**Raffata Izacky Yuargya Aletama**

NIM: `102042500123`

## License

This project is licensed under the [Apache License 2.0](LICENSE). You may use, modify, and redistribute the code under the license terms, including retaining the copyright and license notices.
