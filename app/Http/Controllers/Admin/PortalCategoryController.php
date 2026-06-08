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
                'type'
            )
            ->orderBy(
                'sort_order'
            )
            ->get();

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
            [
                'types'
                    => config(
                        'portal.types'
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

                'types'
                    => config(
                        'portal.types'
                    ),
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

            'type'
                => 'required|string',

            'name'
                => 'required|string|max:255',

            'sort_order'
                => 'nullable|integer|min:0',

            'is_active'
                => 'nullable|boolean',

        ]);
    }
}