<?php

namespace App\Modules\Product\Http\Traits;

use App\Modules\Product\Models\ProductImage;
use App\Shared\FileUpload\FileUpload;

trait ProductTrait
{
    /**
     * Delete product thumbnail.
     */
    public function deleteProductthumbnail(string $image_id)
    {
        $image = ProductImage::find($image_id);
        if ($image) {
            $image_path = $image->image;
            FileUpload::delete($image_path);
        }
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function uploadProductThumbnails(array $files, int $product_id)
    {
        $uploadedPaths = FileUpload::uploadMultiple($files, 'products');

        foreach ($uploadedPaths as $path) {
            ProductImage::create([
                'product_id' => $product_id,
                'image' => $path,
            ]);
        }
    }
}
