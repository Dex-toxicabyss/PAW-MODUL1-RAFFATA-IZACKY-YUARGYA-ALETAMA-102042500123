# PAW Practical Projects

A collection of native PHP practical projects for **Pemrograman Aplikasi Web (PAW)**. The repository keeps Modul 1 and Jurnal 1 as separate sibling folders so each submission can be opened and run independently.

## Projects

| Project | Description | Main files |
|---|---|---|
| `PAW_MODUL-1_RAFFATA IZACKY YUARGYA ALETAMA_102042500123` | LabPass registration console for prospective practicum assistants. | `index.php`, `style.css`, `images/` |
| `PAW_JURNAL-1_RAFFATA_102042500123` | Jurnal 1 assistant-practicum registration system with PHP validation, session storage, and a generated registration card. | `index.php`, `style.css`, `images/` |

## Jurnal 1 features

- Native PHP form handling with `POST`
- Session-based storage through `$_SESSION['data_pendaftar']`
- Registration form and `?page=id_card` display mode
- Validation for name, WhatsApp number, institutional email, course selection, and motivation
- Retained input values after validation errors
- Registration-card output with escaped user data
- Responsive LabPass interface and print-ready card layout
- Campus background image and Enterprise Application Development logo stored in `images/`

## Technology

- PHP Native
- HTML5
- CSS3
- Vanilla JavaScript
- PHP session handling

No framework, database, authentication service, payment system, or external API is required.

## Repository structure

```text
PAW-MODUL1-RAFFATA-IZACKY-YUARGYA-ALETAMA-102042500123/
├── PAW_MODUL-1_RAFFATA IZACKY YUARGYA ALETAMA_102042500123/
│   ├── index.php
│   ├── style.css
│   └── images/
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
```

Open either project:

- [Modul 1](http://localhost:8000/PAW_MODUL-1_RAFFATA%20IZACKY%20YUARGYA%20ALETAMA_102042500123/)
- [Jurnal 1](http://localhost:8000/PAW_JURNAL-1_RAFFATA_102042500123/)

To lint the PHP files:

```bash
php -l "PAW_MODUL-1_RAFFATA IZACKY YUARGYA ALETAMA_102042500123/index.php"
php -l PAW_JURNAL-1_RAFFATA_102042500123/index.php
```

## Academic scope

These projects are academic exercises for practicing PHP request handling, form validation, sessions, HTML structure, CSS styling, and basic client-side interaction. They are not intended to represent production systems.

## Author

**Raffata Izacky Yuargya Aletama**
NIM: `102042500123`

## License

This project is licensed under the [Apache License 2.0](LICENSE). You may use, modify, and redistribute the code under the license terms, including retaining the copyright and license notices.
