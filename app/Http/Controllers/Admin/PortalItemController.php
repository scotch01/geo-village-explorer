<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PortalItem;
use App\Models\PortalCategory;
use App\Models\Desa;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PortalItemController extends Controller
{
    public function index(Request $request)
    {
        $items = PortalItem::with([
                'category',
                'desa',
            ])

            ->when(
                $request->filled('desa_id'),
                fn ($query) =>
                $query->where(
                    'desa_id',
                    $request->desa_id
                )
            )

            ->when(
                $request->filled('portal_category_id'),
                fn ($query) =>
                $query->where(
                    'portal_category_id',
                    $request->portal_category_id
                )
            )

            ->when(
                $request->filled('file_type'),
                fn ($query) =>
                $query->where(
                    'file_type',
                    $request->file_type
                )
            )

            ->orderBy('sort_order')
            ->get();

        return view(
            'admin.portal-item.index',
            [
                'items' => $items,

                'desas' => Desa::orderBy(
                    'nama_desa'
                )->get(),

                'categories' =>
                    PortalCategory::active()
                        ->orderBy('sort_order')
                        ->get(),

                'fileTypes' =>
                    config('portal.file_types'),
            ]
        );
    }

    public function create()
    {
        return view(
            'admin.portal-item.create',
            [

                'categories'
                    => PortalCategory::active()
                        ->orderBy('sort_order')
                        ->get(),

                'desas'
                    => Desa::orderBy(
                        'nama_desa'
                    )->get(),

                'fileTypes'
                    => config(
                        'portal.file_types'
                    ),

            ]
        );
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        /**
         * Default URL untuk image
         */
        if ($request->file_type === 'image') {

            $validated['url'] = '-';

        }

        /**
         * Upload Image
         */
        if (
            $request->file_type === 'image' &&
            $request->hasFile('image')
        ) {

            $manager = new ImageManager(new Driver());

            $image = $manager
                ->read($request->file('image'))
                ->toWebp(80);

            $filename = uniqid() . '.webp';

            Storage::disk('public')->put(
                "portal/{$filename}",
                $image
            );

            $validated['image_path'] = "portal/{$filename}";
        }

        $validated['sort_order'] =
            PortalItem::max('sort_order') + 1;

        PortalItem::create($validated);

        return redirect()
            ->route('admin.portal-item.index')
            ->with(
                'success',
                'Item portal berhasil ditambahkan'
            );
    }

    public function edit(
        PortalItem $portalItem
    )
    {
        return view(
            'admin.portal-item.edit',
            [
                'item' => $portalItem,

                'categories' => PortalCategory::active()
                    ->orderBy('sort_order')
                    ->get(),
                    
                'desas'
                    => Desa::orderBy(
                        'nama_desa'
                    )->get(),

                'fileTypes' => config(
                    'portal.file_types'
                ),
            ]
        );
    }

    public function update(
        Request $request,
        PortalItem $portalItem
    )
    {
        $validated = $this->validateData($request);

        /**
         * Default URL untuk image
         */
        if ($request->file_type === 'image') {

            $validated['url'] = '-';

        }

        /**
         * Upload image baru
         */
        if (
            $request->file_type === 'image' &&
            $request->hasFile('image')
        ) {

            if (
                $portalItem->image_path &&
                Storage::disk('public')->exists($portalItem->image_path)
            ) {

                Storage::disk('public')->delete(
                    $portalItem->image_path
                );

            }

            $manager = new ImageManager(new Driver());

            $image = $manager
                ->read($request->file('image'))
                ->toWebp(80);

            $filename = uniqid() . '.webp';

            Storage::disk('public')->put(
                "portal/{$filename}",
                $image
            );

            $validated['image_path'] = "portal/{$filename}";
        }

        $portalItem->update($validated);

        return redirect()
            ->route('admin.portal-item.index')
            ->with(
                'warning',
                'Item portal berhasil diperbarui'
            );
    }

    public function destroy(
        PortalItem $portalItem
    )
    {
        if (
            $portalItem->image_path &&
            Storage::disk('public')->exists(
                $portalItem->image_path
            )
        ) {

            Storage::disk('public')->delete(
                $portalItem->image_path
            );

        }

        $portalItem->delete();

        return redirect()
            ->route('admin.portal-item.index')
            ->with(
                'danger',
                'Item portal berhasil dihapus'
            );
    }

    private function validateData(Request $request)
    {
        return $request->validate([

            'portal_category_id'
                => 'required|exists:portal_categories,id',

            'desa_id'
                => 'required|exists:desas,id',

            'title'
                => 'required|string|max:255',

            'description'
                => 'nullable|string',

            'file_type'
                => 'required|string',

            'url'
                => 'nullable|url|required_unless:file_type,image',

            'image'
                => 'required_if:file_type,image|nullable|image|max:5120',

            'is_active'
                => 'nullable|boolean',

        ]);
    }
}
