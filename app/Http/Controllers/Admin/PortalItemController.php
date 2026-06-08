<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PortalItem;
use App\Models\PortalCategory;

class PortalItemController extends Controller
{
    public function index()
    {
        $items = PortalItem::with('category')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view(
            'admin.portal-item.index',
            compact('items')
        );
    }

    public function create()
    {
        return view(
            'admin.portal-item.create',
            [
                'categories' => PortalCategory::active()
                    ->orderBy('type')
                    ->orderBy('sort_order')
                    ->get(),

                'fileTypes' => config(
                    'portal.file_types'
                ),
            ]
        );
    }

    public function store(
        Request $request
    )
    {
        $validated =
            $this->validateData(
                $request
            );

        PortalItem::create(
            $validated
        );

        return redirect()
            ->route(
                'admin.portal-item.index'
            )
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
                    ->orderBy('type')
                    ->orderBy('sort_order')
                    ->get(),

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
        $validated =
            $this->validateData(
                $request
            );

        $portalItem->update(
            $validated
        );

        return redirect()
            ->route(
                'admin.portal-item.index'
            )
            ->with(
                'warning',
                'Item portal berhasil diperbarui'
            );
    }

    public function destroy(
        PortalItem $portalItem
    )
    {
        $portalItem->delete();

        return redirect()
            ->route(
                'admin.portal-item.index'
            )
            ->with(
                'danger',
                'Item portal berhasil dihapus'
            );
    }

    private function validateData(
        Request $request
    )
    {
        return $request->validate([

            'portal_category_id'
                => 'required|exists:portal_categories,id',

            'title'
                => 'required|string|max:255',

            'description'
                => 'nullable|string',

            'file_type'
                => 'required|string',

            'url'
                => 'required|url',

            'sort_order'
                => 'nullable|integer|min:0',

            'is_active'
                => 'nullable|boolean',

        ]);
    }
}
