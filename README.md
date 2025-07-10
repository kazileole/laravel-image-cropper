# 📸 Laravel Image Cropper

A reusable Laravel Blade component for cropping images with custom aspect ratio, rotation, zoom, drag, and base64 output.

---

## ✅ Requirements

- PHP >= 8.1  
- Laravel 10 or 11  
- Bootstrap 5 (included in your layout or via CDN)

---

## 🔧 Installation

Install the package via Composer:

```bash
composer require mynulleo/laravel-image-cropper
```

---

## 📤 Publish Assets

Run the following command to publish the required assets (CSS & JS):

```bash
php artisan vendor:publish --tag=image-cropper-assets
```

Assets will be published to:

```
public/vendor/image-cropper/
```

---

## 🧩 Usage

Use the component in your Blade form:

```blade
<form method="POST" enctype="multipart/form-data">
    @csrf

    <x-image-cropper 
        input-id="uploadImage" 
        preview-id="previewImage"
        ratio="816/484" 
        output-name="cropped_image" 
    />

    <!-- File input -->
    <input type="file" id="uploadImage" accept="image/*">

    <!-- Image preview -->
    <img id="previewImage" style="max-width: 200px;" />

    <button type="submit">Submit</button>
</form>
```

---

## ⚙ Features

- Modal-based image cropping
- Fixed or custom aspect ratio (e.g., `816/484`)
- Zoom, rotate, drag, flip, reset
- Output: base64-encoded image
- Preview support
- Responsive modal
- Automatically clears input on crop/cancel
- Built with [cropperjs](https://github.com/fengyuanchen/cropperjs)

---

## 📂 Asset Folder Structure

After publishing:

```
public/
└── vendor/
    └── image-cropper/
        ├── cropper.css
        └── cropper.js
```

---

## 📦 Vite/Webpack Users (optional)

If you use a bundler and want to avoid publishing to `public/`, you can import the assets directly from:

```
resources/assets/cropper.css
resources/assets/cropper.js
```

Then include them in your `app.css` and `app.js` builds.

---

## 📌 Notes

- Requires Bootstrap 5 (you can include from CDN or your compiled CSS)
- The `output-name` field will be the name of the hidden input that stores the base64 value
- You can change modal text/button icons by editing the component view
- Image validation (mime, size, dimension) happens before cropper is shown

---

## 🧠 Backend Validation Example (optional)

```php
$request->validate([
    'cropped_image' => 'required|string', // base64 string
]);
```

---

## 🙋‍♂️ Support

For issues, feature requests, or contributions, please open a ticket on [GitHub](https://github.com/mynulleo/laravel-image-cropper).

---

## 🪪 License

MIT License  
© 2025 [Mynul Islam (mynulleo)](https://github.com/mynulleo)
