<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortalCategory;
use Illuminate\Http\Request;

class PortalCategoryController extends Controller
{
    public function index()
    {
        $categories =
            PortalCategory::orderBy(
                'sort_order'
            )->get();

        return view(
            'admin.portal-category.index',
            compact(
                'categories'
            )
        );
    }

    public function create()
    {
        return view(
            'admin.portal-category.create',
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

        $validated['sort_order'] =
            PortalCategory::max(
                'sort_order'
            ) + 1;

        PortalCategory::create(
            $validated
        );

        return redirect()
            ->route(
                'admin.portal-category.index'
            )
            ->with(
                'success',
                'Kategori berhasil ditambahkan'
            );
    }

    public function edit(
        PortalCategory $portalCategory
    )
    {
        return view(
            'admin.portal-category.edit',
            [
                'category'
                    => $portalCategory,
            ]
        );
    }

    public function update(
        Request $request,
        PortalCategory $portalCategory
    )
    {
        $validated =
            $this->validateData(
                $request
            );

        $portalCategory->update(
            $validated
        );

        return redirect()
            ->route(
                'admin.portal-category.index'
            )
            ->with(
                'warning',
                'Kategori berhasil diperbarui'
            );
    }

    public function destroy(
        PortalCategory $portalCategory
    )
    {
        if (
            $portalCategory->items()->exists()
        ) {

            return redirect()
                ->route(
                    'admin.portal-category.index'
                )
                ->with(
                    'danger',
                    'Kategori masih memiliki item portal.'
                );
        }

        $portalCategory->delete();

        return redirect()
            ->route(
                'admin.portal-category.index'
            )
            ->with(
                'danger',
                'Kategori berhasil dihapus'
            );
    }

    private function validateData(
        Request $request
    )
    {
        return $request->validate([

            'name'
                => 'required|string|max:255',

            'is_active'
                => 'nullable|boolean',

        ]);
    }
}