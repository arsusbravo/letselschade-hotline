# Image Optimization Guide

## Current Issues:

-   `header.png`: 1.6MB (WAY TOO LARGE!)
-   `roel.jpg`: 120KB (acceptable but can be optimized)
-   `judith.jpg`: 93KB (acceptable but can be optimized)

## Solutions:

### 1. Remove Large Header Image

✅ DONE - Replaced with CSS placeholder

### 2. Optimize Team Photos

Run these commands on your server:

```bash
# Install ImageMagick if not available
sudo apt-get install imagemagick

# Optimize team photos
convert roel.jpg -quality 85 -resize 600x600 roel-optimized.jpg
convert judith.jpg -quality 85 -resize 600x600 judith-optimized.jpg

# Or use online tools:
# - TinyPNG.com
# - Squoosh.app
# - ImageOptim (Mac)
```

### 3. Use WebP Format (Better Compression)

```bash
# Convert to WebP
cwebp roel.jpg -q 85 -o roel.webp
cwebp judith.jpg -q 85 -o judith.webp
```

### 4. Update HTML to Use Optimized Images

Replace in contact.blade.php:

```html
<img src="/images/roel-optimized.jpg" alt="..." loading="lazy" />
<img src="/images/judith-optimized.jpg" alt="..." loading="lazy" />
```

### 5. Add Picture Element for WebP Support

```html
<picture>
    <source srcset="/images/roel.webp" type="image/webp" />
    <img src="/images/roel-optimized.jpg" alt="..." loading="lazy" />
</picture>
```

## Target File Sizes:

-   Team photos: < 50KB each
-   Hero image: Removed (using CSS)
-   Total page images: < 100KB

This will make your page load 10x faster!
