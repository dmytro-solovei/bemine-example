<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Classes\Contracts\Services\Admin\ColorService;
use App\Classes\Contracts\Services\Admin\GalleryService;
use App\Classes\Contracts\Services\Admin\SizeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryDeleteRequest;
use App\Http\Requests\Admin\GalleryPhotoDeleteRequest;
use App\Http\Requests\Request;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

/**
 * Class GalleryController
 * @package App\Controllers\Admin
 *
 */
class GalleryController extends Controller
{
    /**
     * @var GalleryService
     */
    private GalleryService $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }


    /**
     * @param GalleryDeleteRequest $request
     * @return JsonResponse
     */
    public function deleteProductGallery(GalleryDeleteRequest $request): JsonResponse
    {
        $product = Product::findOrFail($request->productId);
        $ids = $this->galleryService->deleteProductGalleryBlock($product, $request->ids);

        return response()->json(['message' => 'ok', 'data' => $ids], Response::HTTP_OK);
    }

    /**
     * @param GalleryPhotoDeleteRequest $request
     * @return JsonResponse
     */
    public function removeGalleryPhoto(GalleryPhotoDeleteRequest $request): JsonResponse
    {
        $productGallery = ProductGallery::where('image', $request->image)
            ->with('product')
            ->first();

        $smallPath = Storage::disk("public")->path(storage_path('p/' . $productGallery->product->slug . '/gallery/small/'.$request->image));
        $bigPath = Storage::disk("public")->path(storage_path('p/' . $productGallery->product->slug . '/gallery/small/'.$request->image));

        if ($smallPath && $bigPath) {
            Storage::disk("public")->delete($smallPath);
            Storage::disk("public")->delete($bigPath);

            ProductGallery::query()->where('image', $request->image)->delete();

            return response()->json(['message' => 'File deleted'], Response::HTTP_OK);
        } else{
            return response()->json(['message' => 'File not found'], Response::HTTP_OK);
        }
    }

    /**
     * @param int $galleryCount
     * @param int $sizeBlockCount
     * @return JsonResponse
     */
    public function addGalleryBlock(int $galleryCount = 0, int $sizeBlockCount = 0): JsonResponse
    {
        $sizeService = app(SizeService::class);
        $sizes = $sizeService->getAllSizes();
        $colorService = app(ColorService::class);
        $colors = $colorService->getAllColors();

        return response()
            ->json([
                'body' => view('admin.products.partials.add_gallery',
                    compact('sizes', 'colors', 'galleryCount', 'sizeBlockCount'))->render()
            ]);
    }

    /**
     * @param int $galleryCount
     * @param int $sizeBlockCount
     * @return JsonResponse
     */
    public function addColorSizeBlock(int $galleryCount = 0, int $sizeBlockCount = 0): JsonResponse
    {
        $sizeService = app(SizeService::class);
        $sizes = $sizeService->getAllSizes();
        $colorService = app(ColorService::class);
        $colors = $colorService->getAllColors();
        return response()->json(
            ['body' => view('admin.products.partials.add_size_color',
                compact('sizes', 'colors', 'galleryCount', 'sizeBlockCount'))->render()
            ]);
    }

}
