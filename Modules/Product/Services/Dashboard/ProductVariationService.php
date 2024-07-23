<?php

namespace Modules\Product\Services\Dashboard;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Modules\Base\Interface\ImageServiceInterface;
use Modules\Base\Services\BaseCrudService;
use Modules\Product\Models\ProductAttributeValue;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Models\ProductVariationImage;

class ProductVariationService extends BaseCrudService
{
    public function __construct(protected ImageServiceInterface $imageServiceInterface)
    {
        parent::__construct(new ProductVariation);
    }

    public function index(bool $is_pagination = true, int $perPage = 8, bool $returnQuery = false)
    {
        $query = ProductVariation::with("images");
    
        if ($returnQuery) {
            return $query;
        }
    
        if ($is_pagination) {
            return $query->paginate($perPage);
        }
    
        return $query->get();
    }
    public function createWithImages($data)
    {

        $user = auth()->user();
        $imageFieldName = 'main_image';
        $image = $this->imageServiceInterface->saveImage($data[$imageFieldName]);
        
        $product = $this->model->create(array_merge(
            $data,
            [
                $imageFieldName => $image,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]
        ));

        $additionalImages = [];
        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $productVariationImage) {
                $imagePath = $this->imageServiceInterface->saveImage($productVariationImage);
                $additionalImage = ProductVariationImage::create([
                    'variation_id' => $product->id,
                    'image' => $imagePath,
                    'is_active' => $productVariationImage->is_active ?? 0,
                    'is_main_image' => $productVariationImage->is_main_image ?? 0,
                ]);
                $additionalImages[] = [
                    'id' => $additionalImage->id,
                    'image' => $imagePath,
                    'variation_id' => $product->id,
                    'is_active' => $additionalImage->is_active,
                    'is_main_image' => $additionalImage->is_main_image,

                ];
            }
        }

        $productWithImages = $product;
        $productWithImages['images'] = $additionalImages;

        if (isset($data['attribute']) && is_array($data['attribute'])) { 
                foreach ($data['attribute'] as $attribute) {
                    foreach ($attribute['attributeValue'] as $attributeValue) {
                        ProductAttributeValue::create([
                            'variation_id'=> $product->id,
                            'attribute_name'=> $attribute->id,
                            'attribute_value'=> $attributeValue->id,
                         ]);
                    }

                    }
        }
        return $productWithImages;
    }

    public function updateWithImage(int $id, array $data)
    {

        $product = $this->model->with('images')->findOrFail($id);
        if (isset($data['images'])) {
            $images = $data['images'];
            $oldImages = $product->images->pluck('image')->toArray();
         
            $deletedImages = array_diff($oldImages, $images);

            foreach ($images as $image) {
                if ($image instanceof UploadedFile) {
                    $imagePath = $this->imageServiceInterface->saveImage($image);
                    
                $new =  ProductVariationImage::create([
                        'variation_id' => $product->id,
                        'image' => $imagePath,
                        'is_active' => 1,
                        'is_main_image' => 0,
                    ]);
                   
                }
            }
    
            // Handle deleted images
            foreach ($deletedImages as $deletedImage) {
                $image = ProductVariationImage::where('image', $deletedImage)
                 ->where('variation_id', $product->id)
                 ->first();
                if ($image) {
                    $this->imageServiceInterface->deleteImage($image->image);
                    $image->delete();
                }
            }
        }
    
        // Handle main image
        $imageFieldName = 'main_image';
        if (isset($data[$imageFieldName])) {
            $image = $this->imageServiceInterface->UpdateImage($data[$imageFieldName], $product[$imageFieldName]);
            $data[$imageFieldName] = $image;
        }
    
        // Update product
        $product->update($data);
    
        return [];
    }

    public function delete(int $id)
    {

        $object = $this->findByID($id);
        $this->imageServiceInterface->DeleteImage($object['main_image']);

        return (bool) $object->delete();
    }
}
